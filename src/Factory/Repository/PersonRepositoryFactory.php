<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Ekklesion\People\Domain\Model\Person;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Psr\Container\ContainerInterface;

/**
 * Class PersonRepositoryFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PersonRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PersonRepository
     */
    public function __invoke(ContainerInterface $container): PersonRepository
    {
        $manager = $container->get(EntityManagerInterface::class);

        return $manager->getRepository(Person::class);
    }
}
