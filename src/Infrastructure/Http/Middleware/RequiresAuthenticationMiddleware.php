<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Middleware;

use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Uri;

/**
 * Class RequiresAuthenticationMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class RequiresAuthenticationMiddleware implements InvokableMiddleware
{
    /**
     * @var Authenticator
     */
    private $authenticator;
    /**
     * @var string
     */
    private $redirectRoute;

    /**
     * RequiresAuthenticationMiddleware constructor.
     *
     * @param Authenticator $authenticator
     * @param string        $redirectRoute
     */
    public function __construct(Authenticator $authenticator, $redirectRoute = '/')
    {
        $this->authenticator = $authenticator;
        $this->redirectRoute = $redirectRoute;
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
        if (null === $this->authenticator->getAuthenticatedAccountId()) {
            return $response->withRedirect(Uri::createFromString($this->redirectRoute));
        }

        return $next($request, $response);
    }
}
