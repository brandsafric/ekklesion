<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Tests\Infrastructure\Filesystem;

use Ekklesion\Core\Infrastructure\Filesystem\Filename;
use PHPUnit\Framework\TestCase;

/**
 * Class FilenameTest.
 */
class FilenameTest extends TestCase
{
    private $name = '/home/userdir/someotherdir/somefile.ext';

    public function testCreationFromName(): void
    {
        $filename = Filename::makeFrom($this->name);

        $this->assertSame($this->name, (string) $filename);
    }

    public function testUniqueness(): void
    {
        $filenameOne = Filename::makeFrom($this->name)->withUniqueName();
        $filenameTwo = Filename::makeFrom($this->name)->withUniqueName();
        $this->assertNotSame((string) $filenameOne, (string) $filenameTwo);
        $this->assertNotSame($filenameOne->name(), $filenameTwo->name());
    }

    public function testPathChange(): void
    {
        $filename = Filename::makeFrom($this->name)->inPath('/games/bro');
        $this->assertSame('/games/bro/somefile.ext', (string) $filename);
        $this->assertSame('games/bro', $filename->path());
    }

    public function testExtensionChange(): void
    {
        $filename = Filename::makeFrom($this->name)->inPath('files')->withExtension('jpeg');
        $this->assertSame('/files/somefile.jpeg', $filename->__toString());
        $this->assertSame('jpeg', $filename->extension());
    }
}
