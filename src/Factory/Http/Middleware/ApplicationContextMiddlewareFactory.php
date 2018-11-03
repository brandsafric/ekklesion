<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Http\Middleware;

use Ekklesion\People\Domain\Repository\AccountRepository;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Http\Middleware\ApplicationContextMiddleware;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Psr\Container\ContainerInterface;

/**
 * Class ApplicationContextMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationContextMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ApplicationContextMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ApplicationContextMiddleware(
            $container->get(Authenticator::class),
            $container->get(PersonRepository::class),
            $container->get(AccountRepository::class),
            $container->get(ApplicationContext::class)
        );
    }
}
