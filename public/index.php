<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../.env');

use Ekklesion\Core\Infrastructure\Module\Loader\ApplicationLoader;

define('ROOT_PATH', realpath(__DIR__.'/..'));

$appLoader = new ApplicationLoader(
    new \Ekklesion\Core\CoreModule(),
    new \Ekklesion\People\PeopleModule(),
    new \Ekklesion\Install\InstallModule()
);

$appLoader->load()->run();
