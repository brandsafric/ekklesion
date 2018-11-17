<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Model\Account;
use Ekklesion\People\Domain\Repository\AccountRepository;
use Ramsey\Uuid\UuidInterface;

/**
 * Trait Accounts.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait Accounts
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
        throw new \DomainException('Account not found', 404);
    }

    /**
     * @param UuidInterface $accountId
     *
     * @return Account
     */
    protected function findAccountByIdOrFail(UuidInterface $accountId): Account
    {
        $account = $this->accounts->ofId($accountId);
        if ($account instanceof Account) {
            return $account;
        }
        throw new \DomainException('Account not found', 404);
    }

    /**
     * @param string $username
     */
    protected function ensureUsernameIsUnique(string $username): void
    {
        $account = $this->accounts->ofUsername($username);
        if ($account instanceof Account) {
            throw new \DomainException('The username is already taken');
        }
    }
}
