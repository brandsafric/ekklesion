<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Context;

use Ekklesion\People\Domain\Presenter\AccountPresenter;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use Ramsey\Uuid\UuidInterface;


// TODO: Separate application context from global settings. Settings should be in core, and this probably should be called ActionContext.

/**
 * Class Context.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationContext
{
    /**
     * @var ApplicationSettings
     */
    private $settings;
    /**
     * @var AccountPresenter|null
     */
    private $activeAccount;
    /**
     * @var PersonPresenter|null
     */
    private $activePerson;
    /**
     * @var array
     */
    private $installedModules;

    /**
     * Context constructor.
     *
     * @param ApplicationSettings $settings
     * @param array               $installedModules
     */
    public function __construct(ApplicationSettings $settings, array $installedModules)
    {
        $this->settings = $settings;
        $this->installedModules = $installedModules;
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return null !== $this->activePerson && null !== $this->activeAccount;
    }

    /**
     * @param string $moduleName
     *
     * @return bool
     */
    public function isModuleInstalled(string $moduleName): bool
    {
        return \in_array($moduleName, $this->installedModules, true);
    }

    /**
     * @param AccountPresenter $account
     * @param PersonPresenter  $person
     */
    public function authenticate(AccountPresenter $account, PersonPresenter $person): void
    {
        $this->activeAccount = $account;
        $this->activePerson = $person;
    }

    /**
     * @return ApplicationSettings
     */
    public function settings(): ApplicationSettings
    {
        return $this->settings;
    }

    /**
     * @return PersonPresenter|null
     */
    public function activePerson(): ?PersonPresenter
    {
        return $this->activePerson;
    }

    /**
     * @return AccountPresenter|null
     */
    public function activeAccount(): ?AccountPresenter
    {
        return $this->activeAccount;
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return bool
     */
    public function personIsEqual(UuidInterface $uuid): bool
    {
        return $this->activeAccount->uuid() === $uuid->toString();
    }
}
