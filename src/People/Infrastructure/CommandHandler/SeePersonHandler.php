<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

/**
 * Class SeePersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class SeePersonHandler implements PeopleAware
{
    use People;

    public function __invoke()
    {
    }
}
