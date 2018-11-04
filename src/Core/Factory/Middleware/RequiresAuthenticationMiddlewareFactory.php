<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\RequiresAuthenticationMiddleware;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
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
            $container->get('settings')['core']['login_route']
        );
    }
}
