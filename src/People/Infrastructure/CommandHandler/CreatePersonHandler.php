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
use Ekklesion\People\Domain\Model\Membership;
use Ekklesion\People\Domain\Model\Name;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Model\PhoneNumber;
use Ekklesion\People\Domain\Model\Website;
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

        $command->emailPrimary() && $this->ensureEmailIsUnique(Email::fromEmail($command->emailPrimary()));
        $command->emailSecondary() && $this->ensureEmailIsUnique(Email::fromEmail($command->emailSecondary()));

        $memberDate = null !== $command->membershipDate() ? Chronos::createFromFormat('d/m/Y', $command->membershipDate()) : null;
        $deaconDate = null !== $command->deaconshipDate() ? Chronos::createFromFormat('d/m/Y', $command->deaconshipDate()) : null;
        $elderDate = null !== $command->eldershipDate() ? Chronos::createFromFormat('d/m/Y', $command->eldershipDate()) : null;

        $person = Person::create(
            $person->uuid(),
            Name::fromParts($command->given(), $command->father(), $command->mother()),
            Gender::fromValue($command->gender()),
            Membership::fromDates($memberDate, $deaconDate, $elderDate)
        );

        $command->nickname()
            && $person->setNickname($command->nickname());
        $command->phonePrimary()
            && $person->setPhonePrimary(PhoneNumber::fromValue($command->phonePrimary()));
        $command->phoneSecondary()
            && $person->setPhoneSecondary(PhoneNumber::fromValue($command->phoneSecondary()));
        $command->emailPrimary()
            && $person->setEmailPrimary(Email::fromEmail($command->emailPrimary()));
        $command->emailSecondary()
            && $person->setEmailSecondary(Email::fromEmail($command->emailSecondary()));
        $command->facebook()
            && $person->setFacebook(Website::fromUrl($command->facebook()));
        $command->birthday()
            && $person->setBirthday(Chronos::createFromFormat('d/m/Y', $command->birthday()));
        $command->firstVisit()
            && $person->setFirstVisit(Chronos::createFromFormat('d/m/Y', $command->firstVisit()));
        $command->isBaptized()
            && $person->markAsBaptized();
        $command->baptizedAt()
            && $person->setBaptizedAt(Chronos::createFromFormat('d/m/Y', $command->baptizedAt()));

        $this->people->add($person);

        return new PersonPresenter($person);
    }
}
