<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Model;

use Assert\Assertion;

/**
 * Class Website.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Website
{
    /**
     * @var string
     */
    private $url;

    private function __construct(string $url)
    {
        Assertion::url($url);
        $this->url = $url;
    }

    /**
     * @param string $url
     *
     * @return Website
     */
    public static function fromUrl(string $url): Website
    {
        new self($url);
    }

    public function url(): string
    {
        return $this->url;
    }
}
