<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\ListPeopleHandler;
use Psr\Container\ContainerInterface;

/**
 * Class ListPeopleHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ListPeopleHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ListPeopleHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new ListPeopleHandler();
        $handler->setPeople($container->get(PersonRepository::class));

        return $handler;
    }
}
