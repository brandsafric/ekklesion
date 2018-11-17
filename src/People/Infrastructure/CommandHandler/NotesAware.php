<?php

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Repository\NoteRepository;

/**
 * Interface NotesAware
 * @package Ekklesion\People\Infrastructure\CommandHandler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface NotesAware
{
    /**
     * @param NoteRepository $notes
     */
    public function setNotes(NoteRepository $notes): void;
}