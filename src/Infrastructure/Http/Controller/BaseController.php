<?php

/*
 * This file is part of the IglesiaUNO\People project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IglesiaUNO\People\Infrastructure\Http\Controller;

use IglesiaUNO\People\Infrastructure\Templating\Templating;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

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
}
