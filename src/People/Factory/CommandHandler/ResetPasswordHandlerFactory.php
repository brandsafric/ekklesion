<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\AccountRepository;
use Ekklesion\People\Infrastructure\CommandHandler\ResetPasswordHandler;
use Psr\Container\ContainerInterface;

class ResetPasswordHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ResetPasswordHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new ResetPasswordHandler();
        $handler->setAccounts($container->get(AccountRepository::class));

        return $handler;
    }
}
