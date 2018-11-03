<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Presenter;

use MNC\PhpDdd\Application\Presentation\PresentableCollection;
use MNC\PhpDdd\Domain\Model\Collection;

/**
 * Class PeopleCollection.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PeopleCollection extends PresentableCollection
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
    public function __construct(Collection $collection, string $route = '/people')
    {
        parent::__construct($collection, new PersonPresenter());
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
