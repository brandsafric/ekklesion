<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Controller;

use Ekklesion\Core\Infrastructure\Http\Controller\BaseController;
use Ekklesion\Core\Infrastructure\Http\Form\FormExtractor;
use Ekklesion\People\Domain\Command\CreateNote;
use Ekklesion\People\Domain\Command\CreatePerson;
use Ekklesion\People\Domain\Command\ListNotesAbout;
use Ekklesion\People\Domain\Command\ListPeople;
use Ekklesion\People\Domain\Command\SeePerson;
use Ekklesion\People\Domain\Model\Gender;
use Ekklesion\People\Domain\Presenter\NoteCollection;
use Ekklesion\People\Domain\Presenter\PersonPresenter;
use MNC\PhpDdd\Domain\Model\Collection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class PeopleController.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class PeopleController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        /** @var Collection $collection */
        $collection = $this->dispatchCommand(new ListPeople());
        $this->setPaginationDataToCollection($request, $collection);

        return $this->render($response, '@people/views/people-list.html.twig', [
            'collection' => $collection,
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function show(Request $request, Response $response, array $params): Response
    {
        /** @var PersonPresenter $person */
        $person = $this->dispatchCommand(new SeePerson($params['id']));
        /** @var NoteCollection $notes */
        $notes = $this->dispatchCommand(new ListNotesAbout($params['id']));

        return $this->render($response, '@people/views/people-show.html.twig', [
            'person' => $person,
            'notes' => $notes
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function new(Request $request, Response $response): Response
    {
        return $this->render($response, '@people/views/people-new.html.twig', [
            'genders' => Gender::values(),
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function create(Request $request, Response $response): Response
    {
        $extractor = new FormExtractor($request);

        $command = new CreatePerson(
            $this->authenticatedAccountId(),
            $extractor->get('names'),
            $extractor->get('father'),
            $extractor->get('mother'),
            $extractor->get('gender'),
            $extractor->get('membershipDate'),
            $extractor->get('deaconshipDate'),
            $extractor->get('eldershipDate'),
            $extractor->get('nickname'),
            $extractor->get('birthday'),
            $extractor->get('emailPrimary'),
            $extractor->get('emailSecondary'),
            $extractor->get('phonePrimary'),
            $extractor->get('phoneSecondary'),
            $extractor->get('facebook'),
            $extractor->get('firstVisit'),
            $extractor->getBool('isBaptized'),
            $extractor->get('baptizedAt')
        );

        $person = $this->dispatchCommand($command);

        return $this->redirect($response, '/people');
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function edit(Request $request, Response $response, array $params): Response
    {
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function update(Request $request, Response $response, array $params): Response
    {
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function delete(Request $request, Response $response, array $params): Response
    {
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function newNote(Request $request, Response $response, array $params): Response
    {
        $extractor = new FormExtractor($request);

        $command = new CreateNote(
            $params['id'],
            $extractor->get('text'),
            $extractor->getBool('private')
        );

        $this->dispatchCommand($command);

        $this->flash('success', _('Your note was added sucessfully.'));
        return $this->redirect($response, sprintf('/people/%s', $params['id']));
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $params
     *
     * @return Response
     */
    public function createAccount(Request $request, Response $response, array $params): Response
    {

    }
}
