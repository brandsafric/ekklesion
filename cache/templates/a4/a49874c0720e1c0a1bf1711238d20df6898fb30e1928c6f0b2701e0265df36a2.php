<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_40a00e54413e766440ab6259b91faf20033a9609927637d094e70d0d680f4325 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate('@core/base.html.twig', '@core/layout/login.html.twig', 1);
        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        echo 'Inicio de Sesión';
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        // line 6
        echo '    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">';
        // line 9
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context['context'] ?? null), 'settings', []), 'churchHtmlLongText', []);
        echo '</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Inicio de Sesión</p>

                ';
        // line 15
        if (($context['error'] ?? null)) {
            // line 16
            echo '                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> ¡Error!</h4>
                        ';
            // line 19
            echo twig_escape_filter($this->env, ($context['error'] ?? null), 'html', null, true);
            echo '
                    </div>
                ';
        }
        // line 22
        echo '
                <form action="/auth/login" method="post">
                    <div class="form-group has-feedback">
                        <input name="username" type="text" class="form-control" placeholder="Usuario">
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control" placeholder="Contraseña">
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox"> Recordarme por una semana
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <a href="#">Olvidé mi contraseña</a><br>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-danger btn-block btn-flat">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
    </body>
';
    }

    public function getTemplateName()
    {
        return '@core/layout/login.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [69 => 22,  63 => 19,  58 => 16,  56 => 15,  47 => 9,  42 => 6,  39 => 5,  33 => 3,  15 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/layout/login.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/layout/login.html.twig');
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
