<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Service;

/**
 * Class PasswordGenerator.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PasswordGenerator
{
    protected static $names = [
        'john-calvin', 'martin-luther', 'ulrich-zwingli', 'karl-barth',
        'herman-dooyeweerd', 'abraham-kuyper', 'john-owen', 'john-knox',
        'john-wycliffe', 'thomas-aquinas', 'augustine-of-hippo', 'charles-spurgeon',
        'martyn-lloyd-jones',
    ];

    public static function generate(): string
    {
        return sprintf(
            '%s-%s%s',
            self::$names[array_rand(self::$names)],
            \random_int(0, 9),
            \random_int(0, 9)
        );
    }
}
