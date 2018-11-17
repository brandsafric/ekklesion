<?php

namespace Ekklesion\People\Domain\Command;

/**
 * Class ListNotesAbout
 * @package Ekklesion\People\Domain\Command
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ListNotesAbout
{
    /**
     * @var string
     */
    private $personId;

    /**
     * ListNotesAbout constructor.
     *
     * @param string $personId
     */
    public function __construct(string $personId)
    {
        $this->personId = $personId;
    }

    /**
     * @return string
     */
    public function personId(): string
    {
        return $this->personId;
    }
}