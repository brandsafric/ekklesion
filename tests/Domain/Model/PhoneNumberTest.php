<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Tests\Domain\Model;

use Assert\InvalidArgumentException;
use Ekklesion\People\Domain\Model\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    public function testSanitization(): void
    {
        $number = PhoneNumber::fromCountryCodeAndNumber('56', ' 9 6623-4079 ');
        $this->assertSame('+56 9 6623 4079', $number->value());
    }

    public function testThatLengthIsEnforced(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $number = PhoneNumber::fromCountryCodeAndNumber('56', ' 9 6623-409 ');
    }

    public function testCreationFromValue(): void
    {
        $number = PhoneNumber::fromValue('+56 9 6623 4079');
        $this->assertSame('+56 9 6623 4079', $number->value());
    }
}
