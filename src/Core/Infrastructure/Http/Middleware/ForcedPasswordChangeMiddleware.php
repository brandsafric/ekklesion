<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Middleware;

use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Uri;

/**
 * Class ForcedPasswordChangeMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ForcedPasswordChangeMiddleware implements InvokableMiddleware
{
    /**
     * @var ApplicationContext
     */
    private $context;
    /**
     * @var string
     */
    private $passwordChangeRoute;

    /**
     * ForcedPasswordChangeMiddleware constructor.
     *
     * @param ApplicationContext $context
     * @param string             $passwordChangeRoute
     */
    public function __construct(ApplicationContext $context, string $passwordChangeRoute = '/auth/reset-password')
    {
        $this->context = $context;
        $this->passwordChangeRoute = $passwordChangeRoute;
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
        if ($request->getUri()->getPath() === $this->passwordChangeRoute) {
            return $next($request, $response);
        }
        if (null !== $this->context->activeAccount() && $this->context->activeAccount()->requiresPasswordChange()) {
            $uri = Uri::createFromString($this->passwordChangeRoute)
                ->withQuery(sprintf(
                    'token=%s&id=%s',
                    $this->context->activeAccount()->actionToken(),
                    $this->context->activeAccount()->uuid()
                ));

            return $response->withRedirect($uri);
        }

        return $next($request, $response);
    }
}
