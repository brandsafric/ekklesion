<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\CommandHandler;

use Ekklesion\Install\Domain\Command\InstallApplication;
use Ekklesion\Install\Domain\Installer\Installer;

/**
 * Class InstallApplicationHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallApplicationHandler
{
    /**
     * @var Installer
     */
    private $installer;

    /**
     * InstallApplicationHandler constructor.
     *
     * @param Installer $installer
     */
    public function __construct(Installer $installer)
    {
        $this->installer = $installer;
    }

    /**
     * @param InstallApplication $command
     */
    public function __invoke(InstallApplication $command)
    {
        $this->installer->install();
    }
}
