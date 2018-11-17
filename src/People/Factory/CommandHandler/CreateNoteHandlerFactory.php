<?php

namespace Ekklesion\People\Factory\CommandHandler;

use Ekklesion\People\Domain\Repository\NoteRepository;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\CommandHandler\CreateNoteHandler;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Psr\Container\ContainerInterface;

class CreateNoteHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CreateNoteHandler
     */
    public function __invoke(ContainerInterface $container): CreateNoteHandler
    {
        $handler = new CreateNoteHandler();
        $handler->setNotes($container->get(NoteRepository::class));
        $handler->setPeople($container->get(PersonRepository::class));
        $handler->setApplicationContext($container->get(ApplicationContext::class));
        return $handler;
    }
}