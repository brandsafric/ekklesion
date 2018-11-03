<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Repository\AccountRepository;

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
