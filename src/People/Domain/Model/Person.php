<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ekklesion\Core\Infrastructure\Filesystem\Filename;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

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
     * @var Membership
     */
    private $membership;
    /**
     * @var Filename|null
     */
    private $avatar;
    /**
     * @var Account|null
     */
    private $account;
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
    private $emailPrimary;
    /**
     * @var Email|null
     */
    private $emailSecondary;
    /**
     * @var PhoneNumber|null
     */
    private $phonePrimary;
    /**
     * @var PhoneNumber|null
     */
    private $phoneSecondary;
    /**
     * @var Website|null
     */
    private $facebook;
    /**
     * @var Chronos|null
     */
    private $firstVisit;
    /**
     * @var bool|null
     */
    private $isBaptized;
    /**
     * @var Chronos|null
     */
    private $baptizedAt;
    /**
     * @var UuidInterface
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
     * @param Uuid       $createdBy
     * @param Name       $name
     * @param Gender     $gender
     * @param Membership $membership
     *
     * @return Person
     */
    public static function create(UuidInterface $createdBy, Name $name, Gender $gender, Membership $membership): Person
    {
        $person = new self();
        $person->uuid = Uuid::uuid4();
        $person->name = $name;
        $person->gender = $gender;
        $person->membership = $membership;
        $person->createdBy = $createdBy;
        $person->createdAt = Chronos::now();

        return $person;
    }

    /**
     * @param Name $name
     *
     * @return Person
     */
    public static function createInitial(Name $name): Person
    {
        $person = new self();
        $person->uuid = Uuid::uuid4();
        $person->name = $name;
        $person->gender = Gender::male();
        $person->membership = Membership::fromDates(null, null, null);
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
     * @return Membership
     */
    public function membership(): Membership
    {
        return $this->membership;
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
     * @return null|Account
     */
    public function account(): ?Account
    {
        return $this->account;
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
    public function emailPrimary(): ?Email
    {
        return $this->emailPrimary;
    }

    /**
     * @return Email|null
     */
    public function emailSecondary(): ?Email
    {
        return $this->emailSecondary;
    }

    /**
     * @return PhoneNumber|null
     */
    public function phonePrimary(): ?PhoneNumber
    {
        return $this->phonePrimary;
    }

    /**
     * @return PhoneNumber|null
     */
    public function phoneSecondary(): ?PhoneNumber
    {
        return $this->phoneSecondary;
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
     * @return bool|null
     */
    public function isBaptized(): ?bool
    {
        return $this->isBaptized;
    }

    /**
     * @return Chronos|null
     */
    public function baptizedAt(): ?Chronos
    {
        return $this->baptizedAt;
    }

    /**
     * @return UuidInterface
     */
    public function createdBy(): UuidInterface
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
     * @param Email $email
     */
    public function setEmailPrimary(Email $email): void
    {
        $this->emailPrimary = $email;
    }

    /**
     * @param Email $email
     */
    public function setEmailSecondary(Email $email): void
    {
        $this->emailSecondary = $email;
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function setPhonePrimary(PhoneNumber $phoneNumber): void
    {
        $this->phonePrimary = $phoneNumber;
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function setPhoneSecondary(PhoneNumber $phoneNumber): void
    {
        $this->phoneSecondary = $phoneNumber;
    }

    /**
     * @param Chronos $birthday
     */
    public function setBirthday(Chronos $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @param Website $website
     */
    public function setFacebook(Website $website): void
    {
        $this->facebook = $website;
    }

    /**
     * @param Chronos $firstVisit
     */
    public function setFirstVisit(Chronos $firstVisit): void
    {
        $this->firstVisit = $firstVisit;
    }

    /**
     * @param UuidInterface $personId
     * @param string        $text
     * @param bool          $isPrivate
     *
     * @return Note
     */
    public function writeNoteAbout(UuidInterface $personId, string $text, bool $isPrivate = false): Note
    {
        return Note::create($this, $personId, $text, $isPrivate);
    }

    public function markAsBaptized(): void
    {
        $this->isBaptized = true;
    }

    /**
     * @param Chronos $baptizedAt
     */
    public function setBaptizedAt(Chronos $baptizedAt): void
    {
        $this->isBaptized = true;
        $this->baptizedAt = $baptizedAt;
    }

    /**
     * @param string $username
     * @param string $plainPassword
     * @param int    $privileges
     *
     * @return Account
     */
    public function createAccount(string $username, string $plainPassword, int $privileges): Account
    {
        $this->account = Account::create($this, $username, $plainPassword, $privileges);
        return $this->account;
    }
}
