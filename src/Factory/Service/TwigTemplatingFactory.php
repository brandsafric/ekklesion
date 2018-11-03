<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Service;

use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Templating\TwigTemplating;
use Psr\Container\ContainerInterface;
use Twig\Loader\FilesystemLoader;

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
        $twigLoader = new FilesystemLoader([__DIR__.'/../../../templates']);
        $twig = new \Twig_Environment($twigLoader);
        $twig->addGlobal('context', $container->get(ApplicationContext::class));

        return new TwigTemplating($twig);
    }
}
