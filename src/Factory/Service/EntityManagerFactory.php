<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Factory\Service;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use IglesiaUNO\People\Infrastructure\Persistence\PsrSqlLogger;
use IglesiaUNO\People\Infrastructure\Persistence\Types\ChronosType;
use IglesiaUNO\People\Infrastructure\Persistence\Types\UuidType;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $isDev = 'dev' === $container->get('settings')['env'];

        $paths = [
            __DIR__.'/../../../doctrine/mappings' => 'IglesiaUNO\People\Domain\Model',
        ];

        $config = Setup::createConfiguration($isDev);

        $driver = new SimplifiedXmlDriver($paths);
        $config->setMetadataDriverImpl($driver);

        $namingStrategy = new UnderscoreNamingStrategy();
        $config->setNamingStrategy($namingStrategy);

        $config->setSQLLogger(new PsrSqlLogger($container->get(LoggerInterface::class)));

        Type::addType('uuid', UuidType::class);
        Type::addType('chronos', ChronosType::class);

        $conn = [
            'url' => $container->get('settings')['db_url'],
        ];

        return EntityManager::create($conn, $config);
    }
}
