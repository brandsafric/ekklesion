<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Tests\Domain\Model;

use Ekklesion\Core\Domain\Model\Privileges;
use PHPUnit\Framework\TestCase;

/**
 * Class PrivilegesTest.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PrivilegesTest extends TestCase
{
    public function testCreateInFull(): void
    {
        $privileges = Privileges::all();

        $this->assertTrue($privileges->can(Privileges::MANAGE_NOTES));
        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->can(Privileges::MANAGE_PERMISSIONS));
    }

    public function testCreateSome(): void
    {
        $privileges = Privileges::fromValue(Privileges::MANAGE_PEOPLE);

        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_NOTES));
    }

    public function testGrantingARole(): void
    {
        $privileges = Privileges::fromValue(Privileges::MANAGE_PEOPLE);

        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_NOTES));

        $privileges = $privileges->grant(Privileges::MANAGE_NOTES);
        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->can(Privileges::MANAGE_NOTES));
    }

    public function testRemovingARole(): void
    {
        $privileges = Privileges::all();

        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->can(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->can(Privileges::MANAGE_NOTES));

        $privileges = $privileges->revoke(Privileges::MANAGE_NOTES);
        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->can(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_NOTES));
    }

    public function testValue(): void
    {
        $privileges = Privileges::all();

        $this->assertSame(7, $privileges->value());
    }

    public function testDoubleGrant(): void
    {
        $privileges = Privileges::fromValue(Privileges::MANAGE_PEOPLE);
        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_NOTES));

        $privileges = $privileges->grant(Privileges::MANAGE_NOTES)->grant(Privileges::MANAGE_NOTES);
        $this->assertTrue($privileges->can(Privileges::MANAGE_PEOPLE));
        $this->assertTrue($privileges->cannot(Privileges::MANAGE_PERMISSIONS));
        $this->assertTrue($privileges->can(Privileges::MANAGE_NOTES));
    }
}
