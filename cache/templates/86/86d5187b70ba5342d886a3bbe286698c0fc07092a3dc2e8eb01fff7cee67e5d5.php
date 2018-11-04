<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_4cdb96fcc57b74397084446271b3baf4b0ac05b9027eded4d1beb175eac28943 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'styles' => [$this, 'block_styles'],
            'body' => [$this, 'block_body'],
        ];
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
    }

    // line 10
    public function block_styles($context, array $blocks = [])
    {
        // line 11
        echo '    ';
    }

    // line 42
    public function block_body($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return '@core/base.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [96 => 42,  92 => 11,  89 => 10,  84 => 6,  78 => 44,  76 => 42,  44 => 12,  42 => 10,  33 => 6,  26 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@core/base.html.twig', '/home/mnavarro/code/localhost/uno-database/src/Core/Resources/templates/base.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>';
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context['context'] ?? null), 'settings', []), 'churchName', []), 'html', null, true);
        echo ' | ';
        $this->displayBlock('title', $context, $blocks);
        echo '</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- App Compiled Assets -->
    <link rel="stylesheet" href="/build/app.css">
    ';
        // line 10
        $this->displayBlock('styles', $context, $blocks);
        // line 12
        echo '    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<script src="/build/app.js"></script>
';
        // line 42
        $this->displayBlock('body', $context, $blocks);
        // line 44
        echo '
</body>
</html>';
    }
}
