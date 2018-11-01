<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use IglesiaUNO\People\Domain\Model\Account;
use IglesiaUNO\People\Domain\Repository\AccountRepository;

/**
 * Trait AccountsTrait.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait AccountsTrait
{
    /**
     * @var AccountRepository
     */
    protected $accounts;

    /**
     * @param AccountRepository $accounts
     */
    public function setAccounts(AccountRepository $accounts): void
    {
        $this->accounts = $accounts;
    }

    /**
     * @param string $username
     *
     * @return Account
     */
    protected function findAccountByUsernameOrFail(string $username): Account
    {
        $account = $this->accounts->ofUsername($username);
        if ($account instanceof Account) {
            return $account;
        }
        throw new \DomainException('Account not found');
    }
}
