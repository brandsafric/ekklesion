<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Filesystem;

/**
 * Class LocalFilesystem.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class LocalFilesystem implements Filesystem
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * LocalFilesystem constructor.
     *
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function write(Filename $filename, $contents): void
    {
        // TODO: Implement write() method.
    }

    public function read(Filename $filename, $contents): void
    {
        // TODO: Implement read() method.
    }

    public function put(Filename $filename, $contents): void
    {
        // TODO: Implement put() method.
    }
}
