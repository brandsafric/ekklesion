<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Domain\Command;

/**
 * Class CreateInitialAccountAndPerson.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateInitialAccountAndPerson
{
    /**
     * @var string
     */
    private $username;

    /**
     * CreateInitialAccountAndPerson constructor.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }
}
