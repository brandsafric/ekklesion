<?php

namespace Ekklesion\People\Factory\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Ekklesion\People\Domain\Model\Note;
use Ekklesion\People\Domain\Repository\NoteRepository;
use Psr\Container\ContainerInterface;

/**
 * Class NoteRepositoryFactory
 * @package Ekklesion\People\Factory\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class NoteRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return NoteRepository
     */
    public function __invoke(ContainerInterface $container): NoteRepository
    {
        $manager = $container->get(EntityManagerInterface::class);
        return $manager->getRepository(Note::class);
    }
}