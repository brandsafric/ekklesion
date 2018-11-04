<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_ac1c0d4949852542912c4bcbdd429c2d1aeb76af28b58c46bce374b41c4e79e2 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate('@core/base.html.twig', '@core/layout/main.html.twig', 1);
        $this->blocks = [
            'body' => [$this, 'block_body'],
            'main' => [$this, 'block_main'],
        ];
    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        // line 4
        echo '    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper">

            ';
        // line 7
        $this->loadTemplate('@core/components/header.html.twig', '@core/layout/main.html.twig', 7)->display($context);
        // line 8
        echo '            ';
        $this->loadTemplate('@core/components/sidebar.html.twig', '@core/layout/main.html.twig', 8)->display($context);
        // line 9
        echo '
            ';
        // line 10
        $this->displayBlock('main', $context, $blocks);
        // line 12
        echo '
            ';
        // line 13
        $this->loadTemplate('@core/components/footer.html.twig', '@core/layout/main.html.twig', 13)->display($context);
        // line 14
        echo '            ';
        $this->loadTemplate('@core/components/controlbar.html.twig', '@core/layout/main.html.twig', 14)->display($context);
        // line 15
        echo '
        </div>
    </body>
';
    }

    // line 10
    public function block_main($context, array $blocks = [])
    {
        // line 11
        echo '            ';
    }

    public function getTemplateName()
    {
        return '@core/layout/main.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [69 => 11,  66 => 10,  59 => 15,  56 => 14,  54 => 13,  51 => 12,  49 => 10,  46 => 9,  43 => 8,  41 => 7,  36 => 4,  33 => 3,  15 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/layout/main.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/layout/main.html.twig');
    }

    protected function doGetParent(array $context)
    {
        return '@core/base.html.twig';
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }
}
