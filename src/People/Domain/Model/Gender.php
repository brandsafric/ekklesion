<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Assert\Assertion;

/**
 * Class Gender.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
final class Gender
{
    private const MALE = 'male';
    private const FEMALE = 'female';

    /**
     * @var string
     */
    private $value;

    /**
     * Gender constructor.
     *
     * @param string $value
     */
    private function __construct(string $value)
    {
        Assertion::inArray($value, [self::MALE, self::FEMALE]);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @return Gender
     */
    public static function male(): Gender
    {
        return new self(self::MALE);
    }

    /**
     * @return Gender
     */
    public static function female(): Gender
    {
        return new self(self::FEMALE);
    }

    public static function fromValue(string $value): Gender
    {
        return new self($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function values(): array
    {
        return [
            self::MALE => _('Male'),
            self::FEMALE => _('Female'),
        ];
    }
}
