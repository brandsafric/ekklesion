<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Factory\Http;

use IglesiaUNO\People\Infrastructure\Http\Security\Authenticator;
use IglesiaUNO\People\Infrastructure\Http\Security\JwtAuthenticator;
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
