<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Domain\Repository;

use Ekklesion\Core\Domain\Model\Account;
use MNC\PhpDdd\Domain\Model\Collection;
use Ramsey\Uuid\Uuid;

/**
 * Interface AccountRepository.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface AccountRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param Uuid $id
     *
     * @return Account|null
     */
    public function ofId(Uuid $id): ?Account;

    /**
     * @param string $username
     *
     * @return Account|null
     */
    public function ofUsername(string $username): ?Account;

    /**
     * @param Account $account
     */
    public function add(Account $account): void;

    /**
     * @param Account $account
     */
    public function remove(Account $account): void;
}
