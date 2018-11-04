<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_6c8e96709400e7ade092e82515b52c66c422bdf14c1a29bcc59fa5778e2b405e extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate('@core/layout/main.html.twig', '@core/dashboard.html.twig', 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'main' => [$this, 'block_main'],
        ];
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        echo 'Dashboard';
    }

    // line 5
    public function block_main($context, array $blocks = [])
    {
        // line 6
        echo '    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Una vista rápida de todo lo que sucede en tu congregación</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            ';
        // line 20
        $this->loadTemplate('@core/components/counters.html.twig', '@core/dashboard.html.twig', 20)->display($context);
        // line 21
        echo '        </section>
    </div>
';
    }

    public function getTemplateName()
    {
        return '@core/dashboard.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [60 => 21,  58 => 20,  42 => 6,  39 => 5,  33 => 3,  15 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/dashboard.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/dashboard.html.twig');
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
