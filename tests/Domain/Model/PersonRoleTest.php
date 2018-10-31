<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Tests\Domain\Model;

use IglesiaUNO\People\Domain\Model\PersonRole;
use PHPUnit\Framework\TestCase;

class PersonRoleTest extends TestCase
{
    public function testInitialization(): void
    {
        $role = PersonRole::init();
        $this->assertTrue($role->is(PersonRole::ATTENDEE));
    }

    public function testAssigningRoles(): void
    {
        $role = PersonRole::init()->make(PersonRole::MEMBER + PersonRole::DEACON);
        $this->assertTrue($role->is(PersonRole::DEACON + PersonRole::MEMBER));
    }

    public function testDoesNotHaveRole(): void
    {
        $role = PersonRole::init()->make(PersonRole::MEMBER + PersonRole::DEACON);
        $this->assertFalse($role->is(PersonRole::ELDER));
    }

    public function testRoleIsEnsured(): void
    {
        $role = PersonRole::init()->make(PersonRole::MEMBER + PersonRole::DEACON);
        $this->expectException(\DomainException::class);
        $role->ensureIs(PersonRole::ELDER);
    }

    public function testCreateFromNumber(): void
    {
        $role = PersonRole::fromNumber(7); // Attendee, Member, Deacon
        $this->assertTrue($role->is(PersonRole::ATTENDEE + PersonRole::MEMBER + PersonRole::DEACON));
    }

    public function testValue(): void
    {
        $role = PersonRole::init();
        $this->assertSame(1, $role->value());
    }
}
