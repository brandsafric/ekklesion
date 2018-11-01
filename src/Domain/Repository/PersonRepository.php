<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Repository;

use Ekklesion\People\Domain\Model\Email;
use Ekklesion\People\Domain\Model\Person;
use MNC\PhpDdd\Domain\Model\Collection;
use Ramsey\Uuid\Uuid;

/**
 * Interface PersonRepository.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface PersonRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param Uuid $id
     *
     * @return Person|null
     */
    public function ofId(Uuid $id): ?Person;

    /**
     * @param Uuid $id
     *
     * @return Person|null
     */
    public function ofAccountId(Uuid $id): ?Person;

    /**
     * @param Email $email
     *
     * @return Person|null
     */
    public function ofEmail(Email $email): ?Person;

    /**
     * @param Person $person
     */
    public function add(Person $person): void;

    /**
     * @param Person $person
     */
    public function remove(Person $person): void;
}
