<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\Http\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\InvokableMiddleware;
use Ekklesion\People\Infrastructure\Context\ApplicationSettings;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class InstallConfigMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallConfigMiddleware implements InvokableMiddleware
{
    /**
     * @var ApplicationSettings
     */
    private $settings;
    /**
     * @var string
     */
    private $installRoute;

    /**
     * InstallConfigMiddleware constructor.
     *
     * @param ApplicationSettings $settings
     * @param string              $installRoute
     */
    public function __construct(ApplicationSettings $settings, string $installRoute = '/install')
    {
        $this->settings = $settings;
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
        if ($request->getUri()->getPath() === $this->installRoute && 'POST' === $request->getMethod()) {
            $params = $request->getParsedBody();

            $this->settings->churchName($params['churchName']);

            $this->settings->databaseName($params['databaseName']);
            $this->settings->databaseHost($params['databaseHost']);
            $this->settings->databaseUser($params['databaseUser']);
            $this->settings->databasePass($params['databasePass']);
            $this->settings->databasePort($params['databasePort']);
        }

        return $next($request, $response);
    }
}
