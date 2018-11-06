<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\Installer;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Ekklesion\Install\Domain\Installer\Installer;
use Ekklesion\Install\Domain\Installer\InstallerException;

/**
 * Class DoctrineInstaller.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class DoctrineInstaller implements Installer
{
    /**
     * @var EntityManagerInterface
     */
    public $em;
    /**
     * @var SchemaTool
     */
    public $schemaTool;

    /**
     * DoctrineInstaller constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->schemaTool = new SchemaTool($em);
    }

    public function install(): void
    {
        if (true === $this->isInstalled()) {
            throw InstallerException::alreadyInstalled();
        }

        try {
            $cache = $this->em->getConfiguration()->getMetadataCacheImpl();
            $cache->deleteAll();
            $this->schemaTool->createSchema($this->em->getMetadataFactory()->getAllMetadata());
        } catch (ToolsException $e) {
            throw InstallerException::couldNotInstall($e);
        }
    }

    /**
     * @return bool
     */
    public function isInstalled(): bool
    {
        try {
            $schemaManager = $this->em->getConnection()->getSchemaManager();

            return $schemaManager->tablesExist(['account', 'person']);
        } catch (\Exception $exception) {
            return false;
        }
    }
}
