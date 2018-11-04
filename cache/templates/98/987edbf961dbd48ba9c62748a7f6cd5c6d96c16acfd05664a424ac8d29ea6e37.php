<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class __TwigTemplate_98dfa19a155e5562fb05b09dadcd7ea991e92d670cd0c6f78a382a8ac8eac597 extends Twig_Template
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
        return '@people/components/people-table.html.twig';
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return [228 => 78,  222 => 74,  217 => 71,  211 => 69,  208 => 68,  202 => 67,  194 => 65,  186 => 63,  183 => 62,  178 => 61,  172 => 59,  170 => 58,  164 => 54,  155 => 51,  152 => 50,  148 => 48,  144 => 46,  142 => 45,  138 => 43,  129 => 41,  125 => 40,  120 => 38,  116 => 37,  112 => 36,  108 => 35,  104 => 34,  98 => 33,  95 => 32,  91 => 31,  86 => 29,  82 => 28,  78 => 27,  74 => 26,  70 => 25,  66 => 24,  62 => 23,  58 => 22,  54 => 21,  49 => 18,  47 => 17,  35 => 8,  28 => 4,  23 => 1];
    }

    public function getSourceContext()
    {
        return new Twig_Source('', '@people/components/people-table.html.twig', '/home/mnavarro/code/localhost/uno-database/src/People/Resources/templates/components/people-table.html.twig');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo '
<div class="box">
    <div class="box-header">
        <h3 class="box-title">';
        // line 4
        echo gettext('People List');
        echo '</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="';
        // line 8
        echo gettext('Search');
        echo '...">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    ';
        // line 17
        if (!(0 === twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'itemsCount', []))) {
            // line 18
            echo '    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody><tr>
                <th>';
            // line 21
            echo gettext('Name');
            echo '</th>
                <th>';
            // line 22
            echo gettext('Nickname');
            echo '</th>
                <th>';
            // line 23
            echo gettext('Gender');
            echo '</th>
                <th>';
            // line 24
            echo gettext('Email');
            echo '</th>
                <th>';
            // line 25
            echo gettext('Phone');
            echo '</th>
                <th>';
            // line 26
            echo gettext('Birthday');
            echo '</th>
                <th>';
            // line 27
            echo gettext('Role');
            echo '</th>
                <th>';
            // line 28
            echo gettext('Has account?');
            echo '</th>
                <th>';
            // line 29
            echo gettext('Added at');
            echo '</th>
            </tr>
            ';
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context['collection'] ?? null));
            foreach ($context['_seq'] as $context['_key'] => $context['person']) {
                // line 32
                echo '            <tr>
                <td><a href="';
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'link', []), 'html', null, true);
                echo '">';
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'listName', []), 'html', null, true);
                echo '</a></td>
                <td>';
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'nickname', []), 'html', null, true);
                echo '</td>
                <td>';
                // line 35
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'gender', []), 'html', null, true);
                echo '</td>
                <td>';
                // line 36
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'email', []), 'html', null, true);
                echo '</td>
                <td>';
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'phone', []), 'html', null, true);
                echo '</td>
                <td>';
                // line 38
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'birthday', []), 'html', null, true);
                echo '</td>
                <td>
                    ';
                // line 40
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context['person'], 'roles', []));
                foreach ($context['_seq'] as $context['_key'] => $context['role']) {
                    // line 41
                    echo '                        <span class="label label-success">';
                    echo twig_escape_filter($this->env, $context['role'], 'html', null, true);
                    echo '</span>
                    ';
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 43
                echo '                </td>
                <td>
                    ';
                // line 45
                if (twig_get_attribute($this->env, $this->source, $context['person'], 'hasAccount', [])) {
                    // line 46
                    echo '                        <span class="label label-success">Si</span>
                    ';
                } else {
                    // line 48
                    echo '                        <span class="label label-danger">No</span>
                    ';
                }
                // line 50
                echo '                </td>
                <td>';
                // line 51
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context['person'], 'createdAt', []), 'html', null, true);
                echo '</td>
            </tr>
            ';
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['person'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo '            </tbody></table>
    </div>
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
            ';
            // line 58
            if (twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'hasPreviousPage', [])) {
                // line 59
                echo '                <li><a href="';
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'linkToPreviousPage', []), 'html', null, true);
                echo '">«</a></li>
            ';
            }
            // line 61
            echo '            ';
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'totalPages', [])));
            foreach ($context['_seq'] as $context['_key'] => $context['i']) {
                // line 62
                echo '                ';
                if ((twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'currentPage', []) === $context['i'])) {
                    // line 63
                    echo '                    <li><a href="';
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'linkToPage', [0 => $context['i']], 'method'), 'html', null, true);
                    echo '"><b>';
                    echo twig_escape_filter($this->env, $context['i'], 'html', null, true);
                    echo '</b></a></li>
                ';
                } else {
                    // line 65
                    echo '                    <li><a href="';
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'linkToPage', [0 => $context['i']], 'method'), 'html', null, true);
                    echo '">';
                    echo twig_escape_filter($this->env, $context['i'], 'html', null, true);
                    echo '</a></li>
                ';
                }
                // line 67
                echo '            ';
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo '            ';
            if (twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'hasNextPage', [])) {
                // line 69
                echo '                <li><a href="';
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context['collection'] ?? null), 'linkToNextPage', []), 'html', null, true);
                echo '">»</a></li>
            ';
            }
            // line 71
            echo '        </ul>
    </div>
    ';
        } else {
            // line 74
            echo '    <div class="box-body">
        <p>No hay resultados...</p>
    </div>
    ';
        }
        // line 78
        echo '    <!-- /.box-body -->
</div>';
    }
}
