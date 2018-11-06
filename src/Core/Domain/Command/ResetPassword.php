<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Domain\Command;

/**
 * Class ResetPassword.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ResetPassword
{
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $actionToken;
    /**
     * @var string
     */
    private $newPassword;

    /**
     * ResetPassword constructor.
     *
     * @param string $accountId
     * @param string $actionToken
     * @param string $newPassword
     */
    public function __construct(string $accountId, string $actionToken, string $newPassword)
    {
        $this->accountId = $accountId;
        $this->actionToken = $actionToken;
        $this->newPassword = $newPassword;
    }

    public function accountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function actionToken(): string
    {
        return $this->actionToken;
    }

    /**
     * @return string
     */
    public function newPassword(): string
    {
        return $this->newPassword;
    }
}
