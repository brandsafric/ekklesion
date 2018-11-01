<?php

/*
 * This file is part of the Ekklesion\People project.
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
     * @var string
     */
    private $gender;
    /**
     * @var int
     */
    private $role;
    /**
     * @var null|string
     */
    private $birthday;
    /**
     * @var null|string
     */
    private $email;
    /**
     * @var null|string
     */
    private $phone;
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
     * CreatePerson constructor.
     *
     * @param string      $account
     * @param string      $given
     * @param string      $father
     * @param string      $mother
     * @param string      $gender
     * @param int         $role
     * @param null|string $birthday
     * @param null|string $email
     * @param null|string $phone
     * @param null|string $facebook
     * @param null|string $firstVisit
     * @param null|string $baptizedAt
     */
    public function __construct(
        string $account,
        string $given,
        string $father,
        ?string $mother,
        string $gender,
        int $role,
        ?string $birthday,
        ?string $email,
        ?string $phone,
        ?string $facebook,
        ?string $firstVisit,
        ?string $baptizedAt
    ) {
        $this->account = $account;
        $this->given = $given;
        $this->father = $father;
        $this->mother = $mother;
        $this->gender = $gender;
        $this->role = $role;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->phone = $phone;
        $this->facebook = $facebook;
        $this->firstVisit = $firstVisit;
        $this->baptizedAt = $baptizedAt;
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
     * @return string
     */
    public function gender(): string
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function role(): int
    {
        return $this->role;
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
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function phone(): ?string
    {
        return $this->phone;
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
}
