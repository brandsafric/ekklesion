<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Command\SeePerson;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use Ramsey\Uuid\Uuid;

/**
 * Class SeePersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class SeePersonHandler implements PeopleAware
{
    use People;

    /**
     * @param SeePerson $command
     *
     * @return PersonPresenter
     */
    public function __invoke(SeePerson $command)
    {
        $person = $this->findPersonByIdOrFail(Uuid::fromString($command->personId()));
        return new PersonPresenter($person);
    }
}
