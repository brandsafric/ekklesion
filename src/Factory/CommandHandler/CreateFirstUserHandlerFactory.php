<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\AccountRepository;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\CreateFirstUserHandler;
use Psr\Container\ContainerInterface;

class CreateFirstUserHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CreateFirstUserHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new CreateFirstUserHandler();
        $handler->setAccounts($container->get(AccountRepository::class));
        $handler->setPeople($container->get(PersonRepository::class));

        return $handler;
    }
}
