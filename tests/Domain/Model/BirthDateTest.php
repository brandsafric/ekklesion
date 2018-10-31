<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Tests\Domain\Model;

use IglesiaUNO\People\Domain\Model\BirthDate;
use PHPUnit\Framework\TestCase;

/**
 * Class BirthDateTest.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class BirthDateTest extends TestCase
{
    public function testAge(): void
    {
        $birthDate = BirthDate::create(1988, 4, 5);
        $this->assertSame(30, $birthDate->age());
    }
}
