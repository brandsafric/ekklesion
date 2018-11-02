<?php

/*
 * This file is part of the Ekklesion\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Infrastructure\Http\Controller;

use Ekklesion\People\Infrastructure\CommandBus\CommandBus;
use Ekklesion\People\Infrastructure\Http\Security\Authenticator;
use Ekklesion\People\Infrastructure\Templating\Templating;
use MNC\PhpDdd\Domain\Model\Collection;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Uri;

/**
 * Class BaseController.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $command
     *
     * @return mixed
     */
    protected function dispatchCommand($command)
    {
        /** @var CommandBus $commandBus */
        $commandBus = $this->get(CommandBus::class);

        return $commandBus->dispatch($command);
    }

    /**
     * @param string $serviceId
     *
     * @return mixed
     */
    protected function get(string $serviceId)
    {
        return $this->container->get($serviceId);
    }

    /**
     * @param ResponseInterface $response
     * @param string            $template
     * @param array             $data
     *
     * @return ResponseInterface
     */
    protected function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        /** @var Templating $templating */
        $templating = $this->get(Templating::class);
        $response->getBody()->write($templating->render($template, $data));

        $response = $response->withHeader('Content-Type', 'text/html;charset=UTF-8');
        $response = $response->withStatus(200);

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @param array             $data
     * @param int               $status
     *
     * @return ResponseInterface
     */
    protected function json(ResponseInterface $response, $data = null, int $status = 200): ResponseInterface
    {
        $response->getBody()->write(json_encode($data));

        $response = $response->withHeader('Content-Type', 'application/json;charset=UTF-8');
        $response = $response->withStatus($status);

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @param string            $path
     *
     * @return ResponseInterface
     */
    protected function redirect(ResponseInterface $response, string $path): ResponseInterface
    {
        $response = $response->withRedirect(Uri::createFromString($path));

        return $response;
    }

    /**
     * @return bool
     */
    protected function thereIsAnAuthenticatedUser(): bool
    {
        /** @var Authenticator $authenticator */
        $authenticator = $this->get(Authenticator::class);

        return null !== $authenticator->getAuthenticatedAccountId();
    }

    /**
     * @return null|string
     */
    protected function authenticatedAccountId(): ?string
    {
        /** @var Authenticator $authenticator */
        $authenticator = $this->get(Authenticator::class);

        return $authenticator->getAuthenticatedAccountId();
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param Collection             $collection
     *
     * @return ResponseInterface
     */
    protected function jsonCollection(ServerRequestInterface $request, ResponseInterface $response, Collection $collection): ResponseInterface
    {
        $this->setPaginationDataToCollection($request, $collection);
        $response = $this->json($response, $collection->getIterator()->getArrayCopy());

        return $response->withHeader('X-Pagination-Items-Count', $collection->getItemsCount())
            ->withHeader('X-Pagination-Current-Page', $collection->getCurrentPage())
            ->withHeader('X-Pagination-Total-Pages', $collection->getTotalPages())
            ->withHeader('X-Pagination-Page-Size', $collection->getPageSize())
            ->withHeader('X-Pagination-Total-Count', $collection->getTotalCount());
    }

    /**
     * @param ServerRequestInterface $request
     * @param Collection             $collection
     */
    protected function setPaginationDataToCollection(ServerRequestInterface $request, Collection $collection): void
    {
        $params = $request->getQueryParams();
        $collection->setPageAndSize($params['page'] ?? 1, $params['size'] ?? 20);
    }
}
