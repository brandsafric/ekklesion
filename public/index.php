<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../.env');

use IglesiaUNO\People\Infrastructure\Http\Controller;
use IglesiaUNO\People\Infrastructure\Http\Middleware\AuthenticationMiddleware;
use IglesiaUNO\People\Infrastructure\Http\Middleware\RequiresAuthenticationMiddleware;

$services = include __DIR__.'/../container.php';
$app = new \Slim\App($services);

// Middleware
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));
$app->add(AuthenticationMiddleware::class);

// Routes
$app->get('/', Controller\HomeController::class)->add(RequiresAuthenticationMiddleware::class);

// Auth Endpoints
$app->group('/auth', function () use ($app) {
    $app->get('/login', Controller\SecurityController::class.':renderLogin');
    $app->post('/login', Controller\SecurityController::class.':doLogin');
    $app->post('/create-account', Controller\SecurityController::class.':createAccount');
    $app->post('/logout', Controller\SecurityController::class.':logout');
});

$app->run();
