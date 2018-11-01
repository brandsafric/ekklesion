<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Security;

use Cake\Chronos\Chronos;
use Firebase\JWT\JWT;
use HansOtt\PSR7Cookies\CookieNotFound;
use HansOtt\PSR7Cookies\RequestCookies;
use HansOtt\PSR7Cookies\SetCookie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Authenticator.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class JwtAuthenticator implements Authenticator
{
    /**
     * @var string
     */
    private $cookieField;
    /**
     * @var string
     */
    private $secretKey;
    /**
     * @var string|null
     */
    private $authenticatedAccountId;

    /**
     * Authenticator constructor.
     *
     * @param string $secretKey
     * @param string $cookieField
     */
    public function __construct(string $secretKey, string $cookieField = '_iup')
    {
        $this->cookieField = $cookieField;
        $this->secretKey = $secretKey;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ServerRequestInterface
     */
    public function authenticate(ServerRequestInterface $request): void
    {
        $cookies = RequestCookies::createFromRequest($request);
        try {
            $cookie = $cookies->get($this->cookieField);
        } catch (CookieNotFound $e) {
            throw AuthenticationFailedException::create();
        }

        try {
            $payload = JWT::decode($cookie->getValue(), $this->secretKey, ['HS512']);
        } catch (\UnexpectedValueException $exception) {
            throw AuthenticationFailedException::create();
        }
        $this->authenticatedAccountId = $payload->sub;
    }

    /**
     * @param ResponseInterface $response
     * @param string            $accountId
     * @param Chronos           $expires
     *
     * @return ResponseInterface
     */
    public function addAuthenticationCookie(ResponseInterface $response, string $accountId, Chronos $expires): ResponseInterface
    {
        $data = [
            'sub' => $accountId,
            'exp' => $expires->getTimestamp(),
        ];
        $token = JWT::encode($data, $this->secretKey, 'HS512');
        $cookie = SetCookie::thatExpires($this->cookieField, $token, $expires, '/');

        return $cookie->addToResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function removeAuthenticationCookie(ResponseInterface $response): ResponseInterface
    {
        $cookie = SetCookie::thatDeletesCookie($this->cookieField, '/');

        return $cookie->addToResponse($response);
    }

    /**
     * @return null|string
     */
    public function getAuthenticatedAccountId(): ?string
    {
        return $this->authenticatedAccountId;
    }
}
