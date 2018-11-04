<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Tests\Domain\Model;

use Ekklesion\Core\Domain\Model\PasswordGenerator;
use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{
    public function testGeneration(): void
    {
        $passOne = PasswordGenerator::generate();
        $passTwo = PasswordGenerator::generate();
        $this->assertNotSame($passOne, $passTwo);
    }
}
