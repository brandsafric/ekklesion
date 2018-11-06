<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\Http\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\InvokableMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Flash\Messages;
use Slim\Http\Uri;

/**
 * Class InstallErrorHandlerMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallErrorHandlerMiddleware implements InvokableMiddleware
{
    /**
     * @var Messages
     */
    private $flash;
    /**
     * @var string
     */
    private $installPath;

    /**
     * InstallErrorHandlerMiddleware constructor.
     *
     * @param Messages $flash
     * @param string   $installPath
     */
    public function __construct(Messages $flash, string $installPath = '/install')
    {
        $this->flash = $flash;
        $this->installPath = $installPath;
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
        if ($request->getUri()->getPath() === $this->installPath && 'POST' === $request->getMethod()) {
            try {
                return $next($request, $response);
            } catch (\Throwable $exception) {
                $this->flash->addMessage('error', sprintf('There was an error installing. Cause: %s', $exception->getMessage()));

                return $response->withRedirect(Uri::createFromString($this->installPath));
            }
        }

        return $next($request, $response);
    }
}
