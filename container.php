<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use IglesiaUNO\People\Domain\Command;
use IglesiaUNO\People\Domain\Repository;
use IglesiaUNO\People\Factory\CommandHandler as HandlerFactory;
use IglesiaUNO\People\Factory\Http\JwtAuthenticatorFactory;
use IglesiaUNO\People\Factory\Http\Middleware as MiddlewareFactory;
use IglesiaUNO\People\Factory\Repository as RepositoryFactory;
use IglesiaUNO\People\Factory\Service as ServiceFactory;
use IglesiaUNO\People\Infrastructure\CommandBus\CommandBus;
use IglesiaUNO\People\Infrastructure\Http\Middleware;
use IglesiaUNO\People\Infrastructure\Http\Security\Authenticator;
use IglesiaUNO\People\Infrastructure\Templating\Templating;

return [
    'settings' => [
        'debug' => (bool) getenv('APP_DEBUG'),
        'secret' => getenv('APP_SECRET'),
        'db_url' => getenv('DATABASE_URL'),
        'env' => getenv('APP_ENV'),
        'log_path' => getenv('LOG_PATH'),
        'login_route' => '/auth/login',
    ],

    // Services
    \Doctrine\ORM\EntityManagerInterface::class => new ServiceFactory\EntityManagerFactory(),
    \Psr\Log\LoggerInterface::class => new ServiceFactory\LoggerFactory(),
    Templating::class => new ServiceFactory\TwigTemplatingFactory(),
    CommandBus::class => new ServiceFactory\CommandBusFactory(),
    Authenticator::class => new JwtAuthenticatorFactory(),

    // Middleware
    Middleware\AuthenticationMiddleware::class => new MiddlewareFactory\AuthenticationMiddlewareFactory(),
    Middleware\RequiresAuthenticationMiddleware::class => new MiddlewareFactory\RequiresAuthenticationMiddlewareFactory(),

    // Repositories
    Repository\AccountRepository::class => new RepositoryFactory\AccountRepositoryFactory(),

    // Commands => Command Handlers Factories
    Command\Login::class => new HandlerFactory\LoginHandlerFactory(),
    Command\CreateAccount::class => new HandlerFactory\CreateAccountHandlerFactory(),
];
