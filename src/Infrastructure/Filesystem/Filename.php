<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Filesystem;

use Ramsey\Uuid\Uuid;

/**
 * Class Filename.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
final class Filename
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $extension;

    /**
     * Filename constructor.
     *
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->path = pathinfo(trim($name, DIRECTORY_SEPARATOR), PATHINFO_DIRNAME);
        $this->name = pathinfo($name, PATHINFO_FILENAME);
        $this->extension = pathinfo($name, PATHINFO_EXTENSION);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('/%s/%s.%s', $this->path, $this->name, $this->extension);
    }

    /**
     * @param string $originalName
     *
     * @return Filename
     */
    public static function makeFrom(string $originalName): Filename
    {
        return new self($originalName);
    }

    /**
     * @return mixed
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function extension(): string
    {
        return $this->extension;
    }

    /**
     * @return Filename
     */
    public function withUniqueName(): Filename
    {
        $clone = clone $this;
        $clone->name = Uuid::uuid4()->toString();

        return $clone;
    }

    /**
     * @param string $path
     *
     * @return Filename
     */
    public function inPath(string $path): Filename
    {
        $clone = clone $this;
        $clone->path = trim($path, DIRECTORY_SEPARATOR);

        return $clone;
    }

    /**
     * @param string $extension
     *
     * @return Filename
     */
    public function withExtension(string $extension): Filename
    {
        $clone = clone $this;
        $clone->extension = $extension;

        return $clone;
    }
}
