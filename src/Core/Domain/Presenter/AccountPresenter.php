<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Domain\Presenter;

use Ekklesion\Core\Domain\Model\Account;

/**
 * Class AccountPresenter.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AccountPresenter
{
    /**
     * @var Account
     */
    private $account;

    /**
     * AccountPresenter constructor.
     *
     * @param Account|null $account
     */
    public function __construct(Account $account = null)
    {
        $this->account = $account;
    }

    /**
     * @param Account $account
     *
     * @return AccountPresenter
     */
    public function __invoke(Account $account): AccountPresenter
    {
        return new self($account);
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->account->uuid()->toString();
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->account->username()->canonical();
    }

    /**
     * @return string
     */
    public function lastLoginAt(): string
    {
        if (null === $this->account->lastLogin()) {
            return 'No registrado';
        }

        return $this->account->lastLogin()->format('d/m/Y a las h:m');
    }

    /**
     * @return string
     */
    public function lastLoginDiff(): string
    {
        if (null === $this->account->lastLogin()) {
            return 'No registrado';
        }

        return $this->account->lastLogin()->diffForHumans();
    }

    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->account->createdAt()->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function createdAtDiff(): string
    {
        return $this->account->createdAt()->diffForHumans();
    }
}
