<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\Persistence\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidType.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class UuidType extends GuidType
{
    public function getName(): string
    {
        return 'uuid';
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|\Ramsey\Uuid\UuidInterface
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof Uuid) {
            return $value;
        }

        return Uuid::fromString($value);
    }
}
