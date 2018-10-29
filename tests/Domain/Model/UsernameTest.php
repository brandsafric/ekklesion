<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Tests\Domain\Model;

use IglesiaUNO\People\Domain\Model\Username;
use PHPUnit\Framework\TestCase;

/**
 * Class UsernameTest.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class UsernameTest extends TestCase
{
    public function testCanonicalAndNormal(): void
    {
        $username = Username::create('USERNAME');
        $this->assertSame('USERNAME', $username->normal());
        $this->assertSame('username', $username->canonical());
    }
}
