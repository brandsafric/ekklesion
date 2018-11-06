<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Module\Loader;

use Ekklesion\Core\Infrastructure\Module\EkklesionModule;
use Slim\App;

/**
 * Class ApplicationLoader.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationLoader
{
    /**
     * @var EkklesionModule[]
     */
    private $modules;

    /**
     * @var string[]
     */
    private $installedModules = [];

    /**
     * ApplicationLoader constructor.
     *
     * @param EkklesionModule ...$modules
     */
    public function __construct(EkklesionModule ...$modules)
    {
        $this->modules = $modules;
    }

    /**
     * @return App
     */
    public function load(): App
    {
        // Services, Config and Resources
        $resourceLoader = new ResourceLoader();
        $middlewareLoader = new MiddlewareLoader();

        foreach ($this->modules as $module) {
            $this->installedModules[] = $module->getModuleName();
        }

        $settings = [];
        $services = [];
        foreach ($this->modules as $module) {
            $this->ensureDependenciesAreIncluded($module);
            $settings[$module->getModuleName()] = $module->getSettings();
            $services[] = $module->getServices();
            $module->loadResources($resourceLoader);
            $module->loadMiddleware($middlewareLoader);
        }
        $services = array_merge(...$services);
        $services['settings']['templates'] = $resourceLoader->getTemplates();
        $services['settings']['mappings'] = $resourceLoader->getOrmMappings();
        $services['settings']['types'] = $resourceLoader->getOrmTypes();
        $services['settings']['debug'] = (bool) getenv('APP_DEBUG');
        $services['settings']['determineRouteBeforeAppMiddleware'] = false;
        $services['settings']['installedModules'] = $this->installedModules;
        $services['settings'] = array_merge($services['settings'], $settings);

        $app = new App($services);
        foreach ($middlewareLoader->getMiddleware() as $middleware) {
            $app->add($middleware);
        }
        $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));

        $routeLoader = new RouteLoader($app);
        foreach ($this->modules as $module) {
            $module->loadRoutes($routeLoader);
        }

        return $app;
    }

    /**
     * @param EkklesionModule $module
     */
    private function ensureDependenciesAreIncluded(EkklesionModule $module): void
    {
        foreach ($module->dependentModules() as $dependentModule) {
            if (!\in_array($dependentModule, $this->installedModules, true)) {
                echo sprintf(
                    'Module "%s" requires "%s" module to work but it is not installed.',
                    $module->getModuleName(),
                    $dependentModule
                );
                exit;
            }
        }
    }
}
