<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use IglesiaUNO\People\Factory\Service as ServiceFactory;
use IglesiaUNO\People\Infrastructure\Templating\Templating;

return [
    'settings' => [
        'debug' => (bool) getenv('APP_DEBUG'),
        'secret' => getenv('APP_SECRET'),
        'db_url' => getenv('DATABASE_URL'),
        'env' => getenv('APP_ENV'),
        'log_path' => getenv('LOG_PATH'),
    ],

    // Services
    \Doctrine\ORM\EntityManagerInterface::class => new ServiceFactory\EntityManagerFactory(),
    \Psr\Log\LoggerInterface::class => new ServiceFactory\LoggerFactory(),
    Templating::class => new ServiceFactory\TwigTemplatingFactory(),

    // Repositories

    // Commands => Command Handlers
];
