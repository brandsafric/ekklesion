<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Filesystem;

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
     *
     * @return int
     */
    public function write(Filename $filename, $contents): int;

    /**
     * @param Filename $filename
     *
     * @return resource
     */
    public function read(Filename $filename);

    /**
     * @param Filename $filename
     * @param          $contents
     * @param bool     $append
     *
     * @return int
     */
    public function put(Filename $filename, $contents, bool $append = false): int;

    /**
     * @param Filename $filename
     *
     * @return bool
     */
    public function has(Filename $filename): bool;

    /**
     * @param Filename $filename
     */
    public function destroy(Filename $filename): void;
}
