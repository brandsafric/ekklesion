<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;

/**
 * Class Person.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Person
{
    /**
     * @var Uuid
     */
    private $uuid;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var string|null
     */
    private $avatar;
    /**
     * @var BirthDate|null
     */
    private $birthDate;
    /**
     * @var Uuid|null
     */
    private $accountId;
    /**
     * @var PersonRole
     */
    private $role;
    /**
     * @var Email|null
     */
    private $email;
    /**
     * @var PhoneNumber|null
     */
    private $phoneNumber;
    /**
     * @var Website|null
     */
    private $facebook;
    /**
     * @var Chronos|null
     */
    private $firstVisit;
    /**
     * @var Chronos|null
     */
    private $baptizedAt;
    /**
     * @var Chronos
     */
    private $addedAt;
}
