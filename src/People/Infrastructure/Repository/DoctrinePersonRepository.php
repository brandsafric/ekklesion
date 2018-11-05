<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekklesion\People\Domain\Model\Email;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Repository\PersonRepository;
use MNC\PhpDdd\Domain\Model\Collection;
use MNC\PhpDdd\Infrastructure\Domain\Model\DoctrineCollection;
use Ramsey\Uuid\Uuid;

/**
 * Class DoctrinePersonRepository.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 *
 * @method Person|null find(Uuid $uuid)
 * @method Person|null findOneByAccountId(Uuid $uuid)
 * @method Person|null findOneByEmail(Email $email)
 */
class DoctrinePersonRepository extends EntityRepository implements PersonRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $qb = $this->createQueryBuilder('p');
        $qb->orderBy('p.name.father');

        return new DoctrineCollection(new Paginator($qb->getQuery()));
    }

    /**
     * @param Uuid $id
     *
     * @return Person|null
     */
    public function ofId(Uuid $id): ?Person
    {
        return $this->find($id);
    }

    /**
     * @param Uuid ...$ids
     *
     * @return Collection
     */
    public function ofIds(Uuid ...$ids): Collection
    {
        $qb = $this->createQueryBuilder('p');
        $qb->andWhere($qb->expr()->in('p.uuid', ':ids'))
            ->setParameter('ids', $ids);

        return new DoctrineCollection(new Paginator($qb->getQuery()));
    }

    /**
     * @param Uuid $id
     *
     * @return Person|null
     */
    public function ofAccountId(Uuid $id): ?Person
    {
        return $this->findOneByAccountId($id);
    }

    /**
     * @param Email $email
     *
     * @return Person|null
     */
    public function ofEmail(Email $email): ?Person
    {
        $qb = $this->createQueryBuilder('p');
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->eq('p.emailPrimary', ':email'),
            $qb->expr()->eq('p.emailSecondary', ':email')
        ))->setParameter('email', $email);

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param string $name
     *
     * @return Collection
     */
    public function ofName(string $name): Collection
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('p.name.father', ':name'),
                $qb->expr()->like('p.name.mother', ':name'),
                $qb->expr()->like('p.name.given', ':name'),
                $qb->expr()->like('p.nickname', ':name'),
                $qb->expr()->like('p.email', ':name')
            ))
            ->setParameter('name', $name)
            ->orderBy('p.name.father');

        return new DoctrineCollection(new Paginator($qb->getQuery()));
    }

    /**
     * @param Person $person
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Person $person): void
    {
        $this->getEntityManager()->persist($person);
    }

    /**
     * @param Person $person
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Person $person): void
    {
        $this->getEntityManager()->remove($person);
    }
}
