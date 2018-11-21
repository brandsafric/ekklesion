<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Command;

/**
 * Class CreateAccountForPerson.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccountForPerson
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $personId;
    /**
     * @var int
     */
    private $privileges;

    /**
     * CreateAccountForPerson constructor.
     *
     * @param string $personId
     * @param string $username
     * @param int    $privileges
     */
    public function __construct(string $personId, string $username, int $privileges)
    {
        $this->personId = $personId;
        $this->username = $username;
        $this->privileges = $privileges;
    }

    /**
     * @return string
     */
    public function personId(): string
    {
        return $this->personId;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function privileges(): int
    {
        return $this->privileges;
    }
}
