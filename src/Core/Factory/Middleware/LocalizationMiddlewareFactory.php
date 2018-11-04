<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Middleware;

use Ekklesion\Core\Infrastructure\Http\Middleware\LocalizationMiddleware;
use Psr\Container\ContainerInterface;

/**
 * Class LocalizationMiddlewareFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class LocalizationMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LocalizationMiddleware
     */
    public function __invoke(ContainerInterface $container)
    {
        $locale = $container->get('settings')['core']['locale'];
        $path = ROOT_PATH.'/locale';

        return new LocalizationMiddleware($path, $locale);
    }
}
