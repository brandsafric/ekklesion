<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Persistence\Types;

use Cake\Chronos\Chronos;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeImmutableType;

/**
 * Class ChronosType.
 */
class ChronosType extends DateTimeImmutableType
{
    public function getName(): string
    {
        return 'chronos';
    }

    /**
     * @param                  $value
     * @param AbstractPlatform $platform
     *
     * @return bool|Chronos|\DateTime|\DateTimeImmutable|false|mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof Chronos) {
            return $value;
        }

        return Chronos::createFromFormat($platform->getDateTimeFormatString(), $value);
    }
}
