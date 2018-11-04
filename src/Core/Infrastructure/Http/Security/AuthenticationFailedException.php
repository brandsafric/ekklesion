<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Security;

/**
 * Class AuthenticationFailedException.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AuthenticationFailedException extends \RuntimeException
{
    /**
     * @return AuthenticationFailedException
     */
    public static function create(): AuthenticationFailedException
    {
        return new self('Credentials not present', 401);
    }
}
