<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Factory\CommandHandler;

use IglesiaUNO\People\Domain\Repository\AccountRepository;
use IglesiaUNO\People\Infrastructure\CommandHandler\CreateAccountHandler;
use Psr\Container\ContainerInterface;

/**
 * Class CreateAccountHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccountHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CreateAccountHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new CreateAccountHandler();
        $handler->setAccounts($container->get(AccountRepository::class));

        return $handler;
    }
}
