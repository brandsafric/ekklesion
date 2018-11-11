<?php

namespace Ekklesion\Core\Infrastructure\Filesystem;

/**
 * Class FilesystemException
 * @package Ekklesion\Core\Infrastructure\Filesystem
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class FilesystemException extends \DomainException
{
    /**
     * @param Filename $filename
     *
     * @return FilesystemException
     */
    public static function couldNotWrite(Filename $filename): FilesystemException
    {
        return new self(sprintf('Could not write to file %s', $filename), 500);
    }

    /**
     * @return FilesystemException
     */
    public static function couldNotOpenStream(): FilesystemException
    {
        return new self('Could not open stream', 500);
    }

    /**
     * @param Filename $filename
     *
     * @return FilesystemException
     */
    public static function inexistentFile(Filename $filename): FilesystemException
    {
        return new self(sprintf('Could not read file %s. It does not exist.', $filename));
    }

    public static function fileAlreadyExists(Filename $filename): FilesystemException
    {
        return new self(sprintf('Could not write file %s. Already exists.', $filename));
    }
}