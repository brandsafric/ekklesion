<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Filesystem;

/**
 * Interface Filesystem.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface Filesystem
{
    /**
     * @return string
     */
    public function getBasePath(): string;

    /**
     * @param Filename $filename
     * @param          $contents
     */
    public function write(Filename $filename, $contents): void;

    /**
     * @param Filename $filename
     * @param          $contents
     */
    public function read(Filename $filename, $contents): void;

    /**
     * @param Filename $filename
     * @param          $contents
     */
    public function put(Filename $filename, $contents): void;
}
