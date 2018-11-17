<?php

namespace Ekklesion\People\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekklesion\People\Domain\Model\Note;
use Ekklesion\People\Domain\Repository\NoteRepository;
use MNC\PhpDdd\Domain\Model\Collection;
use MNC\PhpDdd\Infrastructure\Domain\Model\DoctrineCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * Class DoctrineNoteRepository
 * @package Ekklesion\People\Infrastructure\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class DoctrineNoteRepository extends EntityRepository implements NoteRepository
{
    /**
     * @param bool $withPrivate
     *
     * @return Collection
     */
    public function all(bool $withPrivate = false): Collection
    {
        $qb = $this->createQueryBuilder('n');

        $withPrivate && $qb->andWhere($qb->expr()->eq('n.isPrivate', true));

        $qb->orderBy('n.writtenOn', 'ASC');

        return new DoctrineCollection(new Paginator($qb->getQuery()));
    }

    /**
     * @param UuidInterface $personId
     * @param bool          $withPrivate
     *
     * @return Collection
     */
    public function aboutPerson(UuidInterface $personId, bool $withPrivate = false): Collection
    {
        $qb = $this->createQueryBuilder('n');

        $qb->andWhere($qb->expr()->eq('n.subjectId', ':personId'))
            ->setParameter('personId', $personId);
        $withPrivate && $qb->andWhere($qb->expr()->eq('n.isPrivate', true));

        $qb->orderBy('n.writtenOn', 'ASC');

        return new DoctrineCollection(new Paginator($qb->getQuery()));
    }

    /**
     * @param Note $note
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Note $note): void
    {
        $this->getEntityManager()->persist($note);
    }

    /**
     * @param Note $note
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Note $note): void
    {
        $this->getEntityManager()->remove($note);
    }
}