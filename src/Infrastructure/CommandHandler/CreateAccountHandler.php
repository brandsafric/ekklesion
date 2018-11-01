<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use IglesiaUNO\People\Domain\Command\CreateAccount;
use IglesiaUNO\People\Domain\Model\Account;
use IglesiaUNO\People\Domain\Presenter\AccountArrayPresenter;

/**
 * Class CreateAccountHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccountHandler implements AccountsAware
{
    use AccountsTrait;

    /**
     * @param CreateAccount $command
     *
     * @return Account
     */
    public function __invoke(CreateAccount $command)
    {
        $account = Account::create($command->username(), $command->plainPassword());
        $this->accounts->add($account);

        return \call_user_func(new AccountArrayPresenter(), $account);
    }
}
