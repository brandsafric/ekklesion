<?php

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\SeePersonHandler;
use Psr\Container\ContainerInterface;

class SeePersonHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SeePersonHandler
     */
    public function __invoke(ContainerInterface $container): SeePersonHandler
    {
        $handler = new SeePersonHandler();
        $handler->setPeople($container->get(PersonRepository::class));
        return $handler;
    }
}