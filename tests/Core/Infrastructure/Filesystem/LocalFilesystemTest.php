<?php

namespace Ekklesion\Tests\Core\Infrastructure\Filesystem;

use Ekklesion\Core\Infrastructure\Filesystem\Filename;
use Ekklesion\Core\Infrastructure\Filesystem\LocalFilesystem;
use PHPUnit\Framework\TestCase;

class LocalFilesystemTest extends TestCase
{
    public static $image = 'https://avatars3.githubusercontent.com/u/17072441?s=460&v=4';
    public static $base = __DIR__.'/../../../../storage';

    public function testWritingFromUrl(): void
    {
        $files = new LocalFilesystem(self::$base);
        $filename = Filename::makeFrom(self::$image)
            ->withName('avatar')
            ->withExtension('jpeg')
            ->inPath('/images');
        $files->put($filename, self::$image);

        $this->assertFileExists($files->getBasePath().$filename);
    }

    public function testDestroy(): void
    {
        $files = new LocalFilesystem(self::$base);
        $filename = Filename::makeFrom(self::$image)
            ->withName('avatar')
            ->withExtension('jpeg')
            ->inPath('/images');

        $files->destroy($filename);

        $this->assertFileNotExists($files->getBasePath().$filename);
    }

    public function testAppending(): void
    {
        $files = new LocalFilesystem(self::$base);
        $filename = Filename::makeFrom(self::$image)
            ->inPath('/images')
            ->withName('avatar')
            ->withExtension('jpeg');

        $bytes = 0;
        $bytes += $files->put($filename, self::$image);
        $bytes += $files->put($filename, self::$image, true);

        $this->assertEquals($bytes, filesize($files->getBasePath().$filename));

        $files->destroy($filename);
    }
}
