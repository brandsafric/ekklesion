<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\CommandHandler;

use Ekklesion\Core\Domain\Command\ResetPassword;
use Ramsey\Uuid\Uuid;

/**
 * Class ResetPasswordHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ResetPasswordHandler implements AccountsAware
{
    use Accounts;

    /**
     * @param ResetPassword $command
     */
    public function __invoke(ResetPassword $command)
    {
        $account = $this->findAccountByIdOrFail(Uuid::fromString($command->accountId()));
        $account->resetPassword($command->actionToken(), $command->newPassword());
        $this->accounts->add($account);
    }
}
