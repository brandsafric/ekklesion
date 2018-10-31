<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Model;

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
