<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Domain\Installer;

/**
 * Interface Installer.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface Installer
{
    /**
     * @return void
     */
    public function install(): void;

    /**
     * @return bool
     */
    public function isInstalled(): bool;
}
