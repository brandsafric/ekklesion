<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\Persistence;

use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Log\LoggerInterface;

/**
 * Class PsrSqlLogger.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PsrSqlLogger implements SQLLogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function startQuery($sql, array $params = null, array $types = null): void
    {
        $context = ['sql' => $sql, 'params' => $params, 'types' => $types];
        $this->logger->debug('Query executed', $context);
    }

    public function stopQuery(): void
    {
        // TODO: Implement stopQuery() method.
    }
}
