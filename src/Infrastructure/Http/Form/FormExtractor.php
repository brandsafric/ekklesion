<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Form;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FormExtractor.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class FormExtractor
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * FormExtractor constructor.
     *
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return null
     */
    public function get(string $key, $default = null)
    {
        if (isset($this->request->getParsedBody()[$key])) {
            return $this->request->getParsedBody()[$key];
        }

        return $default;
    }

    /**
     * @param string $key
     *
     * @return int
     */
    public function getInt(string $key): int
    {
        return (int) $this->get($key);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function getBool(string $key): bool
    {
        return (bool) $this->get($key);
    }
}
