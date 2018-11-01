<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use IglesiaUNO\People\Domain\Repository\AccountRepository;

/**
 * Interface AccountsAware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface AccountsAware
{
    /**
     * @param AccountRepository $accounts
     */
    public function setAccounts(AccountRepository $accounts): void;
}
