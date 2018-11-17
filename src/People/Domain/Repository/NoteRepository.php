<?php

namespace Ekklesion\People\Domain\Repository;

use Ekklesion\People\Domain\Model\Note;
use MNC\PhpDdd\Domain\Model\Collection;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface NoteRepository
 * @package Ekklesion\People\Domain\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface NoteRepository
{
    /**
     * @param bool $withPrivate
     *
     * @return Collection
     */
    public function all(bool $withPrivate = false): Collection;

    /**
     * @param UuidInterface $personId
     *
     * @param bool          $withPrivate
     *
     * @return Collection
     */
    public function aboutPerson(UuidInterface $personId, bool $withPrivate = false): Collection;

    /**
     * @param Note $note
     */
    public function add(Note $note): void;

    /**
     * @param Note $note
     */
    public function remove(Note $note): void;
}