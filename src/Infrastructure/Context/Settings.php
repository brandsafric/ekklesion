<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Context;

/**
 * Class Settings.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Settings
{
    private static $defaults = [
        'ChurchName' => 'Some Church',
        'ChurchHtmlLongText' => 'Some<b>Church</b>',
        'ChurchHtmlShortText' => 'S<b>Ch</b>',
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
     * Settings constructor.
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
     * @return Settings
     */
    public static function fromFile(string $file): Settings
    {
        $array = json_decode($file, true);
        if (!$array) {
            $array = [];
        }

        return new self(array_merge(self::$defaults, $array), $file);
    }

    /**
     * @return string
     */
    public function getChurchName(): string
    {
        return $this->data['ChurchName'];
    }

    /**
     * @param string $churchName
     *
     * @return Settings
     */
    public function setChurchName(string $churchName): Settings
    {
        $this->data['ChurchName'] = $churchName;

        return $this;
    }

    /**
     * @return string
     */
    public function getChurchHtmlLongText(): string
    {
        return $this->data['ChurchHtmlLongText'];
    }

    /**
     * @param string $churchName
     *
     * @return Settings
     */
    public function setChurchHtmlLongText(string $churchName): Settings
    {
        $this->data['ChurchHtmlLongText'] = $churchName;

        return $this;
    }

    /**
     * @return string
     */
    public function getChurchHtmlShortText(): string
    {
        return $this->data['ChurchHtmlShortText'];
    }

    /**
     * @param string $churchName
     *
     * @return Settings
     */
    public function setChurchHtmlShortText(string $churchName): Settings
    {
        $this->data['ChurchHtmlShortText'] = $churchName;

        return $this;
    }

    public function save(): void
    {
        file_put_contents($this->file, json_encode($this->data));
    }
}
