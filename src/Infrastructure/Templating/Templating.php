<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Templating;

/**
 * Interface Templating.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface Templating
{
    /**
     * @param string $template
     * @param array  $data
     *
     * @return string
     */
    public function render(string $template, array $data = []): string;
}
