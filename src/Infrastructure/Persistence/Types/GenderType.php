<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Persistence\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use Ekklesion\People\Domain\Model\Gender;
use InvalidArgumentException;

/**
 * Class GenderType.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class GenderType extends StringType
{
    public function getName(): string
    {
        return 'gender';
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|null
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof Gender) {
            return $value;
        }
        try {
            $uuid = Gender::fromValue($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }

        return $uuid;
    }
}
