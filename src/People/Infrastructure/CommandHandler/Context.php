<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Infrastructure\Context\ApplicationContext as AppContext;

/**
 * Trait Context.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait Context
{
    /**
     * @var AppContext
     */
    protected $context;

    /**
     * @param AppContext $context
     */
    public function setApplicationContext(AppContext $context): void
    {
        $this->context = $context;
    }
}
