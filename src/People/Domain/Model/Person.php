<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ekklesion\Core\Domain\Model\Account;
use Ekklesion\Core\Infrastructure\Filesystem\Filename;
use Ramsey\Uuid\Uuid;

/**
 * A Person represents someone that has attended or attends a church.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Person
{
    /**
     * @var Uuid
     */
    private $uuid;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var string|null
     */
    private $nickname;
    /**
     * @var Gender
     */
    private $gender;
    /**
     * @var PersonRole
     */
    private $role;
    /**
     * @var Filename|null
     */
    private $avatar;
    /**
     * @var Uuid|null
     */
    private $accountId;
    /**
     * @var Uuid|null
     */
    private $household;
    /**
     * @var Uuid|null
     */
    private $householdRole;
    /**
     * @var Chronos|null
     */
    private $birthday;
    /**
     * @var Email|null
     */
    private $email;
    /**
     * @var PhoneNumber|null
     */
    private $phoneNumber;
    /**
     * @var Website|null
     */
    private $facebook;
    /**
     * @var Chronos|null
     */
    private $firstVisit;
    /**
     * @var Chronos|null
     */
    private $baptizedAt;
    /**
     * @var Uuid
     */
    private $createdBy;
    /**
     * @var Chronos
     */
    private $createdAt;

    /**
     * Person constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param Name  $name
     * @param Email $email
     *
     * @return Person
     */
    public static function createInitial(Name $name, Email $email): Person
    {
        $person = new self();
        $person->uuid = Uuid::uuid4();
        $person->name = $name;
        $person->email = $email;
        $person->gender = Gender::other();
        $person->role = PersonRole::init();
        $person->createdBy = $person->uuid;
        $person->createdAt = Chronos::now();

        return $person;
    }

    /**
     * @param Uuid       $createdBy
     * @param Name       $name
     * @param Gender     $gender
     * @param PersonRole $role
     *
     * @return Person
     */
    public static function create(Uuid $createdBy, Name $name, Gender $gender, PersonRole $role): Person
    {
        $person = new self();
        $person->uuid = Uuid::uuid4();
        $person->name = $name;
        $person->gender = $gender;
        $person->role = $role;
        $person->createdBy = $createdBy;
        $person->createdAt = Chronos::now();

        return $person;
    }

    /**
     * @return Uuid
     */
    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function nickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @return Gender
     */
    public function gender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return PersonRole
     */
    public function role(): PersonRole
    {
        return $this->role;
    }

    /**
     * @return Filename|null
     */
    public function avatar(): ?Filename
    {
        return $this->avatar;
    }

    /**
     * @return Chronos|null
     */
    public function birthday(): ?Chronos
    {
        return $this->birthday;
    }

    /**
     * @return null|Uuid
     */
    public function accountId(): ?Uuid
    {
        return $this->accountId;
    }

    /**
     * @return null|Uuid
     */
    public function household(): ?Uuid
    {
        return $this->household;
    }

    /**
     * @return null|Uuid
     */
    public function householdRole(): ?Uuid
    {
        return $this->householdRole;
    }

    /**
     * @return Email|null
     */
    public function email(): ?Email
    {
        return $this->email;
    }

    /**
     * @return PhoneNumber|null
     */
    public function phoneNumber(): ?PhoneNumber
    {
        return $this->phoneNumber;
    }

    /**
     * @return Website|null
     */
    public function facebook(): ?Website
    {
        return $this->facebook;
    }

    /**
     * @return Chronos|null
     */
    public function firstVisit(): ?Chronos
    {
        return $this->firstVisit;
    }

    /**
     * @return Chronos|null
     */
    public function baptizedAt(): ?Chronos
    {
        return $this->baptizedAt;
    }

    /**
     * @return Uuid
     */
    public function createdBy(): Uuid
    {
        return $this->createdBy;
    }

    /**
     * @return Chronos
     */
    public function createdAt(): Chronos
    {
        return $this->createdAt;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function setPhoneNumber(PhoneNumber $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @param Chronos $birthday
     */
    public function setBirthday(Chronos $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @param Chronos $firstVisit
     */
    public function setFirstVisit(Chronos $firstVisit): void
    {
        $this->firstVisit = $firstVisit;
    }

    /**
     * @param Chronos $baptizedAt
     */
    public function setBaptizedAt(Chronos $baptizedAt): void
    {
        $this->baptizedAt = $baptizedAt;
    }

    /**
     * @param string $username
     * @param string $plainPassword
     *
     * @return Account
     */
    public function createAccount(string $username, string $plainPassword): Account
    {
        $account = Account::create($this->uuid, $username, $plainPassword);
        $this->accountId = $account->uuid();

        return $account;
    }
}
