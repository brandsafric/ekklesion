<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Model;

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
     * @var Uuid
     */
    private $personId;
    /**
     * @var HashedPassword
     */
    private $password;
    /**
     * @var Username
     */
    private $username;
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

    private function __construct()
    {
        // Use named constructor.
    }

    /**
     * @param Uuid   $personId
     * @param string $username
     * @param string $plainPassword
     *
     * @return Account
     */
    public static function create(Uuid $personId, string $username, string $plainPassword): Account
    {
        $self = new self();
        $self->uuid = Uuid::uuid4();
        $self->personId = $personId;
        $self->username = Username::create($username);
        $self->password = ArgonHashedPassword::fromPlainPassword($plainPassword);
        $self->actionToken = ActionToken::generate();
        $self->createdAt = Chronos::now();

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
     * @return Uuid
     */
    public function personId(): Uuid
    {
        return $this->personId;
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
    public function startPasswordResetProcess(): string
    {
        $this->actionToken = ActionToken::generate();

        return $this->actionToken->value();
    }

    /**
     * @param string $token
     * @param string $newPassword
     */
    public function resetPassword(string $token, string $newPassword): void
    {
        $this->actionToken->ensureTokenIsValid($token);
        $this->password = ArgonHashedPassword::fromPlainPassword($newPassword);
    }

    /**
     * @return Chronos|null
     */
    public function lastLogin(): ?Chronos
    {
        return $this->lastLogin;
    }

    public function createdAt(): Chronos
    {
        return $this->createdAt;
    }
}
