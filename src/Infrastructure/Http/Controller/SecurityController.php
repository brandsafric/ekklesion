<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\Http\Controller;

use Cake\Chronos\Chronos;
use IglesiaUNO\People\Domain\Command\CreateAccount;
use IglesiaUNO\People\Domain\Command\Login;
use IglesiaUNO\People\Infrastructure\Http\Security\Authenticator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class SecurityController.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class SecurityController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function renderLogin(Request $request, Response $response): Response
    {
        if ($this->thereIsAnAuthenticatedUser()) {
            return $this->redirect($response, '/');
        }

        return $this->render($response, 'login.html.twig');
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function doLogin(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        /** @var Authenticator $authenticator */
        $authenticator = $this->get(Authenticator::class);

        try {
            $accountId = $this->dispatchCommand(new Login($body['username'], $body['password']));
        } catch (\DomainException $e) {
            return $this->render($response, 'login.html.twig', [
                'error' => 'Credenciales invalidas',
            ]);
        }

        if (isset($body['remember'])) {
            $expires = Chronos::now()->addWeek();
        } else {
            $expires = Chronos::now()->addHour();
        }

        $response = $authenticator->addAuthenticationCookie($response, $accountId, $expires);

        return $this->redirect($response, '/');
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function createAccount(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $account = $this->dispatchCommand(new CreateAccount($body['username'], $body['password']));

        return $this->json($response, $account);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function logout(Request $request, Response $response): Response
    {
        /** @var Authenticator $authenticator */
        $authenticator = $this->get(Authenticator::class);
        $response = $this->redirect($response, '/auth/login');

        return $authenticator->removeAuthenticationCookie($response);
    }
}
