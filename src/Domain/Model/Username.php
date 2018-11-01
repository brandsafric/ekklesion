<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Class Username.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 * @ORM\Embeddable()
 */
class Username
{
    /**
     * @var string
     */
    private $normal;
    /**
     * @var string
     */
    private $canonical;

    /**
     * Username constructor.
     *
     * @param string $username
     */
    private function __construct(string $username)
    {
        $this->normal = $username;
        $this->canonical = mb_strtolower($username);
    }

    /**
     * @param string $username
     *
     * @return Username
     */
    public static function create(string $username): Username
    {
        return new self($username);
    }

    /**
     * @return string
     */
    public function normal(): string
    {
        return $this->normal;
    }

    /**
     * @return string
     */
    public function canonical(): string
    {
        return $this->canonical;
    }
}
