<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use IglesiaUNO\People\Domain\Command\CreateFirstUser;
use IglesiaUNO\People\Domain\Model\Email;
use IglesiaUNO\People\Domain\Model\Name;
use IglesiaUNO\People\Domain\Model\Person;
use IglesiaUNO\People\Domain\Presenter\PersonArrayPresenter;

/**
 * Class CreateFirstUserHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateFirstUserHandler implements AccountsAware, PeopleAware
{
    use Accounts,
        People;

    /**
     * @param CreateFirstUser $command
     *
     * @return Person
     */
    public function __invoke(CreateFirstUser $command)
    {
        $email = Email::fromEmail($command->email());
        $this->ensureEmailIsUnique($email);
        $this->ensureUsernameIsUnique($command->username());

        $person = Person::createInitial(
            Name::fromParts($command->given(), $command->father(), $command->mother()),
            $email
        );
        $account = $person->createAccount($command->username(), $command->plainPassword());

        $this->people->add($person);
        $this->accounts->add($account);

        return \call_user_func(new PersonArrayPresenter(), $person);
    }
}
