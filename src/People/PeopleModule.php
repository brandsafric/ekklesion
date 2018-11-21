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
use Ekklesion\People\Domain\Repository;
use Ekklesion\People\Factory\CommandHandler as HandlerFactory;
use Ekklesion\People\Factory\Middleware\ApplicationContextMiddlewareFactory;
use Ekklesion\People\Factory\Repository as RepositoryFactory;
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
    /**
     * @var array
     */
    private $settings;

    /**
     * PeopleModule constructor.
     *
     * @param array $settings
     */
    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

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
            Repository\AccountRepository::class => new RepositoryFactory\AccountRepositoryFactory(),
            Repository\PersonRepository::class => new RepositoryFactory\PersonRepositoryFactory(),
            Repository\NoteRepository::class => new RepositoryFactory\NoteRepositoryFactory(),

            // Command => Command Handler
            Command\CreateAccountForPerson::class => new HandlerFactory\CreateAccountForPersonHandlerFactory(),
            Command\Login::class => new HandlerFactory\LoginHandlerFactory(),
            Command\ResetPassword::class => new HandlerFactory\ResetPasswordHandlerFactory(),
            Command\CreateFirstUser::class => new HandlerFactory\CreateFirstUserHandlerFactory(),

            Command\ListPeople::class => new HandlerFactory\ListPeopleHandlerFactory(),
            Command\SeePerson::class => new HandlerFactory\SeePersonHandlerFactory(),
            Command\CreatePerson::class => new HandlerFactory\CreatePersonHandlerFactory(),

            Command\CreateNote::class => new HandlerFactory\CreateNoteHandlerFactory(),
            Command\ListNotesAbout::class => new HandlerFactory\ListNotesAboutHandlerFactory(),
        ];
    }

    public function getSettings(): array
    {
        return $this->settings;
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
     * @param RouteLoader $loader
     */
    public function loadRoutes(RouteLoader $loader): void
    {
        $loader->get('/auth/reset-password/{id}', Controller\SecurityController::class.':resetPassword');
        $loader->post('/auth/reset-password/{id}', Controller\SecurityController::class.':doResetPassword');

        // Auth Endpoints
        $loader->group('/auth', function () use ($loader) {
            $loader->get('/login', Controller\SecurityController::class.':renderLogin');
            $loader->post('/login', Controller\SecurityController::class.':doLogin');
            $loader->post('/create-account', Controller\SecurityController::class.':createAccount');
            $loader->post('/logout', Controller\SecurityController::class.':logout');
        });

        // People Endpoints
        $loader->group('/people', function () use ($loader) {
            $loader->get('', Controller\PeopleController::class.':index');
            $loader->post('', Controller\PeopleController::class.':create');
            $loader->get('/new', Controller\PeopleController::class.':new');
            $loader->get('/{id}', Controller\PeopleController::class.':show');
            $loader->post('/{id}/notes', Controller\PeopleController::class.':newNote');
            $loader->post('/{id}/create-account', Controller\PeopleController::class.':createAccount');
        })->add(RequiresAuthenticationMiddleware::class);

        // People Api
        $loader->group('/api/v1/people', function () use ($loader) {
            $loader->get('', Controller\JsonPeopleController::class.':index');
        })->add(RequiresAuthenticationMiddleware::class);
    }
}
