<?php

namespace Ekklesion\People\Domain\Presenter;

use MNC\PhpDdd\Application\Presentation\PresentableCollection;
use MNC\PhpDdd\Domain\Model\Collection;

/**
 * Class NoteCollection
 * @package Ekklesion\People\Domain\Presenter
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class NoteCollection extends PresentableCollection
{
    /**
     * @var string
     */
    private $route;

    /**
     * PeopleCollection constructor.
     *
     * @param Collection $collection
     * @param string     $route
     */
    public function __construct(Collection $collection, string $route = '/notes')
    {
        parent::__construct($collection, new NotePresenter());
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function linkFirstPage(): string
    {
        return $this->routeWithPage(1);
    }

    /**
     * @return string
     */
    public function linkLastPage(): string
    {
        return $this->routeWithPage($this->getTotalPages());
    }

    /**
     * @return bool
     */
    public function hasNextPage(): bool
    {
        return $this->getCurrentPage() < $this->getTotalPages();
    }

    /**
     * @param int $page
     *
     * @return string
     */
    public function linkToPage(int $page): string
    {
        return $this->routeWithPage($page);
    }

    /**
     * @return bool
     */
    public function hasPreviousPage(): bool
    {
        return $this->getCurrentPage() > 1;
    }

    /**
     * @return string
     */
    public function linkToNextPage(): string
    {
        return $this->routeWithPage($this->getCurrentPage() + 1);
    }

    /**
     * @return string
     */
    public function linkToPreviousPage(): string
    {
        return $this->routeWithPage($this->getCurrentPage() - 1);
    }

    /**
     * @param int $page
     *
     * @return string
     */
    private function routeWithPage(int $page): string
    {
        return sprintf('%s?page=%s', $this->route, $page);
    }
}