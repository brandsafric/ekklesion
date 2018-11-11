<?php

namespace Ekklesion\Core\Infrastructure\Filesystem;

/**
 * Interface FilesAware
 * @package Ekklesion\Core\Infrastructure\Filesystem
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface FilesAware
{
    /**
     * @param Filesystem $files
     */
    public function setFiles(Filesystem $files): void;
}