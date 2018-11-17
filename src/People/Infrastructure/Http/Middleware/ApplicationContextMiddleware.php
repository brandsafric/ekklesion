<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Middleware;

use Ekklesion\People\Domain\Presenter\AccountPresenter;
use Ekklesion\People\Domain\Repository\AccountRepository;
use Ekklesion\Core\Infrastructure\Http\Middleware\InvokableMiddleware;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use Ekklesion\People\Domain\Repository\PersonRepository;
use Ekklesion\People\Infrastructure\Context\ApplicationContext;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Ramsey\Uuid\Uuid;

/**
 * This middleware is in charge of creating the application context object.
 *
 * This object is available in Twig as a global under the name context. It is
 * also injected into command handlers by using the ContextAware interface and
 * Context trait.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApplicationContextMiddleware implements InvokableMiddleware
{
    /**
     * @var Authenticator
     */
    private $authenticator;
    /**
     * @var PersonRepository
     */
    private $personRepository;
    /**
     * @var AccountRepository
     */
    private $accountRepository;
    /**
     * @var ApplicationContext
     */
    private $applicationContext;

    public function __construct(
        Authenticator $authenticator,
        PersonRepository $personRepository,
        AccountRepository $accountRepository,
        ApplicationContext $applicationContext
    ) {
        $this->authenticator = $authenticator;
        $this->personRepository = $personRepository;
        $this->accountRepository = $accountRepository;
        $this->applicationContext = $applicationContext;
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
        if (null !== $this->authenticator->getAuthenticatedAccountId()) {
            $account = $this->accountRepository->ofId(Uuid::fromString($this->authenticator->getAuthenticatedAccountId()));
            $person = $this->personRepository->ofAccountId(Uuid::fromString($this->authenticator->getAuthenticatedAccountId()));
            if (null !== $account && null !== $person) {
                $this->applicationContext->authenticate(new AccountPresenter($account), new PersonPresenter($person));
            }
        }

        $response = $next($request, $response);

        // We save changed settings
        $this->applicationContext->settings()->save();

        return $response;
    }
}
