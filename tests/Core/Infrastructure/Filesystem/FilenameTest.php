<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Tests\People\Infrastructure\Filesystem;

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
        $this->assertNotEquals((string) $filenameOne, (string) $filenameTwo);
        $this->assertNotEquals($filenameOne->name(), $filenameTwo->name());
    }

    public function testPathChange(): void
    {
        $filename = Filename::makeFrom($this->name)->inPath('/games/bro');
        $this->assertEquals('/games/bro/somefile.ext', (string) $filename);
        $this->assertEquals('games/bro', $filename->path());
    }

    public function testExtensionChange(): void
    {
        $filename = Filename::makeFrom($this->name)->inPath('files')->withExtension('jpeg');
        $this->assertEquals('/files/somefile.jpeg', $filename->__toString());
        $this->assertEquals('jpeg', $filename->extension());
    }
}
