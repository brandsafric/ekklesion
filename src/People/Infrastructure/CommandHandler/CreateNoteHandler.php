<?php

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Command\CreateNote;
use Ekklesion\People\Domain\Model\Note;
use Ekklesion\People\Domain\Presenter\NotePresenter;
use Ramsey\Uuid\Uuid;

/**
 * Class CreateNoteHandler
 * @package Ekklesion\People\Infrastructure\CommandHandler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateNoteHandler implements PeopleAware, ContextAware, NotesAware
{
    use People,
        Context,
        Notes;

    /**
     * @param CreateNote $command
     *
     * @return NotePresenter
     */
    public function __invoke(CreateNote $command)
    {
        $authorId = Uuid::fromString($this->context->activePerson()->uuid());
        $subjectId = Uuid::fromString($command->personId());

        if ($authorId->equals($subjectId)) {
            throw new \DomainException(_('You cannot write notes about yourself!'));
        }

        $author = $this->findPersonByIdOrFail($authorId);
        $subject = $this->findPersonByIdOrFail($subjectId);

        $note = new Note($author, $subject->uuid(), $command->text(), $command->isPrivate());

        $this->notes->add($note);

        return new NotePresenter($note);
    }
}