<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Middleware;

use Ekklesion\Core\Domain\Repository\AccountRepository;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Http\Middleware\ApplicationContextMiddleware;
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
