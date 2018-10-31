<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\CommandHandler;

use IglesiaUNO\People\Domain\Command\CreatePerson;

/**
 * Class CreatePersonHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreatePersonHandler
{
    /**
     * @param CreatePerson $command
     */
    public function __invoke(CreatePerson $command)
    {
    }
}
