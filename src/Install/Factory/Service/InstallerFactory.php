<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ekklesion\Install\Domain\Installer\Installer;
use Ekklesion\Install\Infrastructure\Installer\DoctrineInstaller;
use Psr\Container\ContainerInterface;

/**
 * Class InstallerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return DoctrineInstaller
     */
    public function __invoke(ContainerInterface $container): Installer
    {
        return new DoctrineInstaller($container->get(EntityManagerInterface::class));
    }
}
