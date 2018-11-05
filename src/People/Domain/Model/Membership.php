<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;

/**
 * Class Membership.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Membership
{
    /**
     * @var bool
     */
    private $isMember = false;
    /**
     * @var Chronos|null
     */
    private $becameMemberAt;
    /**
     * @var bool
     */
    private $isDeacon = false;
    /**
     * @var Chronos|null
     */
    private $becameDeaconAt;
    /**
     * @var bool
     */
    private $isElder = false;
    /**
     * @var Chronos|null
     */
    private $becameElderAt;

    /**
     * Membership constructor.
     *
     * @param Chronos|null $membership
     * @param Chronos|null $deaconship
     * @param Chronos|null $eldership
     */
    private function __construct(Chronos $membership = null, Chronos $deaconship = null, Chronos $eldership = null)
    {
        if (null !== $membership) {
            $this->isMember = true;
            $this->becameMemberAt = $membership;
        }
        if (null !== $deaconship) {
            $this->isDeacon = true;
            $this->becameDeaconAt = $deaconship;
        }
        if (null !== $eldership) {
            $this->isElder = true;
            $this->becameElderAt = $eldership;
        }
    }

    /**
     * @return Membership
     */
    public static function nonMember(): Membership
    {
        return new self();
    }

    /**
     * @param Chronos|null $membership
     * @param Chronos|null $deaconship
     * @param Chronos|null $eldership
     *
     * @return Membership
     */
    public static function fromDates(Chronos $membership = null, Chronos $deaconship = null, Chronos $eldership = null): Membership
    {
        return new self($membership, $deaconship, $eldership);
    }

    /**
     * @param Chronos|null $becameMemberAt
     */
    public function makeMember(Chronos $becameMemberAt = null): void
    {
        $this->isMember = true;
        $this->becameMemberAt = $becameMemberAt ?? Chronos::now();
    }

    /**
     * @param Chronos|null $becameDeaconAt
     */
    public function makeDeacon(Chronos $becameDeaconAt = null): void
    {
        $this->isDeacon = true;
        $this->becameDeaconAt = $becameDeaconAt ?? Chronos::now();
    }

    /**
     * @param Chronos $becameElderAt
     */
    public function makeElder(Chronos $becameElderAt): void
    {
        $this->isElder = true;
        $this->becameElderAt = $becameElderAt ?? Chronos::now();
    }

    /**
     * @return bool
     */
    public function isMember(): bool
    {
        return $this->isMember;
    }

    /**
     * @return Chronos|null
     */
    public function becameMemberAt(): ?Chronos
    {
        return $this->becameMemberAt;
    }

    /**
     * @return bool
     */
    public function isDeacon(): bool
    {
        return $this->isDeacon;
    }

    /**
     * @return Chronos|null
     */
    public function becameDeaconAt(): ?Chronos
    {
        return $this->becameDeaconAt;
    }

    /**
     * @return bool
     */
    public function isElder(): bool
    {
        return $this->isElder;
    }

    /**
     * @return Chronos|null
     */
    public function becameElderAt(): ?Chronos
    {
        return $this->becameElderAt;
    }
}
