<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Tests\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ekklesion\People\Domain\Model\Account;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Model\Privileges;
use Ekklesion\People\Domain\Model\Username;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class AccountTest.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AccountTest extends TestCase
{
    public function testAccountPasswordCanBeChanged(): void
    {
        $person = $this->createMock(Person::class);
        $account = Account::create($person, 'username', 'password', 15);
        $account->changePassword('password', 'newPassword');
        $account->login('newPassword');
        $this->assertNotNull($account->lastLogin());
    }

    public function testWrongPasswordInChangingFails(): void
    {
        $person = $this->createMock(Person::class);
        $account = Account::create($person, 'username', 'password', 15);
        $this->expectException(\DomainException::class);
        $account->changePassword('wrongPassword', 'newPassword');
    }

    public function testPasswordCanBeResseted(): void
    {
        $person = $this->createMock(Person::class);
        $account = Account::create($person, 'username', 'password', 15);
        $token = $account->startPasswordResetProcess();
        $account->resetPassword($token, 'newPassword');
        $account->login('newPassword');
        $this->assertNotNull($account->lastLogin());
    }

    public function testAccessors(): void
    {
        $person = $this->createMock(Person::class);
        $account = Account::create($person, 'username', 'password', 15);
        $this->assertInstanceOf(Chronos::class, $account->createdAt());
        $this->assertInstanceOf(Username::class, $account->username());
        $this->assertInstanceOf(Uuid::class, $account->uuid());
    }
}
