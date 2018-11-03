<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Command;

/**
 * Class CreateFirstUser.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateFirstUser
{
    /**
     * @var string
     */
    private $given;
    /**
     * @var string
     */
    private $father;
    /**
     * @var string
     */
    private $mother;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $plainPassword;

    /**
     * CreateFirstUser constructor.
     *
     * @param string $given
     * @param string $father
     * @param string $mother
     * @param string $email
     * @param string $username
     * @param string $plainPassword
     */
    public function __construct(string $given, string $father, string $mother, string $email, string $username, string $plainPassword)
    {
        $this->given = $given;
        $this->father = $father;
        $this->mother = $mother;
        $this->email = $email;
        $this->username = $username;
        $this->plainPassword = $plainPassword;
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
     * @return string
     */
    public function mother(): string
    {
        return $this->mother;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function plainPassword(): string
    {
        return $this->plainPassword;
    }
}
