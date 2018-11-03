<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../.env');

use Cake\Chronos\Chronos;
use Cake\Chronos\DifferenceFormatter;
use Ekklesion\People\Infrastructure\Http\Controller;
use Ekklesion\People\Infrastructure\Http\Middleware\ApplicationContextMiddleware;
use Ekklesion\People\Infrastructure\Http\Middleware\AuthenticationMiddleware;
use Ekklesion\People\Infrastructure\Http\Middleware\RequiresAuthenticationMiddleware;
use Ekklesion\People\Infrastructure\Persistence\Helper\SpanishTranslator;

// Change the diff formatter in chronos
Chronos::diffFormatter(new DifferenceFormatter(new SpanishTranslator()));

$services = include __DIR__.'/../container.php';
$app = new \Slim\App($services);

// Middleware
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));
$app->add(ApplicationContextMiddleware::class);
$app->add(AuthenticationMiddleware::class);
// TODO: Installation middleware. Sets up db, church details and first user.

// Routes
$app->get('/', Controller\HomeController::class)->add(RequiresAuthenticationMiddleware::class);

// People Routes
$app->group('/people', function () use ($app) {
    $app->get('', Controller\PeopleController::class.':index');
    $app->post('', Controller\PeopleController::class.':create');
    $app->get('/new', Controller\PeopleController::class.':new');
})->add(RequiresAuthenticationMiddleware::class);

// People Api
$app->group('/api/v1/people', function () use ($app) {
    $app->get('', Controller\JsonPeopleController::class.':index');
})->add(RequiresAuthenticationMiddleware::class);

// Auth Endpoints
$app->group('/auth', function () use ($app) {
    $app->get('/login', Controller\SecurityController::class.':renderLogin');
    $app->post('/login', Controller\SecurityController::class.':doLogin');
    $app->post('/create-account', Controller\SecurityController::class.':createAccount');
    $app->post('/logout', Controller\SecurityController::class.':logout');
    $app->get('/install', Controller\SecurityController::class.':install');
    $app->post('/install', Controller\SecurityController::class.':doInstall');
});

$app->run();
