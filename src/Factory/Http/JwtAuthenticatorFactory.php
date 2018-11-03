<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Http;

use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Ekklesion\People\Infrastructure\Http\Security\JwtAuthenticator;
use Psr\Container\ContainerInterface;

/**
 * Class JwtAuthenticatorFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class JwtAuthenticatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Authenticator
     */
    public function __invoke(ContainerInterface $container): Authenticator
    {
        return new JwtAuthenticator($container->get('settings')['secret'], '_iup');
    }
}
