<?php

namespace Ekklesion\People\Domain\Presenter;

use Ekklesion\People\Domain\Model\Note;

/**
 * Class NotePresenter
 * @package Ekklesion\People\Domain\Presenter
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class NotePresenter
{
    /**
     * @var Note
     */
    private $note;

    /**
     * NotePresenter constructor.
     *
     * @param Note $note
     */
    public function __construct(Note $note = null)
    {
        $this->note = $note;
    }

    /**
     * @param Note $note
     *
     * @return NotePresenter
     */
    public function __invoke(Note  $note): NotePresenter
    {
        return new self($note);
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->note->uuid()->toString();
    }

    public function subjectId(): string
    {
        return $this->note->subjectId()->toString();
    }

    public function text(): string
    {
        return $this->note->text();
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->note->isPrivate();
    }

    /**
     * @return PersonPresenter
     */
    public function author(): PersonPresenter
    {
        return new PersonPresenter($this->note->author());
    }

    /**
     * @return string
     */
    public function writtenSince(): string
    {
        return $this->note->writtenOn()->diffForHumans();
    }
}