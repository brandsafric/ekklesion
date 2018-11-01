<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Command;

/**
 * Class CreateAccount.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccount
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $plainPassword;

    /**
     * CreateAccount constructor.
     *
     * @param string $username
     * @param string $plainPassword
     */
    public function __construct(string $username, string $plainPassword)
    {
        $this->username = $username;
        $this->plainPassword = $plainPassword;
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
