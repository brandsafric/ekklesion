<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Command;

/**
 * Class SeePerson.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class SeePerson
{
    /**
     * @var string
     */
    private $personId;

    /**
     * SeePerson constructor.
     *
     * @param string $personId
     */
    public function __construct(string $personId)
    {
        $this->personId = $personId;
    }

    /**
     * @return string
     */
    public function personId(): string
    {
        return $this->personId;
    }
}
