<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Class Name.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Name
{
    public const FORMAT_INFORMAL = 0;   // Only given name
    public const FORMAT_NORMAL = 1;     // First given and father
    public const FORMAT_FULL = 2;       // All components
    public const FORMAT_LIST = 3;       // All components, surname first

    /**
     * @var array
     */
    private $given;
    /**
     * @var string
     */
    private $father;
    /**
     * @var string|null
     */
    private $mother;

    /**
     * Name constructor.
     *
     * @param array       $given
     * @param string      $father
     * @param null|string $mother
     */
    private function __construct(array $given, string $father, ?string $mother)
    {
        $this->given = $this->capitalize($given);
        $this->father = $this->capitalize($father);
        $this->mother = $this->capitalize($mother);
    }

    /**
     * @param string      $given
     * @param null|string $father
     * @param null|string $mother
     *
     * @return Name
     */
    public static function fromParts(string $given, ?string $father, ?string $mother): Name
    {
        return new self(explode(' ', $given), $father, $mother);
    }

    public function given(): string
    {
        return implode(' ', $this->given);
    }

    public function father(): string
    {
        return $this->father;
    }

    public function mother(): ?string
    {
        return $this->mother;
    }

    public function format(int $format = 2): string
    {
        switch ($format) {
            case self::FORMAT_INFORMAL:
                return sprintf('%s', $this->given());
            case self::FORMAT_NORMAL:
                return sprintf('%s %s', $this->given[0], $this->father);
            case self::FORMAT_FULL:
                return sprintf('%s %s %s', $this->given(), $this->father, $this->mother);
            case self::FORMAT_LIST:
                return sprintf('%s %s, %s', $this->father, $this->mother, $this->given());
            default:
                throw new \InvalidArgumentException('Invalid format constant value.');
        }
    }

    /**
     * @param $part
     *
     * @return array|string
     */
    private function capitalize($part)
    {
        if (\is_array($part)) {
            $names = [];
            foreach ($part as $name) {
                $names[] = $this->capitalize($name);
            }

            return $names;
        }

        return ucfirst(mb_strtolower(trim($part)));
    }
}
