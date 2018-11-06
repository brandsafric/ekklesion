<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\Middleware;

use Ekklesion\Install\Domain\Installer\Installer;
use Ekklesion\Install\Infrastructure\Http\Middleware\InstallCheckerMiddleware;
use Psr\Container\ContainerInterface;

/**
 * Class InstallCheckerMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallCheckerMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InstallCheckerMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new InstallCheckerMiddleware(
            $container->get(Installer::class)
        );
    }
}
