<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Class PersonRole.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonRole
{
    public const ATTENDEE = 1;
    public const MEMBER = 2;
    public const DEACON = 4;
    public const ELDER = 8;

    /**
     * @var int
     */
    private $value;

    /**
     * PersonRole constructor.
     *
     * @param int $initialRole
     */
    private function __construct(int $initialRole)
    {
        $this->value = $initialRole;
    }

    /**
     * @return PersonRole
     */
    public static function init(): PersonRole
    {
        return new self(self::ATTENDEE);
    }

    /**
     * @param int $number
     *
     * @return PersonRole
     */
    public static function fromNumber(int $number): PersonRole
    {
        return new self($number);
    }

    /**
     * @param int $role
     *
     * @return PersonRole
     */
    public function make(int $role): PersonRole
    {
        $clone = clone $this;
        $clone->value += $role;

        return $clone;
    }

    /**
     * @param int $role
     *
     * @return bool
     */
    public function is(int $role): bool
    {
        return $this->value & $role;
    }

    /**
     * @param int $role
     */
    public function ensureIs(int $role): void
    {
        if ($this->is($role)) {
            return;
        }
        throw new \DomainException('Access denied');
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
