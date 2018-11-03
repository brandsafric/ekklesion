<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandBus;

/**
 * Interface CommandBus.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface CommandBus
{
    /**
     * @param $command
     *
     * @return mixed
     */
    public function dispatch($command);
}
