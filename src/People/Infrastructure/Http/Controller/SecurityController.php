<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Controller;

use Cake\Chronos\Chronos;
use Ekklesion\Core\Infrastructure\Http\Controller\BaseController;
use Ekklesion\People\Domain\Command\CreateAccountForPerson;
use Ekklesion\People\Domain\Command\Login;
use Ekklesion\People\Domain\Command\ResetPassword;
use Ekklesion\Core\Infrastructure\Http\Form\FormExtractor;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
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

        return $this->render($response, '@core/layout/login.html.twig');
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
            return $this->render($response, '@core/layout/login.html.twig', [
                'error' => _('Invalid credentials.'),
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
        $account = $this->dispatchCommand(new CreateAccountForPerson($body['username'], $body['password']));

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

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function resetPassword(Request $request, Response $response, array $params): Response
    {
        return $this->render($response, '@core/views/password-reset.html.twig', [
            'id' => $params['id'],
            'token' => $request->getQueryParams()['token'],
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function doResetPassword(Request $request, Response $response, array $params): Response
    {
        $extractor = new FormExtractor($request);
        if ($extractor->get('passwordOne') !== $extractor->get('passwordTwo')) {
            $this->flash('error', _('Passwords do not match'));
            $uri = $request->getUri()->withQuery(sprintf('token=%s', $extractor->get('token')));

            return $this->redirect($response, $uri);
        }
        try {
            $this->dispatchCommand(new ResetPassword(
                $params['id'],
                $extractor->get('token'),
                $extractor->get('passwordOne')
            ));
        } catch (\DomainException $exception) {
            $this->flash('error', $exception->getMessage());
            $uri = $request->getUri()->withQuery(sprintf('token=%s', $extractor->get('token')));

            return $this->redirect($response, $uri);
        }

        return $this->redirect($response, '/');
    }
}
