<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Class Privileges.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Privileges
{
    public const MANAGE_PEOPLE = 1;
    public const MANAGE_NOTES = 2;
    public const MANAGE_PERMISSIONS = 4;

    /**
     * @var int
     */
    private $value;

    /**
     * Privileges constructor.
     *
     * @param int $value
     */
    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return Privileges
     */
    public static function all(): Privileges
    {
        $refl = new \ReflectionClass(__CLASS__);
        $number = 0;
        foreach ($refl->getConstants() as $const) {
            $number += $const;
        }

        return new self($number);
    }

    /**
     * @param int $value
     *
     * @return Privileges
     */
    public static function fromValue(int $value): Privileges
    {
        return new self($value);
    }

    /**
     * @param int $privilege
     *
     * @return bool
     */
    public function can(int $privilege): bool
    {
        return $this->value & $privilege;
    }

    /**
     * @param int $privilege
     *
     * @return bool
     */
    public function cannot(int $privilege): bool
    {
        return !$this->can($privilege);
    }

    /**
     * @param int $privilege
     *
     * @return Privileges
     */
    public function grant(int $privilege): Privileges
    {
        if ($this->cannot($privilege)) {
            $clone = clone $this;
            $clone->value += $privilege;

            return $clone;
        }

        return $this;
    }

    /**
     * @param int $privilege
     *
     * @return Privileges
     */
    public function revoke(int $privilege): Privileges
    {
        if ($this->can($privilege)) {
            $clone = clone $this;
            $clone->value -= $privilege;

            return $clone;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
