<?php

/* core/themes/classy/templates/dataset/table.html.twig */
class __TwigTemplate_9868814d7aca0c78cfc99357e90e7e8029483337f8504952be589eae56b2d7fd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 42
        echo "<table";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 43
        if ((isset($context["caption"]) ? $context["caption"] : null)) {
            // line 44
            echo "    <caption>";
            echo twig_drupal_escape_filter($this->env, (isset($context["caption"]) ? $context["caption"] : null), "html", null, true);
            echo "</caption>
  ";
        }
        // line 46
        echo "
  ";
        // line 47
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["colgroups"]) ? $context["colgroups"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["colgroup"]) {
            // line 48
            echo "    ";
            if ($this->getAttribute($context["colgroup"], "cols", array())) {
                // line 49
                echo "      <colgroup";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["colgroup"], "attributes", array()), "html", null, true);
                echo ">
        ";
                // line 50
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["colgroup"], "cols", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 51
                    echo "          <col";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["col"], "attributes", array()), "html", null, true);
                    echo " />
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "      </colgroup>
    ";
            } else {
                // line 55
                echo "      <colgroup";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["colgroup"], "attributes", array()), "html", null, true);
                echo " />
    ";
            }
            // line 57
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colgroup'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "
  ";
        // line 59
        if ((isset($context["header"]) ? $context["header"] : null)) {
            // line 60
            echo "    <thead>
      <tr>
        ";
            // line 62
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["header"]) ? $context["header"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                // line 63
                echo "          ";
                // line 64
                $context["cell_classes"] = array(0 => (($this->getAttribute($context["cell"], "active_table_sort", array())) ? ("active") : ("")));
                // line 68
                echo "          <";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["cell"], "attributes", array()), "addClass", array(0 => (isset($context["cell_classes"]) ? $context["cell_classes"] : null)), "method"), "html", null, true);
                echo ">";
                // line 69
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true);
                // line 70
                echo "</";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                echo ">
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "      </tr>
    </thead>
  ";
        }
        // line 75
        echo "
  ";
        // line 76
        if ((isset($context["rows"]) ? $context["rows"] : null)) {
            // line 77
            echo "    <tbody>
      ";
            // line 78
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["rows"]) ? $context["rows"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 79
                echo "        ";
                // line 80
                $context["row_classes"] = array(0 => (((!(isset($context["no_striping"]) ? $context["no_striping"] : null))) ? (twig_cycle(array(0 => "odd", 1 => "even"), $this->getAttribute($context["loop"], "index0", array()))) : ("")));
                // line 84
                echo "        <tr";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["row"], "attributes", array()), "addClass", array(0 => (isset($context["row_classes"]) ? $context["row_classes"] : null)), "method"), "html", null, true);
                echo ">
          ";
                // line 85
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 86
                    echo "            <";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "attributes", array()), "html", null, true);
                    echo ">";
                    // line 87
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true);
                    // line 88
                    echo "</";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 90
                echo "        </tr>
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "    </tbody>
  ";
        } elseif ((isset($context["empty"]) ? $context["empty"] : null)) {
            // line 94
            echo "    <tbody>
      <tr class=\"odd\">
        <td colspan=\"";
            // line 96
            echo twig_drupal_escape_filter($this->env, (isset($context["header_columns"]) ? $context["header_columns"] : null), "html", null, true);
            echo "\" class=\"empty message\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["empty"]) ? $context["empty"] : null), "html", null, true);
            echo "</td>
      </tr>
    </tbody>
  ";
        }
        // line 100
        echo "  ";
        if ((isset($context["footer"]) ? $context["footer"] : null)) {
            // line 101
            echo "    <tfoot>
      ";
            // line 102
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["footer"]) ? $context["footer"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 103
                echo "        <tr";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["row"], "attributes", array()), "html", null, true);
                echo ">
          ";
                // line 104
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 105
                    echo "            <";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "attributes", array()), "html", null, true);
                    echo ">";
                    // line 106
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true);
                    // line 107
                    echo "</";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true);
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 109
                echo "        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "    </tfoot>
  ";
        }
        // line 113
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/dataset/table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 113,  242 => 111,  235 => 109,  226 => 107,  224 => 106,  219 => 105,  215 => 104,  210 => 103,  206 => 102,  203 => 101,  200 => 100,  191 => 96,  187 => 94,  183 => 92,  168 => 90,  159 => 88,  157 => 87,  152 => 86,  148 => 85,  143 => 84,  141 => 80,  139 => 79,  122 => 78,  119 => 77,  117 => 76,  114 => 75,  109 => 72,  100 => 70,  98 => 69,  93 => 68,  91 => 64,  89 => 63,  85 => 62,  81 => 60,  79 => 59,  76 => 58,  70 => 57,  64 => 55,  60 => 53,  51 => 51,  47 => 50,  42 => 49,  39 => 48,  35 => 47,  32 => 46,  26 => 44,  24 => 43,  19 => 42,);
    }
}
