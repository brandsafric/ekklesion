<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;

/**
 * Class Account.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Account
{
    /**
     * @var Uuid
     */
    private $uuid;
    /**
     * @var Person $person
     */
    private $person;
    /**
     * @var HashedPassword
     */
    private $password;
    /**
     * @var Username
     */
    private $username;
    /**
     * @var Privileges
     */
    private $privileges;
    /**
     * @var ActionToken
     */
    private $actionToken;
    /**
     * @var Chronos|null
     */
    private $lastLogin;
    /**
     * @var Chronos
     */
    private $createdAt;
    /**
     * @var bool
     */
    private $requiresPasswordChange;

    private function __construct()
    {
        // Use named constructor.
    }

    /**
     * @param Person     $person
     * @param string     $username
     * @param string     $plainPassword
     * @param Privileges $privileges
     *
     * @return Account
     */
    public static function create(Person $person, string $username, string $plainPassword, Privileges $privileges): Account
    {
        $self = new self();
        $self->uuid = Uuid::uuid4();
        $self->person = $person;
        $self->username = Username::create($username);
        $self->password = ArgonHashedPassword::fromPlainPassword($plainPassword);
        $self->actionToken = ActionToken::generate();
        $self->privileges = $privileges;
        $self->createdAt = Chronos::now();
        $self->requiresPasswordChange = false;

        return $self;
    }

    /**
     * @return Uuid
     */
    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @return Username
     */
    public function username(): Username
    {
        return $this->username;
    }

    /**
     * @param string $password
     */
    public function login(string $password): void
    {
        $this->password->ensurePasswordIsValid($password);
        $this->lastLogin = Chronos::now();
    }

    /**
     * @return Person
     */
    public function person(): Person
    {
        return $this->person;
    }

    /**
     * @param string $oldPassword
     * @param string $newPassword
     */
    public function changePassword(string $oldPassword, string $newPassword): void
    {
        $this->password->ensurePasswordIsValid($oldPassword);
        $this->password = ArgonHashedPassword::fromPlainPassword($newPassword);
    }

    /**
     * @return string
     */
    public function actionToken(): string
    {
        return $this->actionToken->value();
    }

    /**
     * @return string
     */
    public function startPasswordResetProcess(): string
    {
        $this->actionToken = ActionToken::generate();

        return $this->actionToken->value();
    }

    /**
     * @return bool
     */
    public function doesRequirePasswordChange(): bool
    {
        return $this->requiresPasswordChange;
    }

    /**
     * @return Privileges
     */
    public function privileges(): Privileges
    {
        return $this->privileges;
    }

    /**
     * @param string $token
     * @param string $newPassword
     */
    public function resetPassword(string $token, string $newPassword): void
    {
        $this->actionToken->ensureTokenIsValid($token);
        $this->password = ArgonHashedPassword::fromPlainPassword($newPassword);
        $this->requiresPasswordChange = false;
    }

    /**
     * @return Chronos|null
     */
    public function lastLogin(): ?Chronos
    {
        return $this->lastLogin;
    }

    public function forcePasswordChange(): void
    {
        $this->requiresPasswordChange = true;
    }

    public function createdAt(): Chronos
    {
        return $this->createdAt;
    }
}
