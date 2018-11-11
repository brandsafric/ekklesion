<?php

namespace Ekklesion\Core\Infrastructure\Filesystem;

/**
 * Trait Files
 * @package Ekklesion\Core\Infrastructure\Filesystem
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait Files
{
    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @param Filesystem $files
     */
    public function setFiles(Filesystem $files): void
    {
        $this->files = $files;
    }
}