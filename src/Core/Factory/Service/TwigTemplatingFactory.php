<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\Core\Infrastructure\Templating\TwigTemplating;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Knlv\Slim\Views\TwigMessages;
use Psr\Container\ContainerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
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
        $forceReload = 'dev' === $container->get('settings')['env'];
        $cacheDir = __DIR__.'/../../../../cache/templates';
        $twigLoader = new FilesystemLoader();
        foreach ($container->get('settings')['templates'] as $namespace => $path) {
            $twigLoader->addPath($path, $namespace);
        }
        $twig = new \Twig_Environment($twigLoader, [
            'cache' => $cacheDir,
            'auto_reload' => true,
        ]);
        $twig->addExtension(new \Twig_Extensions_Extension_I18n());
        $twig->addExtension(new TwigMessages($container->get('flash')));
        $twig->addGlobal('context', $container->get(ApplicationContext::class));

        if ($forceReload) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($cacheDir), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
                // force compilation
                if ($file->isFile()) {
                    $twig->loadTemplate(str_replace($cacheDir.'/', '', $file));
                }
            }
        }

        return new TwigTemplating($twig);
    }
}
