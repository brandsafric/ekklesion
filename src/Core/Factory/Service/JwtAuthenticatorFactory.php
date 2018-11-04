<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\Core\Infrastructure\Http\Security\JwtAuthenticator;
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
        return new JwtAuthenticator($container->get('settings')['core']['secret'], '_iup');
    }
}
