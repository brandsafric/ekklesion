<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Middleware;

use Cake\Chronos\Chronos;
use Cake\Chronos\DifferenceFormatter;
use Ekklesion\Core\Infrastructure\Persistence\Helper\SpanishTranslator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class ChronosFormatterMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ChronosFormatterMiddleware implements InvokableMiddleware
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        // Change the diff formatter in chronos
        // TODO: Must create a gettext translatable implementation
        Chronos::diffFormatter(new DifferenceFormatter(new SpanishTranslator()));

        return $next($request, $response);
    }
}
