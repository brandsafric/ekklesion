<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Http\Middleware;

use Ekklesion\People\Infrastructure\Http\Middleware\RequiresAuthenticationMiddleware;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Psr\Container\ContainerInterface;

/**
 * Class RequiresAuthenticationMiddlewareFactory.
 */
class RequiresAuthenticationMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RequiresAuthenticationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new RequiresAuthenticationMiddleware(
            $container->get(Authenticator::class),
            $container->get('settings')['login_route']
        );
    }
}
