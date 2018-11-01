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
 * Class PhoneNumber.
 *
 * @author  Matías Navarro Carter <mnavarro@option.cl>
 */
class PhoneNumber
{
    /**
     * @var string
     */
    private $countryCode;
    /**
     * @var string
     */
    private $number;

    /**
     * PhoneNumber constructor.
     *
     * @param string $countryCode
     * @param string $number
     */
    private function __construct(string $countryCode, string $number)
    {
        $this->countryCode = $countryCode;
        $this->number = $this->format($number);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param string $value
     *
     * @return PhoneNumber
     */
    public static function fromValue(string $value): PhoneNumber
    {
        [$code, $area, $partOne, $partTwo] = sscanf($value, '+%s %s %s %s');

        return new self($code, $area.$partOne.$partTwo);
    }

    /**
     * @param string $countryCode
     * @param string $number
     *
     * @return PhoneNumber
     */
    public static function fromCountryCodeAndNumber(string $countryCode, string $number): PhoneNumber
    {
        return new self($countryCode, $number);
    }

    public function value(): string
    {
        return sprintf('+%s %s', $this->countryCode, $this->number);
    }

    /**
     * @param string $number
     *
     * @return string
     */
    private function format(string $number): string
    {
        $clean = preg_replace('/[\D]/', '', $number);
        Assertion::length($clean, 9);

        return sprintf('%s %s%s%s%s %s%s%s%s', ...str_split($clean));
    }
}
