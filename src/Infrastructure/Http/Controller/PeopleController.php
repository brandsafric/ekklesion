<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Controller;

use Ekklesion\People\Domain\Command\CreatePerson;
use Ekklesion\People\Domain\Command\ListPeople;
use Ekklesion\People\Infrastructure\Http\Form\FormExtractor;
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
        $collection->setPageAndSize(1, 20);

        return $this->json($response, $collection->getIterator()->getArrayCopy());
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
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function new(Request $request, Response $response): Response
    {
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

        $person = $this->dispatchCommand(new CreatePerson(
            $this->authenticatedAccountId(),
            $extractor->get('given'),
            $extractor->get('father'),
            $extractor->get('mother'),
            $extractor->get('gender'),
            $extractor->getInt('role'),
            $extractor->get('birthday'),
            $extractor->get('email'),
            $extractor->get('phone'),
            $extractor->get('facebook'),
            $extractor->get('firstVisit'),
            $extractor->get('baptizedAt')
        ));

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
}
