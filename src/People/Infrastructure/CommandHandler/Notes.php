<?php

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Repository\NoteRepository;

/**
 * Trait Notes
 * @package Ekklesion\People\Infrastructure\CommandHandler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait Notes
{
    /**
     * @var NoteRepository
     */
    protected $notes;

    /**
     * @param NoteRepository $notes
     */
    public function setNotes(NoteRepository $notes): void
    {
        $this->notes = $notes;
    }
}