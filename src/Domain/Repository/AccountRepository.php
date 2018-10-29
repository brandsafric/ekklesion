<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Repository;

use IglesiaUNO\People\Domain\Model\Account;
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
     * @param Account $account
     */
    public function add(Account $account): void;

    /**
     * @param Account $account
     */
    public function remove(Account $account): void;
}
