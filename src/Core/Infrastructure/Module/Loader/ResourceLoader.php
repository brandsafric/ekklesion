<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\Core\Infrastructure\Module\Loader;

/**
 * Class ResourceLoader.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ResourceLoader
{
    /**
     * @var array
     */
    private $templates = [];
    /**
     * @var array
     */
    private $ormMappings = [];
    /**
     * @var array
     */
    private $ormTypes = [];

    /**
     * @param string $namespace
     * @param string $path
     *
     * @return ResourceLoader
     */
    public function loadTemplate(string $namespace, string $path): ResourceLoader
    {
        $this->templates[$namespace] = $path;

        return $this;
    }

    /**
     * @param string $namespace
     * @param string $path
     *
     * @return ResourceLoader
     */
    public function loadORMMapping(string $namespace, string $path): ResourceLoader
    {
        $this->ormMappings[$path] = $namespace;

        return $this;
    }

    public function loadORMType(string $name, string $class): ResourceLoader
    {
        $this->ormTypes[$name] = $class;

        return $this;
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return $this->templates;
    }

    /**
     * @return array
     */
    public function getOrmMappings(): array
    {
        return $this->ormMappings;
    }

    /**
     * @return array
     */
    public function getOrmTypes(): array
    {
        return $this->ormTypes;
    }
}
