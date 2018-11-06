<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Module;

use Ekklesion\Core\Infrastructure\Module\Loader\MiddlewareLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\ResourceLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\RouteLoader;

/**
 * Interface EkklesionModule.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface EkklesionModule
{
    /**
     * @return string
     */
    public function getModuleName(): string;

    public function dependentModules(): array;

    /**
     * @return array
     */
    public function getServices(): array;

    /**
     * @return array
     */
    public function getSettings(): array;

    /**
     * @param ResourceLoader $resourceLoader
     */
    public function loadResources(ResourceLoader $resourceLoader): void;

    /**
     * @param MiddlewareLoader $middlewareLoader
     */
    public function loadMiddleware(MiddlewareLoader $middlewareLoader): void;

    /**
     * @param RouteLoader $routeLoader
     */
    public function loadRoutes(RouteLoader $routeLoader): void;
}
