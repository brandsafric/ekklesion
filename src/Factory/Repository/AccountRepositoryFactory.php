<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Ekklesion\People\Domain\Model\Account;
use Ekklesion\People\Domain\Repository\AccountRepository;
use Psr\Container\ContainerInterface;

class AccountRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return AccountRepository
     */
    public function __invoke(ContainerInterface $container): AccountRepository
    {
        $manager = $container->get(EntityManagerInterface::class);

        return $manager->getRepository(Account::class);
    }
}
