<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Factory\CommandHandler;

use Ekklesion\Core\Domain\Repository\AccountRepository;
use Ekklesion\Install\Infrastructure\CommandHandler\CreateInitialAccountAndPersonHandler;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Psr\Container\ContainerInterface;

/**
 * Class CreateInitialAccountAndPersonHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateInitialAccountAndPersonHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CreateInitialAccountAndPersonHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new CreateInitialAccountAndPersonHandler();
        $handler->setPeople($container->get(PersonRepository::class));
        $handler->setAccounts($container->get(AccountRepository::class));

        return $handler;
    }
}
