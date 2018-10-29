<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../.env');

use IglesiaUNO\People\Infrastructure\Http\Controller;

$app = new \Slim\App(require __DIR__.'/../container.php');

// Middleware
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));

// Routes
$app->get('/', Controller\HomeController::class);

$app->run();
