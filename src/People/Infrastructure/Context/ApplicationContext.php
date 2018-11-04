<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Context;

use Ekklesion\Core\Domain\Model\Account;
use Ekklesion\Core\Domain\Presenter\AccountPresenter;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Presenter\PersonPresenter;

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
     * Context constructor.
     *
     * @param ApplicationSettings $settings
     */
    public function __construct(ApplicationSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return null !== $this->activePerson && null !== $this->activeAccount;
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
     * @return Person|null
     */
    public function activePerson(): ?PersonPresenter
    {
        return $this->activePerson;
    }

    /**
     * @return Account|null
     */
    public function activeAccount(): ?AccountPresenter
    {
        return $this->activeAccount;
    }
}
