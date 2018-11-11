<?php

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\Core\Infrastructure\Filesystem\Filesystem;
use Ekklesion\Core\Infrastructure\Filesystem\LocalFilesystem;
use Psr\Container\ContainerInterface;

/**
 * Class FilesystemFactory
 * @package Ekklesion\Core\Factory\Service
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class FilesystemFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Filesystem
     */
    public function __invoke(ContainerInterface $container): Filesystem
    {
        return new LocalFilesystem($container->get('settings')['core']['base_path'].'/storage');
    }
}