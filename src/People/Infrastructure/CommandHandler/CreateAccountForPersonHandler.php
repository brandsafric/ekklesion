<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Command\CreateAccountForPerson;
use Ekklesion\People\Domain\Model\Account;
use Ekklesion\People\Domain\Model\PasswordGenerator;
use Ekklesion\People\Domain\Model\Privileges;
use Ekklesion\People\Domain\Presenter\AccountPresenter;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use Ramsey\Uuid\Uuid;

/**
 * Class CreateAccountForPersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateAccountForPersonHandler implements AccountsAware, PeopleAware
{
    use Accounts,
        People;

    /**
     * @param CreateAccountForPerson $command
     *
     * @return PersonPresenter
     */
    public function __invoke(CreateAccountForPerson $command)
    {
        $person = $this->findPersonByIdOrFail(Uuid::fromString($command->personId()));
        $this->ensureUsernameIsUnique($command->username());

        $account = $person->createAccount(
            $command->username(),
            PasswordGenerator::generate(),
            $command->privileges()
        );

        $this->people->add($person);

        return new PersonPresenter($account);
    }
}
