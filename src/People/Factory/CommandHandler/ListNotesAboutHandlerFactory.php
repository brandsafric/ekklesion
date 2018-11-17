<?php

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\NoteRepository;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\ListNotesAboutHandler;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Psr\Container\ContainerInterface;

class ListNotesAboutHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ListNotesAboutHandler
     */
    public function __invoke(ContainerInterface $container): ListNotesAboutHandler
    {
        $handler = new ListNotesAboutHandler();
        $handler->setApplicationContext($container->get(ApplicationContext::class));
        $handler->setPeople($container->get(PersonRepository::class));
        $handler->setNotes($container->get(NoteRepository::class));
        return $handler;
    }
}