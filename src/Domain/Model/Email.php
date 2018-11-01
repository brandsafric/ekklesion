<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Assert\Assertion;

/**
 * Class Email.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Email
{
    /**
     * @var string
     */
    private $canonical;

    /**
     * Email constructor.
     *
     * @param string $email
     */
    private function __construct(string $email)
    {
        Assertion::email($email);
        $this->canonical = mb_strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param string $email
     *
     * @return Email
     */
    public static function fromEmail(string $email): Email
    {
        return new self($email);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->canonical;
    }
}
