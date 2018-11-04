<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_5e225086fc3d110bf19d09967086e81d249ba1569dab6b84a6966d9405de8ca7 extends Twig_Template
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
        return '@core/components/counters.html.twig';
    }

    public function getDebugInfo()
    {
        return [23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/components/counters.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/components/counters.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo '<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>
                <p>Personas</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="/people" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>53</h3>
                <p>Hogares</p>
            </div>
            <div class="icon">
                <i class="fa fa-home"></i>
            </div>
            <a href="/households" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>
                <p>Grupos</p>
            </div>
            <div class="icon">
                <i class="fa fa-group"></i>
            </div>
            <a href="/groups" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>65</h3>
                <p>Eventos</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="/events" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>';
    }
}
