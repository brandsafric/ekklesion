<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\Http\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\InvokableMiddleware;
use Ekklesion\Install\Domain\Installer\Installer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UriInterface;
use Slim\Http\Uri;

/**
 * Class InstallCheckerMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallCheckerMiddleware implements InvokableMiddleware
{
    /**
     * @var Installer
     */
    private $installer;
    /**
     * @var UriInterface
     */
    private $installRoute;

    /**
     * InstallCheckerMiddleware constructor.
     *
     * @param Installer $installer
     * @param string    $installRoute
     */
    public function __construct(Installer $installer, string $installRoute = '/install')
    {
        $this->installer = $installer;
        $this->installRoute = $installRoute;
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
        if ($this->installer->isInstalled()) {
            return $next($request, $response);
        }
        if ($request->getUri()->getPath() === $this->installRoute) {
            return $next($request, $response);
        }

        return $response->withRedirect(Uri::createFromString($this->installRoute));
    }
}
