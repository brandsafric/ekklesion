<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_b87ed5aeb380ca38681c1f40c415e5c45312a43c5c94a663b6d0134733377834 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    public function getTemplateName()
    {
        return '@core/components/footer.html.twig';
    }

    public function getDebugInfo()
    {
        return [23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/components/footer.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/components/footer.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo '<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Desarrollado por Matías Navarro
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="https://ekklesion.navarrocarter.com">Ekklesion</a>.</strong> Todos los derechos reservados.
</footer>';
    }
}
