<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Command;

/**
 * Class CreatePerson.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreatePerson
{
    /**
     * @var string
     */
    private $account;
    /**
     * @var string
     */
    private $given;
    /**
     * @var string
     */
    private $father;
    /**
     * @var string|null
     */
    private $mother;
    /**
     * @var null|string
     */
    private $nickname;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var null|string
     */
    private $birthday;
    /**
     * @var null|string
     */
    private $phonePrimary;
    /**
     * @var string|null
     */
    private $phoneSecondary;
    /**
     * @var null|string
     */
    private $emailPrimary;
    /**
     * @var null|string
     */
    private $emailSecondary;
    /**
     * @var null|string
     */
    private $facebook;
    /**
     * @var null|string
     */
    private $firstVisit;
    /**
     * @var null|string
     */
    private $baptizedAt;
    /**
     * @var null|string
     */
    private $membershipDate;
    /**
     * @var null|string
     */
    private $deaconshipDate;
    /**
     * @var null|string
     */
    private $eldershipDate;
    /**
     * @var bool
     */
    private $isBaptized;

    /**
     * CreatePerson constructor.
     *
     * @param string      $account
     * @param string      $given
     * @param string      $father
     * @param string      $gender
     * @param null|string $membershipDate
     * @param null|string $deaconshipDate
     * @param null|string $eldershipDate
     * @param string      $mother
     * @param null|string $nickname
     * @param null|string $birthday
     * @param null|string $emailPrimary
     * @param null|string $emailSecondary
     * @param null|string $phonePrimary
     * @param null|string $phoneSecondary
     * @param null|string $facebook
     * @param null|string $firstVisit
     * @param bool        $isBaptized
     * @param null|string $baptizedAt
     */
    public function __construct(
        string $account,
        string $given,
        string $father,
        ?string $mother,
        string $gender,
        ?string $membershipDate,
        ?string $deaconshipDate,
        ?string $eldershipDate,
        ?string $nickname,
        ?string $birthday,
        ?string $emailPrimary,
        ?string $emailSecondary,
        ?string $phonePrimary,
        ?string $phoneSecondary,
        ?string $facebook,
        ?string $firstVisit,
        bool $isBaptized,
        ?string $baptizedAt
    ) {
        $this->account = $account;
        $this->given = $given;
        $this->father = $father;
        $this->mother = $mother;
        $this->nickname = $nickname;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->facebook = $facebook;
        $this->firstVisit = $firstVisit;
        $this->baptizedAt = $baptizedAt;
        $this->emailPrimary = $emailPrimary;
        $this->emailSecondary = $emailSecondary;
        $this->phonePrimary = $phonePrimary;
        $this->phoneSecondary = $phoneSecondary;
        $this->membershipDate = $membershipDate;
        $this->deaconshipDate = $deaconshipDate;
        $this->eldershipDate = $eldershipDate;
        $this->isBaptized = $isBaptized;
    }

    public function account(): string
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function given(): string
    {
        return $this->given;
    }

    /**
     * @return string
     */
    public function father(): string
    {
        return $this->father;
    }

    /**
     * @return string|null
     */
    public function mother(): ?string
    {
        return $this->mother;
    }

    /**
     * @return null|string
     */
    public function nickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function gender(): string
    {
        return $this->gender;
    }

    /**
     * @return null|string
     */
    public function birthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @return null|string
     */
    public function facebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @return null|string
     */
    public function firstVisit(): ?string
    {
        return $this->firstVisit;
    }

    /**
     * @return null|string
     */
    public function baptizedAt(): ?string
    {
        return $this->baptizedAt;
    }

    /**
     * @return null|string
     */
    public function phonePrimary(): ?string
    {
        return $this->phonePrimary;
    }

    /**
     * @return null|string
     */
    public function phoneSecondary(): ?string
    {
        return $this->phoneSecondary;
    }

    /**
     * @return null|string
     */
    public function emailPrimary(): ?string
    {
        return $this->emailPrimary;
    }

    /**
     * @return null|string
     */
    public function emailSecondary(): ?string
    {
        return $this->emailSecondary;
    }

    /**
     * @return null|string
     */
    public function membershipDate(): ?string
    {
        return $this->membershipDate;
    }

    /**
     * @return null|string
     */
    public function deaconshipDate(): ?string
    {
        return $this->deaconshipDate;
    }

    /**
     * @return null|string
     */
    public function eldershipDate(): ?string
    {
        return $this->eldershipDate;
    }

    /**
     * @return bool
     */
    public function isBaptized(): bool
    {
        return $this->isBaptized;
    }
}
