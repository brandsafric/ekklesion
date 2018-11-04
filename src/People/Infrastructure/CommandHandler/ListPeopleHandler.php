<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Domain\Command\ListPeople;
use Ekklesion\People\Domain\Presenter\PeopleCollection;

/**
 * Class ListPeopleHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ListPeopleHandler implements PeopleAware
{
    use People;

    /**
     * @param ListPeople $command
     *
     * @return \MNC\PhpDdd\Domain\Model\Collection
     */
    public function __invoke(ListPeople $command)
    {
        $collection = $this->people->all();

        return new PeopleCollection($collection);
    }
}
