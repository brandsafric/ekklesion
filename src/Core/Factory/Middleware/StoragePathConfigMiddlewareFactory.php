<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\StoragePathConfigMiddleware;
use Psr\Container\ContainerInterface;

class StoragePathConfigMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return StoragePathConfigMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new StoragePathConfigMiddleware($container->get('settings')['core']['base_path']);
    }
}
