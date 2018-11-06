<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\Middleware;

use Ekklesion\Install\Infrastructure\Http\Middleware\InstallErrorHandlerMiddleware;
use Psr\Container\ContainerInterface;

/**
 * Class InstallErrorHandlerMiddlewareFactory.
 */
class InstallErrorHandlerMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InstallErrorHandlerMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new InstallErrorHandlerMiddleware(
            $container->get('flash')
        );
    }
}
