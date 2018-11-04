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
use Ekklesion\Core\Infrastructure\Module\Loader\ApplicationLoader;
use Ekklesion\Core\Infrastructure\Persistence\Helper\SpanishTranslator;

// Set language to Spanish
$locale = ['es_CL', 'es_CL.utf8', 'es_CL.UTF-8'];
putenv('LC_ALL=es_CL');
$result = setlocale(LC_ALL, $locale);
if (false === $result) {
    echo sprintf('Locale "%s" does not exist on the system', $locale);
    exit;
}

// Specify the location of the translation tables
$domain = 'messages';
$path = bindtextdomain($domain, __DIR__.'/../locale');
// Choose domain
textdomain($domain);
bind_textdomain_codeset($domain, 'UTF-8');

// Change the diff formatter in chronos
// TODO: Put some gettext magic on it
Chronos::diffFormatter(new DifferenceFormatter(new SpanishTranslator()));

$appLoader = new ApplicationLoader(
    new \Ekklesion\Core\CoreModule(),
    new \Ekklesion\People\PeopleModule()
);

$appLoader->load()->run();
