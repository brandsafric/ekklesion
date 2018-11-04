<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Tests\Domain\Model;

use Cake\Chronos\Chronos;
use Ekklesion\Core\Domain\Model\Account;
use Ekklesion\Core\Domain\Model\Username;
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
        $account = Account::create(Uuid::uuid4(), 'username', 'password');
        $account->changePassword('password', 'newPassword');
        $account->login('newPassword');
        $this->assertNotNull($account->lastLogin());
    }

    public function testWrongPasswordInChangingFails(): void
    {
        $account = Account::create(Uuid::uuid4(), 'username', 'password');
        $this->expectException(\DomainException::class);
        $account->changePassword('wrongPassword', 'newPassword');
    }

    public function testPasswordCanBeResseted(): void
    {
        $account = Account::create(Uuid::uuid4(), 'username', 'password');
        $token = $account->startPasswordResetProcess();
        $account->resetPassword($token, 'newPassword');
        $account->login('newPassword');
        $this->assertNotNull($account->lastLogin());
    }

    public function testAccessors(): void
    {
        $account = Account::create(Uuid::uuid4(), 'username', 'password');
        $this->assertInstanceOf(Chronos::class, $account->createdAt());
        $this->assertInstanceOf(Username::class, $account->username());
        $this->assertInstanceOf(Uuid::class, $account->uuid());
    }
}
