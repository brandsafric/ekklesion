<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Context;

/**
 * Class ApplicationSettings.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationSettings
{
    private static $defaults = [
        'ChurchName' => 'Some Church',
        'ChurchHtmlLongText' => 'Some<b>Church</b>',
        'ChurchHtmlShortText' => 'S<b>Ch</b>',
        'DatabaseEngine' => 'mysql',
        'DatabaseHost' => 'localhost',
        'DatabaseName' => 'ekklesion',
        'DatabaseUser' => 'root',
        'DatabasePass' => 'root',
        'DatabasePort' => 3306,
    ];

    /**
     * @var string
     */
    private $file;
    /**
     * @var array
     */
    private $data;

    /**
     * ApplicationSettings constructor.
     *
     * @param array  $data
     * @param string $file
     */
    private function __construct(array $data, string $file)
    {
        $this->file = $file;
        $this->data = $data;
    }

    /**
     * @param string $file
     *
     * @return ApplicationSettings
     */
    public static function fromFile(string $file): ApplicationSettings
    {
        if (!file_exists($file) || !($array = json_decode(file_get_contents($file), true))) {
            $array = [];
        }

        return new self(array_merge(self::$defaults, $array), $file);
    }

    /**
     * @param string $churchName
     *
     * @return string
     */
    public function churchName(string $churchName = null): ?string
    {
        if (null !== $churchName) {
            $this->data['ChurchName'] = $churchName;

            return null;
        }

        return $this->data['ChurchName'];
    }

    /**
     * @param string $churchHtmlLongText
     *
     * @return string
     */
    public function churchHtmlLongText(string $churchHtmlLongText = null): ?string
    {
        if (null !== $churchHtmlLongText) {
            $this->data['ChurchHtmlLongText'] = $churchHtmlLongText;

            return null;
        }

        return $this->data['ChurchHtmlLongText'];
    }

    /**
     * @param string|null $churchHtmlShortText
     *
     * @return string
     */
    public function churchHtmlShortText(string $churchHtmlShortText = null): ?string
    {
        if (null !== $churchHtmlShortText) {
            $this->data['ChurchHtmlShortText'] = $churchHtmlShortText;

            return null;
        }

        return $this->data['ChurchHtmlShortText'];
    }

    /**
     * @param string|null $databaseHost
     *
     * @return string
     */
    public function databaseHost(string $databaseHost = null): ?string
    {
        if (null !== $databaseHost) {
            $this->data['DatabaseHost'] = $databaseHost;

            return null;
        }

        return $this->data['DatabaseHost'];
    }

    /**
     * @param string|null $databaseName
     *
     * @return string
     */
    public function databaseName(string $databaseName = null): ?string
    {
        if (null !== $databaseName) {
            $this->data['DatabaseName'] = $databaseName;

            return null;
        }

        return $this->data['DatabaseName'];
    }

    /**
     * @param string|null $databaseUser
     *
     * @return string
     */
    public function databaseUser(string $databaseUser = null): ?string
    {
        if (null !== $databaseUser) {
            $this->data['DatabaseUser'] = $databaseUser;

            return null;
        }

        return $this->data['DatabaseUser'];
    }

    /**
     * @param string|null $databasePass
     *
     * @return string
     */
    public function databasePass(string $databasePass = null): ?string
    {
        if (null !== $databasePass) {
            $this->data['DatabasePass'] = $databasePass;

            return null;
        }

        return $this->data['DatabasePass'];
    }

    /**
     * @param string|null $databasePort
     *
     * @return string
     */
    public function databasePort(string $databasePort = null): ?string
    {
        if (null !== $databasePort) {
            $this->data['DatabasePort'] = $databasePort;

            return null;
        }

        return $this->data['DatabasePort'];
    }

    /**
     * @param string|null $databaseEngine
     *
     * @return string
     */
    public function databaseEngine(string $databaseEngine = null): ?string
    {
        if (null !== $databaseEngine) {
            $this->data['DatabaseEngine'] = $databaseEngine;

            return null;
        }

        return $this->data['DatabaseEngine'];
    }

    public function save(): void
    {
        file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT));
    }
}
