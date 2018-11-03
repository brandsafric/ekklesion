<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Interface HashedPassword.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface HashedPassword
{
    /**
     * @param string $plainPassword
     *
     * @return HashedPassword
     */
    public static function fromPlainPassword(string $plainPassword): HashedPassword;

    /**
     * @param string $plainPassword
     *
     * @return bool
     */
    public function isValid(string $plainPassword): bool;

    /**
     * @param string $plainPassword
     *
     * @throws \DomainException on invalid password
     */
    public function ensurePasswordIsValid(string $plainPassword): void;
}
