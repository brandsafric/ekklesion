<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Model\Email;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ramsey\Uuid\Uuid;

/**
 * Trait People.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait People
{
    /**
     * @var PersonRepository
     */
    protected $people;

    /**
     * @param PersonRepository $people
     */
    public function setPeople(PersonRepository $people): void
    {
        $this->people = $people;
    }

    /**
     * @param Uuid $id
     *
     * @return Person
     */
    protected function findPersonByIdOrFail(Uuid $id): Person
    {
        $person = $this->people->ofId($id);
        if ($person instanceof Person) {
            return $person;
        }
        throw new \DomainException('Person not found', 404);
    }

    /**
     * @param Uuid $accountId
     *
     * @return Person
     */
    protected function findPersonByAccountIdOrFail(Uuid $accountId): Person
    {
        $person = $this->people->ofAccountId($accountId);
        if ($person instanceof Person) {
            return $person;
        }
        throw new \DomainException('Person not found', 404);
    }

    /**
     * @param Email $email
     */
    protected function ensureEmailIsUnique(Email $email): void
    {
        $person = $this->people->ofEmail($email);
        if ($person instanceof Person) {
            throw new \DomainException('A person with this email already exists', 400);
        }
    }
}
