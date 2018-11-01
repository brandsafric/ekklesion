<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use Cake\Chronos\Chronos;
use IglesiaUNO\People\Domain\Command\CreatePerson;
use IglesiaUNO\People\Domain\Model\Email;
use IglesiaUNO\People\Domain\Model\Gender;
use IglesiaUNO\People\Domain\Model\Name;
use IglesiaUNO\People\Domain\Model\Person;
use IglesiaUNO\People\Domain\Model\PersonRole;
use IglesiaUNO\People\Domain\Model\PhoneNumber;
use IglesiaUNO\People\Domain\Presenter\PersonArrayPresenter;
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
        $person = $this->findByAccountIdOrFail(Uuid::fromString($command->account()));
        $command->email() && $this->ensureEmailIsUnique(Email::fromEmail($command->email()));

        $person = Person::create(
            $person->uuid(),
            Name::fromParts($command->given(), $command->father(), $command->mother()),
            Gender::fromValue($command->gender()),
            PersonRole::fromNumber($command->role())
        );

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

        return \call_user_func(new PersonArrayPresenter(), $person);
    }
}
