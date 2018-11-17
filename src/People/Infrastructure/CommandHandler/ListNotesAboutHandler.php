<?php

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Command\ListNotesAbout;
use Ekklesion\People\Domain\Presenter\NoteCollection;
use Ramsey\Uuid\Uuid;

/**
 * Class ListNotesAboutHandler
 * @package Ekklesion\People\Infrastructure\CommandHandler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ListNotesAboutHandler implements ContextAware, PeopleAware, NotesAware
{
    use Context,
        People,
        Notes;

    /**
     * @param ListNotesAbout $command
     *
     * @return \MNC\PhpDdd\Domain\Model\Collection
     */
    public function __invoke(ListNotesAbout $command)
    {
        $uuid = Uuid::fromString($command->personId());
        if ($this->context->personIsEqual($uuid)) {
            throw new \DomainException(sprintf('Person %s cannot see his/her own notes', $uuid));
        }

        // TODO: Rule for private notes.
        $notes = $this->notes->aboutPerson($uuid);
        return new NoteCollection($notes);
    }
}