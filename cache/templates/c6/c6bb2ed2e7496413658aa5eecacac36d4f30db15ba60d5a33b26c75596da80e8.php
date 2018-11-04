<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_746ade1d5fb658c61e0a42b0c55924cc92620b0d0d5d26f8b7fc68bd93bc7ed1 extends Twig_Template
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
        return '@core/components/controlbar.html.twig';
    }

    public function getDebugInfo()
    {
        return [23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/components/controlbar.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/components/controlbar.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!-- Control Sidebar -->
<aside class=\"control-sidebar control-sidebar-dark\">
    <!-- Create the tabs -->
    <ul class=\"nav nav-tabs nav-justified control-sidebar-tabs\">
        <li class=\"active\"><a href=\"#control-sidebar-home-tab\" data-toggle=\"tab\"><i class=\"fa fa-home\"></i></a></li>
        <li><a href=\"#control-sidebar-settings-tab\" data-toggle=\"tab\"><i class=\"fa fa-gears\"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class=\"tab-content\">
        <!-- Home tab content -->
        <div class=\"tab-pane active\" id=\"control-sidebar-home-tab\">
            <h3 class=\"control-sidebar-heading\">Recent Activity</h3>
            <ul class=\"control-sidebar-menu\">
                <li>
                    <a href=\"javascript:;\">
                        <i class=\"menu-icon fa fa-birthday-cake bg-red\"></i>

                        <div class=\"menu-info\">
                            <h4 class=\"control-sidebar-subheading\">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class=\"control-sidebar-heading\">Tasks Progress</h3>
            <ul class=\"control-sidebar-menu\">
                <li>
                    <a href=\"javascript:;\">
                        <h4 class=\"control-sidebar-subheading\">
                            Custom Template Design
                            <span class=\"pull-right-container\">
                    <span class=\"label label-danger pull-right\">70%</span>
                  </span>
                        </h4>

                        <div class=\"progress progress-xxs\">
                            <div class=\"progress-bar progress-bar-danger\" style=\"width: 70%\"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class=\"tab-pane\" id=\"control-sidebar-stats-tab\">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- ApplicationSettings tab content -->
        <div class=\"tab-pane\" id=\"control-sidebar-settings-tab\">
            <form method=\"post\">
                <h3 class=\"control-sidebar-heading\">General Settings</h3>

                <div class=\"form-group\">
                    <label class=\"control-sidebar-subheading\">
                        Report panel usage
                        <input type=\"checkbox\" class=\"pull-right\" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class=\"control-sidebar-bg\"></div>";
    }
}
