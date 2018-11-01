<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Factory\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ekklesion\People\Infrastructure\CommandBus\TacticianCommandBus;
use League\Tactician\CommandBus;
use League\Tactician\Doctrine\ORM\RollbackOnlyTransactionMiddleware;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Logger\Formatter\ClassPropertiesFormatter;
use League\Tactician\Logger\LoggerMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CommandBusFactory.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CommandBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return TacticianCommandBus
     */
    public function __invoke(ContainerInterface $container): TacticianCommandBus
    {
        $tactician = new CommandBus([
            new LoggerMiddleware(new ClassPropertiesFormatter(), $container->get(LoggerInterface::class)),
            new RollbackOnlyTransactionMiddleware($container->get(EntityManagerInterface::class)),
            new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new CallableLocator([$container, 'get']),
                new InvokeInflector()
            ),
        ]);

        return new TacticianCommandBus($tactician);
    }
}
