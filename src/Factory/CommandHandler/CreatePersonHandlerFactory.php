<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\CreatePersonHandler;
use Psr\Container\ContainerInterface;

/**
 * Class CreatePersonHandlerFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreatePersonHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CreatePersonHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $handler = new CreatePersonHandler();
        $handler->setPeople($container->get(PersonRepository::class));

        return $handler;
    }
}
