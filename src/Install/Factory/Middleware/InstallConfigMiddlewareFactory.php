<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\Middleware;

use Ekklesion\Install\Infrastructure\Http\Middleware\InstallConfigMiddleware;
use Ekklesion\People\Infrastructure\Context\ApplicationSettings;
use Psr\Container\ContainerInterface;

/**
 * Class InstallConfigMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallConfigMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InstallConfigMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new InstallConfigMiddleware($container->get(ApplicationSettings::class));
    }
}
