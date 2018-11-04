<?php

/*
 * This file is part of the Ekklesion project.
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
    public function __invoke(Person  $person): PersonPresenter
    {
        return new self($person);
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->person->uuid()->toString();
    }

    /**
     * @return string
     */
    public function avatar(): string
    {
        return $this->person->avatar() ? '/storage'.$this->person->avatar() : '/build/images/avatar.jpg';
    }

    public function createdAt(): string
    {
        return $this->person->createdAt()->format('d/m/Y');
    }

    /**
     * @return bool
     */
    public function hasAccount(): bool
    {
        return null !== $this->person->accountId();
    }

    public function gender(): string
    {
        return $this->person->gender()->values()[$this->person->gender()->value()];
    }

    public function link(): string
    {
        return sprintf('/people/%s', $this->person->uuid());
    }

    public function listName(): string
    {
        return $this->person->name()->format(Name::FORMAT_LIST);
    }

    public function shortName(): string
    {
        return $this->person->name()->format(Name::FORMAT_NORMAL);
    }

    public function fullName(): string
    {
        return $this->person->name()->format(Name::FORMAT_FULL);
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
            $roles[] = _('Elder');
        }
        if ($this->person->role()->is(PersonRole::DEACON)) {
            $roles[] = _('Deacon');
        }
        if ($this->person->role()->is(PersonRole::MEMBER)) {
            $roles[] = _('Member');
        }
        if ($this->person->role()->is(PersonRole::ATTENDEE)) {
            $roles[] = _('Attendee');
        }

        return $roles;
    }

    /**
     * @return string
     */
    public function age(): string
    {
        if (null !== $this->person->birthday()) {
            return $this->person->birthday()->diffInYears().' años';
        }

        return 'Desconocida';
    }

    /**
     * @return string
     */
    public function nickname(): string
    {
        return $this->person->nickname() ?? '---';
    }
}
