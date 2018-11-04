<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Middleware;

use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\Core\Infrastructure\Templating\Templating;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class NotFoundHandler.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class NotFoundHandler
{
    /**
     * @var Templating
     */
    private $templating;
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * NotFoundHandler constructor.
     *
     * @param Templating    $templating
     * @param Authenticator $authenticator
     */
    public function __construct(Templating $templating, Authenticator $authenticator)
    {
        $this->templating = $templating;
        $this->authenticator = $authenticator;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        // TODO: Send to a different page if not authenticated
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write($this->templating->render('@core/views/not-found.html.twig'));
    }
}
