<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Tests\Domain\Model;

use IglesiaUNO\People\Domain\Model\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testTextTransformation(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');

        $this->assertSame('John Peter', $name->given());
        $this->assertSame('Doe', $name->father());
        $this->assertSame('Carson', $name->mother());
    }

    public function testInformalFormatting(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');
        $this->assertSame('John Peter', $name->format(Name::FORMAT_INFORMAL));
    }

    public function testNormalFormatting(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');
        $this->assertSame('John Doe', $name->format(Name::FORMAT_NORMAL));
    }

    public function testFullFormatting(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');
        $this->assertSame('John Peter Doe Carson', $name->format(Name::FORMAT_FULL));
    }

    public function testListFormatting(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');
        $this->assertSame('Doe Carson, John Peter', $name->format(Name::FORMAT_LIST));
    }

    public function testInvalidFormattingValue(): void
    {
        $name = Name::fromParts('john peter', 'doe', 'CARSON');
        $this->expectException(\InvalidArgumentException::class);
        $name->format(6);
    }
}
