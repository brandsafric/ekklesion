<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;

/**
 * Class ActionToken.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 * @ORM\Embeddable()
 */
class ActionToken
{
    public const EXPIRES = '+4 hours';

    /**
     * @var string
     */
    private $value;
    /**
     * @var Chronos
     */
    private $expires;

    /**
     * ActionToken constructor.
     *
     * @param string $expires
     */
    private function __construct(string $expires)
    {
        $this->generateToken($expires);
    }

    /**
     * @param string $expires
     *
     * @return ActionToken
     */
    public static function generate(string $expires = self::EXPIRES): ActionToken
    {
        return new self($expires);
    }

    public function isValid(string $token): bool
    {
        return $token === $this->value;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires->lt(Chronos::now());
    }

    /**
     * @param string $token
     */
    public function ensureTokenIsValid(string $token): void
    {
        if (!$this->isValid($token)) {
            throw new \DomainException('The provided token is invalid');
        }
        if ($this->isExpired()) {
            throw new \DomainException('The provided token has expired');
        }
        $this->generateToken(self::EXPIRES);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /** @noinspection PhpDocMissingThrowsInspection */

    /**
     * @param string $expires
     */
    private function generateToken(string $expires): void
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        $this->value = bin2hex(random_bytes(32));
        $this->expires = new Chronos($expires);
    }
}
