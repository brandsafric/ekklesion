<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once 'vendor/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

(new \Symfony\Component\Dotenv\Dotenv())->load('.env');

$container = new \Slim\Container(require 'container.php');

return ConsoleRunner::createHelperSet($container->get(EntityManagerInterface::class));
