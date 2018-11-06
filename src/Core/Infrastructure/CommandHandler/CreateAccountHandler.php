<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\CommandHandler;

use Ekklesion\Core\Domain\Command\CreateAccount;
use Ekklesion\Core\Domain\Model\Account;
use Ekklesion\Core\Domain\Presenter\AccountPresenter;

/**
 * Class CreateAccountHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccountHandler implements AccountsAware
{
    use Accounts;

    /**
     * @param CreateAccount $command
     *
     * @return AccountPresenter
     */
    public function __invoke(CreateAccount $command)
    {
        $this->ensureUsernameIsUnique($command->username());

        $account = Account::create($command->username(), $command->plainPassword());
        $this->accounts->add($account);

        return new AccountPresenter($account);
    }
}
