<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Middleware;

use Ekklesion\People\Infrastructure\Http\Security\AuthenticationFailedException;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class AuthenticationMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AuthenticationMiddleware implements InvokableMiddleware
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * AuthenticationMiddleware constructor.
     *
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        try {
            $this->authenticator->authenticate($request);
        } catch (AuthenticationFailedException $exception) {
        }

        return $next($request, $response);
    }
}
