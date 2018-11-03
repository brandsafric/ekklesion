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
use Ekklesion\People\Domain\Model\Email;
use InvalidArgumentException;

/**
 * Class EmailType.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class EmailType extends StringType
{
    public function getName(): string
    {
        return 'email';
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
        if ($value instanceof Email) {
            return $value;
        }
        try {
            $email = Email::fromEmail($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }

        return $email;
    }
}
