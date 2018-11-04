<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Persistence\Helper;

/**
 * Basic spanish 'translator' for diffForHumans().
 */
class SpanishTranslator
{
    /**
     * Translation strings.
     *
     * @var array
     */
    public static $strings = [
        'year' => '1 año',
        'year_plural' => '{count} años',
        'month' => '1 mes',
        'month_plural' => '{count} meses',
        'week' => '1 semana',
        'week_plural' => '{count} semanas',
        'day' => '1 día',
        'day_plural' => '{count} días',
        'hour' => '1 hora',
        'hour_plural' => '{count} horas',
        'minute' => '1 minuto',
        'minute_plural' => '{count} minutos',
        'second' => '1 segundo',
        'second_plural' => '{count} segundos',
        'ago' => 'hace {time}',
        'from_now' => 'en {time}',
        'after' => '{time} después',
        'before' => '{time} antes',
    ];

    /**
     * Check if a translation key exists.
     *
     * @param string $key the key to check
     *
     * @return bool whether or not the key exists
     */
    public function exists($key)
    {
        return isset(static::$strings[$key]);
    }

    /**
     * Get a plural message.
     *
     * @param string $key   the key to use
     * @param int    $count the number of items in the translation
     * @param array  $vars  additional context variables
     *
     * @return string the translated message or ''
     */
    public function plural($key, $count, array $vars = [])
    {
        if (1 === $count) {
            return $this->singular($key, $vars);
        }

        return $this->singular($key.'_plural', ['count' => $count] + $vars);
    }

    /**
     * Get a singular message.
     *
     * @param string $key  the key to use
     * @param array  $vars additional context variables
     *
     * @return string the translated message or ''
     */
    public function singular($key, array $vars = [])
    {
        if (isset(static::$strings[$key])) {
            $varKeys = array_keys($vars);
            foreach ($varKeys as $i => $k) {
                $varKeys[$i] = '{'.$k.'}';
            }

            return str_replace($varKeys, $vars, static::$strings[$key]);
        }

        return '';
    }
}
