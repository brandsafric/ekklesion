<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_d345af7885f12b175241ebff473766f3b0f9f0dd49ec6e244c9bbdf7306fb87b extends Twig_Template
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
        return '@core/components/sidebar.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [39 => 12,  33 => 9,  23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/components/sidebar.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/components/sidebar.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo '<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="';
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context['context'] ?? null), 'activePerson', []), 'avatar', []), 'html', null, true);
        echo '" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>';
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context['context'] ?? null), 'activePerson', []), 'shortName', []), 'html', null, true);
        echo '</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i>
                    <span>Personas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/people">Listado</a></li>
                    <li><a href="/people/new">Añadir Nueva</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-home"></i>
                    <span>Hogares</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Listado</a></li>
                    <li><a href="#">Registrar Nuevo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-group"></i>
                    <span>Grupos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Listado</a></li>
                    <li><a href="#">Añadir Nuevo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-calendar"></i>
                    <span>Eventos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Listado</a></li>
                    <li><a href="#">Crear Nuevo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-money"></i>
                    <span>Finanzas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Balance</a></li>
                    <li><a href="#">Contribuciones</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>';
    }
}
