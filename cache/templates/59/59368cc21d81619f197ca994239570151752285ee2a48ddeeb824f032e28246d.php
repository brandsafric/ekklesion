<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_2006f7a0c540a24242a8a29f2a09819466b3078ffb9337ad5beaa58749abbd5e extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate('@core/layout/main.html.twig', '@people/views/people-new.html.twig', 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'main' => [$this, 'block_main'],
        ];
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        echo 'Añadir Nueva Persona';
    }

    // line 5
    public function block_main($context, array $blocks = [])
    {
        // line 6
        echo '    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Nueva Persona
                <small>Aquí puedes crear una nueva persona</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            

        </section>
    </div>
';
    }

    public function getTemplateName()
    {
        return '@people/views/people-new.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [42 => 6,  39 => 5,  33 => 3,  15 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@people/views/people-new.html.twig', '/home/mnavarro/code/localhost/uno-database/src/People/Resources/templates/views/people-new.html.twig');
    }

    protected function doGetParent(array $context)
    {
        return '@core/layout/main.html.twig';
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }
}
