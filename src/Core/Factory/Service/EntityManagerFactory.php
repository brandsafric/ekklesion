<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Service;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Ekklesion\Core\Infrastructure\Persistence\PsrSqlLogger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $isDev = 'dev' === $container->get('settings')['core']['env'];

        $paths = $container->get('settings')['mappings'];

        $config = Setup::createConfiguration($isDev);

        $driver = new SimplifiedXmlDriver($paths);
        $config->setMetadataDriverImpl($driver);

        $namingStrategy = new UnderscoreNamingStrategy();
        $config->setNamingStrategy($namingStrategy);

        $config->setSQLLogger(new PsrSqlLogger($container->get(LoggerInterface::class)));

        foreach ($container->get('settings')['types'] as $name => $class) {
            Type::addType($name, $class);
        }

        $conn = [
            'url' => $container->get('settings')['core']['db_url'],
        ];

        return EntityManager::create($conn, $config);
    }
}
