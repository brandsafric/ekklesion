<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Model;

use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * A Note represents a commentary on text that a Person writes about another.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Note
{
    /**
     * @var UuidInterface
     */
    private $uuid;
    /**
     * @var Person
     */
    private $author;
    /**
     * @var UuidInterface
     */
    private $subjectId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var bool
     */
    private $isPrivate;
    /**
     * @var Chronos
     */
    private $writtenOn;

    /**
     * @param Person        $author
     * @param UuidInterface $subjectId
     * @param string        $text
     * @param bool          $isPrivate
     *
     * @return Note
     */
    public static function create(Person $author, UuidInterface $subjectId, string $text, bool $isPrivate = false): Note
    {
        return new self($author, $subjectId, $text, $isPrivate);
    }

    /**
     * Note constructor.
     *
     * @param Person        $author
     * @param UuidInterface $subjectId
     * @param string        $text
     * @param bool          $isPrivate
     */
    private function __construct(Person $author, UuidInterface $subjectId, string $text, bool $isPrivate = false)
    {
        $this->uuid = Uuid::uuid4();
        $this->author = $author;
        $this->subjectId = $subjectId;
        $this->text = $text;
        $this->isPrivate = $isPrivate;
        $this->writtenOn = Chronos::now();
    }

    /**
     * @return UuidInterface
     */
    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @return Person
     */
    public function author(): Person
    {
        return $this->author;
    }

    /**
     * @return UuidInterface
     */
    public function subjectId(): UuidInterface
    {
        return $this->subjectId;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * @return Chronos
     */
    public function writtenOn(): Chronos
    {
        return $this->writtenOn;
    }
}
