<?php

namespace Ekklesion\Tests\People\Domain\Model;

use Ekklesion\People\Domain\Model\Gender;
use Ekklesion\People\Domain\Model\Membership;
use Ekklesion\People\Domain\Model\Name;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Model\Privileges;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class PersonTest
 * @package Ekklesion\Tests\People\Domain\Model
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonTest extends TestCase
{
    public function testThatPersonCanBeCreated(): void
    {
        $person = Person::create(
            Uuid::uuid4(),
            Name::fromParts('John', 'Doe', null),
            Gender::male(),
            Membership::nonMember()
        );

        $this->assertNull($person->account());
    }

    public function testThatAccountCanBeCreatedFromPerson()
    {
        $person = Person::create(
            Uuid::uuid4(),
            Name::fromParts('John', 'Doe', null),
            Gender::male(),
            Membership::nonMember()
        );

        $account = $person->createAccount('username', 'some-password', 15);

        $this->assertEquals('username', $account->username()->canonical());
    }
}
