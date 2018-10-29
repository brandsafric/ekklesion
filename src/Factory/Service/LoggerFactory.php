<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Factory\Service;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LoggerInterface
     *
     * @throws \Exception
     */
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $logger = new Logger('app');
        $handler = new StreamHandler($container->get('settings')['log_path']);
        $logger->pushHandler($handler);

        return $logger;
    }
}
