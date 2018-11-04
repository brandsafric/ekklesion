<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Module\Loader;

use Slim\App;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;

/**
 * Class RouteLoader.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class RouteLoader
{
    /**
     * @var App
     */
    private $app;

    /**
     * RouteLoader constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteGroupInterface
     */
    public function group(string $pattern, $callable): RouteGroupInterface
    {
        return $this->app->group($pattern, $callable);
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteInterface
     */
    public function get(string $pattern, $callable): RouteInterface
    {
        return $this->app->get($pattern, $callable);
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteInterface
     */
    public function post(string $pattern, $callable): RouteInterface
    {
        return $this->app->post($pattern, $callable);
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteInterface
     */
    public function put(string $pattern, $callable): RouteInterface
    {
        return $this->app->put($pattern, $callable);
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteInterface
     */
    public function patch(string $pattern, $callable): RouteInterface
    {
        return $this->app->patch($pattern, $callable);
    }

    /**
     * @param string $pattern
     * @param        $callable
     *
     * @return RouteInterface
     */
    public function delete(string $pattern, $callable): RouteInterface
    {
        return $this->app->delete($pattern, $callable);
    }
}
