<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\CommandHandler;

use Ekklesion\Core\Domain\Model\PasswordGenerator;
use Ekklesion\Core\Domain\Model\Privileges;
use Ekklesion\Core\Domain\Presenter\AccountPresenter;
use Ekklesion\Core\Infrastructure\CommandHandler\Accounts;
use Ekklesion\Core\Infrastructure\CommandHandler\AccountsAware;
use Ekklesion\Install\Domain\Command\CreateInitialAccountAndPerson;
use Ekklesion\People\Domain\Model\Name;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Infrastructure\CommandHandler\People;
use Ekklesion\People\Infrastructure\CommandHandler\PeopleAware;

/**
 * Class CreateInitialAccountAndPersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateInitialAccountAndPersonHandler implements AccountsAware, PeopleAware
{
    use Accounts,
        People;

    /**
     * @param CreateInitialAccountAndPerson $command
     *
     * @return AccountPresenter
     */
    public function __invoke(CreateInitialAccountAndPerson $command)
    {
        $person = Person::createInitial(Name::fromParts('Church', 'Admin', null));
        $account = $person->createAccount($command->username(), PasswordGenerator::generate(), Privileges::all());
        $account->forcePasswordChange();

        $this->people->add($person);
        $this->accounts->add($account);

        return new AccountPresenter($account);
    }
}
