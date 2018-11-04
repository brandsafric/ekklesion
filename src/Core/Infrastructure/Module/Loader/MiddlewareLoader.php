<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Module\Loader;

/**
 * Class MiddlewareLoader.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class MiddlewareLoader
{
    /**
     * @var array
     */
    private $middleware = [];

    /**
     * @param int $priority
     * @param     $callable
     *
     * @return MiddlewareLoader
     */
    public function load(int $priority, $callable): MiddlewareLoader
    {
        if (!\array_key_exists($priority, $this->middleware)) {
            $this->middleware[$priority] = $callable;

            return $this;
        }
        $this->load($priority + 1, $callable);
    }

    public function getMiddleware(): array
    {
        ksort($this->middleware);

        return $this->middleware;
    }
}
