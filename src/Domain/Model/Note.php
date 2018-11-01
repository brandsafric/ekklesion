<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;

/**
 * A Note represents a commentary on text that a Person writes about another.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Note
{
    /**
     * @var Uuid
     */
    private $uuid;
    /**
     * @var Uuid
     */
    private $authorId;
    /**
     * @var Uuid
     */
    private $subjectId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var Chronos
     */
    private $writtenOn;
}
