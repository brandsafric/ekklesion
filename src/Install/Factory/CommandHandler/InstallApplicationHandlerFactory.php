<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\CommandHandler;

use Ekklesion\Install\Domain\Installer\Installer;
use Ekklesion\Install\Infrastructure\CommandHandler\InstallApplicationHandler;
use Psr\Container\ContainerInterface;

/**
 * Class InstallApplicationHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallApplicationHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InstallApplicationHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        return new InstallApplicationHandler($container->get(Installer::class));
    }
}
