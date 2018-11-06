<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Domain\Installer;

/**
 * Class InstallerException.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallerException extends \DomainException
{
    /**
     * @return InstallerException
     */
    public static function alreadyInstalled(): InstallerException
    {
        return new self('The application is already installed', 400);
    }

    /**
     * @param \Exception $exception
     *
     * @return InstallerException
     */
    public static function couldNotInstall(\Exception $exception): InstallerException
    {
        return new self('Could not install', 500, $exception);
    }
}
