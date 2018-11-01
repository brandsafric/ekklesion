<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandBus;

use League\Tactician\CommandBus as Tactician;

/**
 * Class TacticianCommandBus.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class TacticianCommandBus implements CommandBus
{
    /**
     * @var Tactician
     */
    private $tactician;

    public function __construct(Tactician $tactician)
    {
        $this->tactician = $tactician;
    }

    /**
     * @param $command
     *
     * @return mixed
     */
    public function dispatch($command)
    {
        return $this->tactician->handle($command);
    }
}
