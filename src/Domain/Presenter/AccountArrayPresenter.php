<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Domain\Presenter;

use Ekklesion\People\Domain\Model\Account;

/**
 * Class AccountPresenter.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AccountArrayPresenter
{
    public function __invoke(Account $account): array
    {
        $array = [];
        $array['uuid'] = $account->uuid()->toString();
        $array['username'] = [
            'normal' => $account->username()->normal(),
            'canonical' => $account->username()->canonical(),
        ];
        $array['lastLogin'] = $account->lastLogin() ? $account->lastLogin()->format(DATE_ATOM) : null;
        $array['createdAt'] = $account->createdAt()->format(DATE_ATOM);

        return $array;
    }
}
