<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Controller;

use Ekklesion\People\Domain\Command\ListPeople;
use MNC\PhpDdd\Domain\Model\Collection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class JsonPeopleController.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class JsonPeopleController extends BaseController
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

        return $this->jsonCollection($request, $response, $collection);
    }
}
