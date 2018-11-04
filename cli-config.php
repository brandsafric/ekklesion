<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once 'vendor/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Ekklesion\Core\Infrastructure\Module\Loader\ApplicationLoader;

(new \Symfony\Component\Dotenv\Dotenv())->load('.env');

$appLoader = new ApplicationLoader(
    new \Ekklesion\Core\CoreModule(),
    new Ekklesion\People\PeopleModule()
);

$app = $appLoader->load();

return ConsoleRunner::createHelperSet($app->getContainer()->get(EntityManagerInterface::class));
