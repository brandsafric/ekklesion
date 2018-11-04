<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\CommandHandler;

use Ekklesion\Core\Domain\Command\Login;

/**
 * Class LoginHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class LoginHandler implements AccountsAware
{
    use Accounts;

    /**
     * @param Login $command
     *
     * @return string
     */
    public function __invoke(Login $command)
    {
        $account = $this->findAccountByUsernameOrFail($command->username());
        $account->login($command->plainPassword());
        $this->accounts->add($account);

        return $account->uuid()->toString();
    }
}
