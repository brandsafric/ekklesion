<?php

namespace Ekklesion\Core\Factory\Service;

use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Knlv\Slim\Views\TwigMessages;
use Psr\Container\ContainerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Twig\Loader\FilesystemLoader;

class TwigEnvironmentFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $cacheDir = __DIR__.'/../../../../cache/templates';
        if (!@mkdir($cacheDir, 0777, true) && !is_dir($cacheDir)) {
            throw new \RuntimeException('Directory '.$cacheDir.' does not exist');
        }
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

//        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($cacheDir), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
//            // force compilation
//            if ($file->isFile()) {
//                $twig->loadTemplate(str_replace($cacheDir.'/', '', $file));
//            }
//        }

        return $twig;
    }
}