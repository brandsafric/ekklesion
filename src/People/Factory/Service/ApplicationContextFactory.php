<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Service;

use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Context\ApplicationSettings;
use Psr\Container\ContainerInterface;

/**
 * Class ApplicationContextFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationContextFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ApplicationContext
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ApplicationContext(
            ApplicationSettings::fromFile($container->get('settings')['people']['settings_file'])
        );
    }
}
