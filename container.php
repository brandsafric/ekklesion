<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ekklesion\People\Domain\Command;
use Ekklesion\People\Domain\Repository;
use Ekklesion\People\Factory\CommandHandler as HandlerFactory;
use Ekklesion\People\Factory\Http\JwtAuthenticatorFactory;
use Ekklesion\People\Factory\Http\Middleware as MiddlewareFactory;
use Ekklesion\People\Factory\Repository as RepositoryFactory;
use Ekklesion\People\Factory\Service as ServiceFactory;
use Ekklesion\People\Infrastructure\CommandBus\CommandBus;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Ekklesion\People\Infrastructure\Http\Middleware;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Ekklesion\People\Infrastructure\Templating\Templating;

return [
    'settings' => [
        'debug' => (bool) getenv('APP_DEBUG'),
        'secret' => getenv('APP_SECRET'),
        'db_url' => getenv('DATABASE_URL'),
        'env' => getenv('APP_ENV'),
        'log_path' => getenv('LOG_PATH'),
        'login_route' => '/auth/login',
        'settings_file' => __DIR__.'/settings.json',
    ],

    // Services
    \Doctrine\ORM\EntityManagerInterface::class => new ServiceFactory\EntityManagerFactory(),
    \Psr\Log\LoggerInterface::class => new ServiceFactory\LoggerFactory(),
    Templating::class => new ServiceFactory\TwigTemplatingFactory(),
    CommandBus::class => new ServiceFactory\CommandBusFactory(),
    Authenticator::class => new JwtAuthenticatorFactory(),
    ApplicationContext::class => new ServiceFactory\ApplicationContextFactory(),

    // Middleware
    Middleware\AuthenticationMiddleware::class => new MiddlewareFactory\AuthenticationMiddlewareFactory(),
    Middleware\RequiresAuthenticationMiddleware::class => new MiddlewareFactory\RequiresAuthenticationMiddlewareFactory(),
    Middleware\ApplicationContextMiddleware::class => new MiddlewareFactory\ApplicationContextMiddlewareFactory(),

    // Repositories
    Repository\AccountRepository::class => new RepositoryFactory\AccountRepositoryFactory(),
    Repository\PersonRepository::class => new RepositoryFactory\PersonRepositoryFactory(),

    // Commands => Command Handlers Factories
    Command\CreateFirstUser::class => new HandlerFactory\CreateFirstUserHandlerFactory(),

    Command\CreateAccount::class => new HandlerFactory\CreateAccountHandlerFactory(),
    Command\Login::class => new HandlerFactory\LoginHandlerFactory(),

    Command\ListPeople::class => new HandlerFactory\ListPeopleHandlerFactory(),
    Command\CreatePerson::class => new HandlerFactory\CreatePersonHandlerFactory(),
];
