<?php

namespace Ekklesion\People\Domain\Command;

/**
 * Class CreateNote
 * @package Ekklesion\People\Domain\Command
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CreateNote
{
    /**
     * @var string
     */
    private $personId;
    /**
     * @var string
     */
    private $text;
    /**
     * @var bool
     */
    private $isPrivate;

    /**
     * CreateNote constructor.
     *
     * @param string $personId
     * @param string $text
     * @param bool   $isPrivate
     */
    public function __construct(string $personId, string $text, bool $isPrivate = false)
    {
        $this->personId = $personId;
        $this->text = $text;
        $this->isPrivate = $isPrivate;
    }

    /**
     * @return string
     */
    public function personId(): string
    {
        return $this->personId;
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
}