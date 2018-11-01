<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

/**
 * Class ArgonHashedPassword.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 * @ORM\Embeddable()
 */
class ArgonHashedPassword implements HashedPassword
{
    /**
     * @var string
     */
    private $hash;

    /**
     * ArgonHashedPassword constructor.
     *
     * @param string $plainPassword
     */
    private function __construct(string $plainPassword)
    {
        $this->hash = $this->hash($plainPassword);
    }

    /**
     * @param string $plainPassword
     *
     * @return HashedPassword
     */
    public static function fromPlainPassword(string $plainPassword): HashedPassword
    {
        return new self($plainPassword);
    }

    /**
     * @param string $plainPassword
     *
     * @return bool
     */
    public function isValid(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hash);
    }

    /**
     * @param string $plainPassword
     *
     * @throws \DomainException on invalid password
     */
    public function ensurePasswordIsValid(string $plainPassword): void
    {
        if ($this->isValid($plainPassword)) {
            return;
        }
        throw new \DomainException('The provided password is not valid', 401);
    }

    /**
     * @param string $plainPassword
     *
     * @return string
     */
    private function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_ARGON2I);
    }
}
