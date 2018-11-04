<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_0141ed41600dd8d704d5b654573ac92226f43f86d040500a7c8948ee0c4dd8ce extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate('@core/layout/main.html.twig', '@people/views/people-list.html.twig', 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'main' => [$this, 'block_main'],
        ];
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        echo gettext('People');
    }

    // line 5
    public function block_main($context, array $blocks = [])
    {
        // line 6
        echo '    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                ';
        // line 9
        echo gettext('People');
        // line 10
        echo '                <small>';
        echo gettext('Here you can see a list of all the people registered in the congregation');
        echo '</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            ';
        // line 21
        $this->loadTemplate('@people/components/people-table.html.twig', '@people/views/people-list.html.twig', 21)->display($context);
        // line 22
        echo '
        </section>
    </div>
';
    }

    public function getTemplateName()
    {
        return '@people/views/people-list.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [66 => 22,  64 => 21,  49 => 10,  47 => 9,  42 => 6,  39 => 5,  33 => 3,  15 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@people/views/people-list.html.twig', '/home/mnavarro/code/localhost/uno-database/src/People/Resources/templates/views/people-list.html.twig');
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
