<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Cake\Chronos\Chronos;
use Ekklesion\People\Domain\Command\CreatePerson;
use Ekklesion\People\Domain\Model\Email;
use Ekklesion\People\Domain\Model\Gender;
use Ekklesion\People\Domain\Model\Name;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Model\PersonRole;
use Ekklesion\People\Domain\Model\PhoneNumber;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use Ramsey\Uuid\Uuid;

/**
 * Class CreatePersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreatePersonHandler implements PeopleAware
{
    use People;

    /**
     * @param CreatePerson $command
     *
     * @return mixed
     */
    public function __invoke(CreatePerson $command)
    {
        $person = $this->findPersonByAccountIdOrFail(Uuid::fromString($command->account()));
        $command->email() && $this->ensureEmailIsUnique(Email::fromEmail($command->email()));

        $person = Person::create(
            $person->uuid(),
            Name::fromParts($command->given(), $command->father(), $command->mother()),
            Gender::fromValue($command->gender()),
            PersonRole::fromNumber($command->role())
        );

        $command->nickname()
            && $person->setNickname($command->nickname());
        $command->phone()
            && $person->setPhoneNumber(PhoneNumber::fromCountryCodeAndNumber('+56', $command->phone()));
        $command->email()
            && $person->setEmail(Email::fromEmail($command->email()));
        $command->birthday()
            && $person->setBirthday(Chronos::createFromFormat('', $command->birthday()));
        $command->firstVisit()
            && $person->setFirstVisit(Chronos::createFromFormat('', $command->firstVisit()));
        $command->baptizedAt()
            && $person->setBaptizedAt(Chronos::createFromFormat('', $command->baptizedAt()));

        $this->people->add($person);

        return \call_user_func(new PersonPresenter(), $person);
    }
}
