<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';
chdir(__DIR__.'/../');

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../.env');

use Ekklesion\Core\Infrastructure\Module\Loader\ApplicationLoader;

$appLoader = new ApplicationLoader(
    new \Ekklesion\Core\CoreModule([
        'secret' => getenv('APP_SECRET'),
        'locale' => getenv('LOCALE'),
        'base_path' => getcwd(),
        'log_path' => 'php://stderr'
    ]),
    new \Ekklesion\People\PeopleModule([
        'allow_private_notes' => true
    ]),
    new \Ekklesion\Install\InstallModule()
);

$appLoader->load()->run();
