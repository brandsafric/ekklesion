<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Http\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class LocalizationMiddleware.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class LocalizationMiddleware implements InvokableMiddleware
{
    /**
     * @var string
     */
    private $locale;
    /**
     * @var string
     */
    private $domain;
    /**
     * @var string
     */
    private $translationsPath;

    /**
     * LocalizationMiddleware constructor.
     *
     * @param string $translationsPath
     * @param string $locale
     * @param string $domain
     */
    public function __construct(string $translationsPath, string $locale = 'en_US', string $domain = 'messages')
    {
        $this->locale = $locale;
        $this->domain = $domain;
        $this->translationsPath = $translationsPath;
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
        // Set language to Spanish
        putenv('LC_ALL='.$this->locale);
        if (false === setlocale(LC_ALL, $this->locale)) {
            throw new \RuntimeException(sprintf('Locale %s does not exist on the system.', $this->locale));
        }

        // Specify the location of the translation tables
        if (false === bindtextdomain($this->domain, $this->translationsPath)) {
            throw new \RuntimeException(sprintf('Could not set translations folder to %s', $this->translationsPath));
        }

        // Choose domain
        textdomain($this->domain);
        bind_textdomain_codeset($this->domain, 'UTF-8');

        return $next($request, $response);
    }
}
