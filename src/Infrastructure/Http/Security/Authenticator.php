<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Security;

use Cake\Chronos\Chronos;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface Authenticator.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface Authenticator
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return void
     */
    public function authenticate(ServerRequestInterface $request): void;

    /**
     * @param ResponseInterface $response
     * @param string            $accountId
     * @param Chronos           $expires
     *
     * @return ResponseInterface
     */
    public function addAuthenticationCookie(ResponseInterface $response, string $accountId, Chronos $expires): ResponseInterface;

    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function removeAuthenticationCookie(ResponseInterface $response): ResponseInterface;

    /**
     * @return string|null
     */
    public function getAuthenticatedAccountId(): ?string;
}
