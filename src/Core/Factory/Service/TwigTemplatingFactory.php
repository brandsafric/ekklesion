<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\Core\Infrastructure\Templating\TwigTemplating;
use Psr\Container\ContainerInterface;

/**
 * Class TwigTemplatingFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class TwigTemplatingFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return TwigTemplating
     */
    public function __invoke(ContainerInterface $container): TwigTemplating
    {
        return new TwigTemplating($container->get(\Twig_Environment::class));
    }
}
