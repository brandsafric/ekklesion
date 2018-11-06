<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install;

use Ekklesion\Core\CoreModule;
use Ekklesion\Core\Infrastructure\Module\EkklesionModule;
use Ekklesion\Core\Infrastructure\Module\Loader\MiddlewareLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\ResourceLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\RouteLoader;
use Ekklesion\Install\Domain\Command\CreateInitialAccountAndPerson;
use Ekklesion\Install\Domain\Command\InstallApplication;
use Ekklesion\Install\Domain\Installer\Installer;
use Ekklesion\Install\Factory\CommandHandler\CreateInitialAccountAndPersonHandlerFactory;
use Ekklesion\Install\Factory\CommandHandler\InstallApplicationHandlerFactory;
use Ekklesion\Install\Factory\Middleware\InstallCheckerMiddlewareFactory;
use Ekklesion\Install\Factory\Middleware\InstallConfigMiddlewareFactory;
use Ekklesion\Install\Factory\Middleware\InstallErrorHandlerMiddlewareFactory;
use Ekklesion\Install\Factory\Service\InstallerFactory;
use Ekklesion\Install\Infrastructure\Http\Controller\InstallationController;
use Ekklesion\Install\Infrastructure\Http\Middleware\InstallCheckerMiddleware;
use Ekklesion\Install\Infrastructure\Http\Middleware\InstallConfigMiddleware;
use Ekklesion\Install\Infrastructure\Http\Middleware\InstallErrorHandlerMiddleware;
use Ekklesion\People\PeopleModule;

/**
 * Class InstallModule.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallModule implements EkklesionModule
{
    public const NAME = 'install';

    public function getModuleName(): string
    {
        return self::NAME;
    }

    public function dependentModules(): array
    {
        return [
            CoreModule::NAME,
            PeopleModule::NAME,
        ];
    }

    public function getServices(): array
    {
        return [
            // Service
            Installer::class => new InstallerFactory(),

            // Middleware
            InstallCheckerMiddleware::class => new InstallCheckerMiddlewareFactory(),
            InstallConfigMiddleware::class => new InstallConfigMiddlewareFactory(),
            InstallErrorHandlerMiddleware::class => new InstallErrorHandlerMiddlewareFactory(),

            // Command Handler
            InstallApplication::class => new InstallApplicationHandlerFactory(),
            CreateInitialAccountAndPerson::class => new CreateInitialAccountAndPersonHandlerFactory(),
        ];
    }

    public function getSettings(): array
    {
        return [];
    }

    public function loadResources(ResourceLoader $resourceLoader): void
    {
        $resourceLoader->loadTemplate(self::NAME, __DIR__.'/Resources/templates');
    }

    public function loadMiddleware(MiddlewareLoader $middlewareLoader): void
    {
        $middlewareLoader->load(600, InstallErrorHandlerMiddleware::class);
        $middlewareLoader->load(500, InstallConfigMiddleware::class);
        $middlewareLoader->load(400, InstallCheckerMiddleware::class);
    }

    /**
     * @param RouteLoader $routeLoader
     */
    public function loadRoutes(RouteLoader $routeLoader): void
    {
        $routeLoader->get('/install', InstallationController::class.':install');
        $routeLoader->post('/install', InstallationController::class.':doInstall');
    }
}
