<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People;

use Ekklesion\Core\CoreModule;
use Ekklesion\Core\Infrastructure\Http\Middleware\RequiresAuthenticationMiddleware;
use Ekklesion\Core\Infrastructure\Module\EkklesionModule;
use Ekklesion\Core\Infrastructure\Module\Loader\MiddlewareLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\ResourceLoader;
use Ekklesion\Core\Infrastructure\Module\Loader\RouteLoader;
use Ekklesion\People\Domain\Command;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Factory\CommandHandler as HandlerFactory;
use Ekklesion\People\Factory\Middleware\ApplicationContextMiddlewareFactory;
use Ekklesion\People\Factory\Repository\PersonRepositoryFactory;
use Ekklesion\People\Factory\Service\ApplicationContextFactory;
use Ekklesion\People\Factory\Service\ApplicationSettingsFactory;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Context\ApplicationSettings;
use Ekklesion\People\Infrastructure\Http\Controller;
use Ekklesion\People\Infrastructure\Http\Middleware\ApplicationContextMiddleware;
use Ekklesion\People\Infrastructure\Persistence\Types\EmailType;
use Ekklesion\People\Infrastructure\Persistence\Types\GenderType;
use Ekklesion\People\Infrastructure\Persistence\Types\PhoneNumberType;
use Ekklesion\People\Infrastructure\Persistence\Types\WebsiteType;

/**
 * Class PeopleModule.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PeopleModule implements EkklesionModule
{
    public const NAME = 'people';

    public function getModuleName(): string
    {
        return self::NAME;
    }

    public function dependentModules(): array
    {
        return [
            CoreModule::NAME,
        ];
    }

    public function getServices(): array
    {
        return [
            // Services
            ApplicationContext::class => new ApplicationContextFactory(),
            ApplicationSettings::class => new ApplicationSettingsFactory(),
            ApplicationContextMiddleware::class => new ApplicationContextMiddlewareFactory(),

            // Repository
            PersonRepository::class => new PersonRepositoryFactory(),

            // Command => Command Handler
            Command\CreateFirstUser::class => new HandlerFactory\CreateFirstUserHandlerFactory(),
            Command\ListPeople::class => new HandlerFactory\ListPeopleHandlerFactory(),
            Command\CreatePerson::class => new HandlerFactory\CreatePersonHandlerFactory(),
        ];
    }

    public function getSettings(): array
    {
        return [
            'settings_file' => __DIR__.'/../../settings.json',
        ];
    }

    /**
     * @param ResourceLoader $resourceLoader
     */
    public function loadResources(ResourceLoader $resourceLoader): void
    {
        $resourceLoader->loadTemplate(self::NAME, __DIR__.'/Resources/templates');
        $resourceLoader->loadORMMapping('Ekklesion\People\Domain\Model', __DIR__.'/Resources/mappings');
        $resourceLoader->loadORMType('gender', GenderType::class);
        $resourceLoader->loadORMType('email', EmailType::class);
        $resourceLoader->loadORMType('phone', PhoneNumberType::class);
        $resourceLoader->loadORMType('website', WebsiteType::class);
    }

    /**
     * @param MiddlewareLoader $middlewareLoader
     */
    public function loadMiddleware(MiddlewareLoader $middlewareLoader): void
    {
        $middlewareLoader->load(80, ApplicationContextMiddleware::class);
    }

    /**
     * @param RouteLoader $routeLoader
     */
    public function loadRoutes(RouteLoader $routeLoader): void
    {
        $routeLoader->group('/people', function () use ($routeLoader) {
            $routeLoader->get('', Controller\PeopleController::class.':index');
            $routeLoader->post('', Controller\PeopleController::class.':create');
            $routeLoader->get('/new', Controller\PeopleController::class.':new');
        })->add(RequiresAuthenticationMiddleware::class);

        // People Api
        $routeLoader->group('/api/v1/people', function () use ($routeLoader) {
            $routeLoader->get('', Controller\JsonPeopleController::class.':index');
        })->add(RequiresAuthenticationMiddleware::class);
    }
}
