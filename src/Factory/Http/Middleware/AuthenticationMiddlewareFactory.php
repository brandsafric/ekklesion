<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Http\Middleware;

use Ekklesion\People\Infrastructure\Http\Middleware\AuthenticationMiddleware;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Psr\Container\ContainerInterface;

/**
 * Class AuthenticationMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AuthenticationMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return AuthenticationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new AuthenticationMiddleware($container->get(Authenticator::class));
    }
}
