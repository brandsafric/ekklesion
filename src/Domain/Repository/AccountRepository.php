<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Repository;

use Ekklesion\People\Domain\Model\Account;
use Ekklesion\People\Domain\Model\Username;
use MNC\PhpDdd\Domain\Model\Collection;

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
