<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Factory\Repository;

use Doctrine\ORM\EntityManagerInterface;
use IglesiaUNO\People\Domain\Model\Person;
use IglesiaUNO\People\Domain\Repository\PersonRepository;
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
