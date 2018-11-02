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
 * Class PersonArrayPresenter.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonArrayPresenter
{
    private static $genderMap = [
        'male' => 'Masculino',
        'female' => 'Femenino',
        'other' => 'Otro',
    ];

    /**
     * @param Person $person
     *
     * @return array
     */
    public function __invoke(Person $person): array
    {
        $array = [];
        $array['_self'] = '/people/'.$person->uuid()->toString();
        $array['uuid'] = $person->uuid()->toString();
        $array['name'] = $person->name()->format(Name::FORMAT_LIST);
        $array['gender'] = self::$genderMap[$person->gender()->value()];
        $array['roles'] = [
            'isMember' => $person->role()->is(PersonRole::MEMBER),
            'isDeacon' => $person->role()->is(PersonRole::DEACON),
            'isElder' => $person->role()->is(PersonRole::ELDER),
        ];
        $array['avatar'] = $person->avatar();
        $array['birthday'] = $person->birthday() ? $person->birthday()->format(DATE_ATOM) : null;
        $array['_birthdayString'] = $person->birthday()
            ? sprintf(
                '%s (%s años)',
                $person->birthday()->format('M d'),
                $person->birthday()->diffInYears()
            )
            : 'desconocido';
        $array['age'] = $person->birthday() ? $person->birthday()->diffInYears() : null;
        $array['hasAccount'] = null !== $person->accountId();
        $array['household'] = $person->household();
        $array['householdRole'] = $person->householdRole();
        $array['email'] = (string) $person->email();
        $array['phoneNumber'] = (string) $person->phoneNumber();
        $array['facebook'] = $person->facebook();
        $array['firstVisit'] = $person->firstVisit() ? $person->firstVisit()->format(DATE_ATOM) : null;
        $array['baptizedAt'] = $person->baptizedAt() ? $person->baptizedAt()->format(DATE_ATOM) : null;
        $array['createdBy'] = $person->createdBy();
        $array['createdAt'] = $person->createdAt()->format(DATE_ATOM);

        return $array;
    }
}
