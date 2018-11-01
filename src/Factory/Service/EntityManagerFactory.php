<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Service;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Ekklesion\People\Infrastructure\Persistence\PsrSqlLogger;
use Ekklesion\People\Infrastructure\Persistence\Types\ChronosType;
use Ekklesion\People\Infrastructure\Persistence\Types\EmailType;
use Ekklesion\People\Infrastructure\Persistence\Types\FilenameType;
use Ekklesion\People\Infrastructure\Persistence\Types\GenderType;
use Ekklesion\People\Infrastructure\Persistence\Types\PhoneNumberType;
use Ekklesion\People\Infrastructure\Persistence\Types\UuidType;
use Ekklesion\People\Infrastructure\Persistence\Types\WebsiteType;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $isDev = 'dev' === $container->get('settings')['env'];

        $paths = [
            __DIR__.'/../../../doctrine/mappings' => 'Ekklesion\People\Domain\Model',
        ];

        $config = Setup::createConfiguration($isDev);

        $driver = new SimplifiedXmlDriver($paths);
        $config->setMetadataDriverImpl($driver);

        $namingStrategy = new UnderscoreNamingStrategy();
        $config->setNamingStrategy($namingStrategy);

        $config->setSQLLogger(new PsrSqlLogger($container->get(LoggerInterface::class)));

        Type::addType('uuid', UuidType::class);
        Type::addType('chronos', ChronosType::class);
        Type::addType('gender', GenderType::class);
        Type::addType('email', EmailType::class);
        Type::addType('filename', FilenameType::class);
        Type::addType('phone', PhoneNumberType::class);
        Type::addType('website', WebsiteType::class);

        $conn = [
            'url' => $container->get('settings')['db_url'],
        ];

        return EntityManager::create($conn, $config);
    }
}
