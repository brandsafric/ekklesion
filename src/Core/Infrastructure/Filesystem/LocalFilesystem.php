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
    public const READ = 'rb';
    public const WRITE = 'wb';
    public const APPEND = 'ab';

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

    /**
     * @param Filename $filename
     * @param          $contents
     *
     * @return int
     */
    public function write(Filename $filename, $contents): int
    {
        $this->ensureFilenameDoesNotExist($filename);
        $source = $this->openStream($contents, self::READ);
        $target = $this->openStream($filename, self::WRITE);
        if (($bytes = stream_copy_to_stream($source, $target)) === false) {
            $this->closeStreams($source, $target);
            throw FilesystemException::couldNotWrite($filename);
        }
        $this->closeStreams($source, $target);
        return $bytes;
    }

    /**
     * @param Filename $filename
     *
     * @return resource
     */
    public function read(Filename $filename)
    {
        $this->ensureFilenameExists($filename);
        return $this->openStream($filename, self::READ);
    }

    /**
     * @param Filename $filename
     * @param          $contents
     * @param bool     $append
     *
     * @return int
     */
    public function put(Filename $filename, $contents, bool $append = false): int
    {
        $source = $this->openStream($contents, self::READ);
        $mode = $append ? self::APPEND : self::WRITE;
        $target = $this->openStream($filename, $mode);
        if (($bytes = stream_copy_to_stream($source, $target, null, ftell($target))) === false) {
            $this->closeStreams($source, $target);
            throw FilesystemException::couldNotWrite($filename);
        }
        $this->closeStreams($source, $target);
        return $bytes;
    }

    /**
     * @param Filename $filename
     */
    public function destroy(Filename $filename): void
    {
        $this->ensureFilenameExists($filename);
        unlink($this->basePath.$filename);
    }

    /**
     * @param Filename $filename
     *
     * @return bool
     */
    public function has(Filename $filename): bool
    {
        return file_exists($this->basePath.$filename);
    }

    /**
     * @param Filename $filename
     */
    public function ensureFilenameExists(Filename $filename): void
    {
        if (!$this->has($filename)) {
            throw FilesystemException::inexistentFile($filename);
        }
    }

    public function ensureFilenameDoesNotExist(Filename $filename): void
    {
        if ($this->has($filename)) {
            throw FilesystemException::fileAlreadyExists($filename);
        }
    }

    /**
     * @param resource|string|Filename $contents
     * @param string                   $mode
     *
     * @return resource
     */
    private function openStream($contents, string $mode)
    {
        if (\is_resource($contents)) {
            return $contents;
        }
        if ($contents instanceof Filename) {
            $this->ensurePathExists($contents);
            return fopen($this->basePath.$contents, $mode);
        }
        if (\is_string($contents)) {
            return fopen($contents, $mode);
        }
        throw FilesystemException::couldNotOpenStream();
    }

    /**
     * @param resource ...$streams
     */
    private function closeStreams(...$streams): void
    {
        foreach ($streams as $stream) {
            fclose($stream);
        }
    }

    /**
     * @param Filename $filename
     */
    private function ensurePathExists(Filename $filename): void
    {
        $path = $this->basePath.DIRECTORY_SEPARATOR.$filename->path();
        if (!@mkdir($path, 0775, true) && !is_dir($path)) {
            throw new \RuntimeException('Cannot create folder');
        }
    }
}
