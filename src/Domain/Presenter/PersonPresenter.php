<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Presenter;

use Ekklesion\People\Domain\Model\Name;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Model\PersonRole;

/**
 * Class PersonPresenter.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonPresenter
{
    /**
     * @var Person
     */
    private $person;

    /**
     * PersonPresenter constructor.
     *
     * @param Person $person
     */
    public function __construct(Person $person = null)
    {
        $this->person = $person;
    }

    /**
     * @param Person $person
     *
     * @return PersonPresenter
     */
    public function __invoke(Person $person): PersonPresenter
    {
        return new self($person);
    }

    public function link(): string
    {
        return sprintf('/people/%s', $this->person->uuid());
    }

    public function listName(): string
    {
        return $this->person->name()->format(Name::FORMAT_LIST);
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->person->email();
    }

    public function phone(): string
    {
        return $this->person->phoneNumber() ?? '---';
    }

    public function birthday(bool $withAge = true): string
    {
        if (null === $this->person->birthday()) {
            return '---';
        }
        $string = sprintf('%s', $this->person->birthday()->format('d M'));
        if (true === $withAge) {
            $string = sprintf('%s (%s)', $string, $this->age());
        }

        return $string;
    }

    /**
     * @return array
     */
    public function roles(): array
    {
        $roles = [];
        if ($this->person->role()->is(PersonRole::ELDER)) {
            $roles[] = 'Anciano';
        }
        if ($this->person->role()->is(PersonRole::DEACON)) {
            $roles[] = 'Diácono';
        }
        if ($this->person->role()->is(PersonRole::MEMBER)) {
            $roles[] = 'Miembro';
        }
        if ($this->person->role()->is(PersonRole::ATTENDEE)) {
            $roles[] = 'Asistente';
        }

        return $roles;
    }

    public function age(): string
    {
        if (null !== $this->person->birthday()) {
            return $this->person->birthday()->diffInYears().' años';
        }

        return 'Desconocida';
    }
}
