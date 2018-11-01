<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Presenter;

use IglesiaUNO\People\Domain\Model\Person;
use IglesiaUNO\People\Domain\Model\PersonRole;

/**
 * Class PersonArrayPresenter.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonArrayPresenter
{
    /**
     * @param Person $person
     *
     * @return array
     */
    public function __invoke(Person $person): array
    {
        $array = [];
        $array['uuid'] = $person->uuid()->toString();
        $array['name'] = [
            'given' => $person->name()->given(),
            'father' => $person->name()->father(),
            'mother' => $person->name()->mother(),
        ];
        $array['gender'] = $person->gender()->value();
        $array['roles'] = [
            'isMember' => $person->role()->is(PersonRole::MEMBER),
            'isDeacon' => $person->role()->is(PersonRole::DEACON),
            'isElder' => $person->role()->is(PersonRole::ELDER),
        ];
        $array['avatar'] = $person->avatar();
        $array['birthday'] = $person->birthday() ? $person->birthday()->format(DATE_ATOM) : null;
        $array['age'] = $person->birthday() ? $person->birthday()->diffInYears() : null;
        $array['hasAccount'] = null !== $person->accountId();
        $array['household'] = $person->household();
        $array['householdRole'] = $person->householdRole();
        $array['email'] = (string) $person->email();
        $array['phoneNumber'] = $person->phoneNumber();
        $array['facebook'] = $person->facebook();
        $array['firstVisit'] = $person->firstVisit() ? $person->firstVisit()->format(DATE_ATOM) : null;
        $array['baptizedAt'] = $person->baptizedAt() ? $person->baptizedAt()->format(DATE_ATOM) : null;
        $array['createdBy'] = $person->createdBy();
        $array['createdAt'] = $person->createdAt()->format(DATE_ATOM);

        return $array;
    }
}
