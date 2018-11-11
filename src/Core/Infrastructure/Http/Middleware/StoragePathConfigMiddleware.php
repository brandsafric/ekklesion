<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * This middleware is in charge of checking if the storage folder exists, and
 * if it is symlinked to the public directory, so files are accessible when
 * uploaded.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class StoragePathConfigMiddleware implements InvokableMiddleware
{
    /**
     * @var string
     */
    private $storageLinkPath;
    /**
     * @var string
     */
    private $storageRealPath;

    /**
     * StoragePathConfigMiddleware constructor.
     *
     * @param string $appRootPath
     */
    public function __construct(string $appRootPath)
    {
        $this->storageLinkPath = $appRootPath.'/public/storage';
        $this->storageRealPath = $appRootPath.'/storage';
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        if (!@mkdir($this->storageRealPath, 0775, true) && !is_dir($this->storageRealPath)) {
            throw new \RuntimeException(sprintf('There was a problem creating the storage folder in %s', $this->storageRealPath));
        }
        if (!@symlink($this->storageRealPath, $this->storageLinkPath) && !is_dir($this->storageLinkPath)) {
            throw new \RuntimeException(sprintf('Could not create symlink from %s to %s', $this->storageRealPath, $this->storageLinkPath));
        }

        return $next($request, $response);
    }
}
