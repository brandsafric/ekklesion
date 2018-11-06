<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\ForcedPasswordChangeMiddleware;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Psr\Container\ContainerInterface;

/**
 * Class ForcedPasswordChangeMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ForcedPasswordChangeMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ForcedPasswordChangeMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ForcedPasswordChangeMiddleware(
            $container->get(ApplicationContext::class)
        );
    }
}
