<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Install\Infrastructure\Http\Controller;

use Cake\Chronos\Chronos;
use Ekklesion\Core\Domain\Presenter\AccountPresenter;
use Ekklesion\Core\Infrastructure\Http\Controller\BaseController;
use Ekklesion\Core\Infrastructure\Http\Security\Authenticator;
use Ekklesion\Install\Domain\Command\CreateInitialAccountAndPerson;
use Ekklesion\Install\Domain\Command\InstallApplication;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class InstallationController.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InstallationController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function install(Request $request, Response $response): Response
    {
        return $this->render($response, '@install/install-view.html.twig');
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function doInstall(Request $request, Response $response): Response
    {
        $this->dispatchCommand(new InstallApplication());

        /** @var AccountPresenter $account */
        $account = $this->dispatchCommand(new CreateInitialAccountAndPerson('admin'));

        /** @var Authenticator $authenticator */
        $authenticator = $this->get(Authenticator::class);
        $response = $authenticator->addAuthenticationCookie($response, $account->uuid(), Chronos::now()->addWeek(2));

        return $this->redirect($response, '/');
    }
}
