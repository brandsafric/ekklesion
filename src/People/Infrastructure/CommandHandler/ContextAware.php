<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\CommandHandler;

use Ekklesion\People\Infrastructure\Context\ApplicationContext;

/**
 * Interface ContextAware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface ContextAware
{
    /**
     * @param ApplicationContext $context
     */
    public function setApplicationContext(ApplicationContext $context): void;
}
