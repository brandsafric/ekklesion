<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\Core\Infrastructure\Http\Middleware\NotFoundHandler;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\Core\Infrastructure\Templating\Templating;
use Psr\Container\ContainerInterface;

/**
 * Class NotFoundHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class NotFoundHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new NotFoundHandler(
            $container->get(Templating::class),
            $container->get(Authenticator::class)
        );
    }
}
