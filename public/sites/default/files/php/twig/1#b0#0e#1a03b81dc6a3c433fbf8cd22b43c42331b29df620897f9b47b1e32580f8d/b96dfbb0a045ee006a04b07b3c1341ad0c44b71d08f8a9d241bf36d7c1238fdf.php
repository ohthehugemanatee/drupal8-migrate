<?php

/* core/modules/views/templates/views-view.html.twig */
class __TwigTemplate_b00e1a03b81dc6a3c433fbf8cd22b43c42331b29df620897f9b47b1e32580f8d extends Twig_Template
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
        // line 36
        $context["classes"] = array(0 => "view", 1 => ("view-" . \Drupal\Component\Utility\Html::getClass((isset($context["id"]) ? $context["id"] : null))), 2 => ("view-id-" . (isset($context["id"]) ? $context["id"] : null)), 3 => ("view-display-id-" . (isset($context["display_id"]) ? $context["display_id"] : null)), 4 => (((isset($context["dom_id"]) ? $context["dom_id"] : null)) ? (("view-dom-id-" . (isset($context["dom_id"]) ? $context["dom_id"] : null))) : ("")));
        // line 44
        echo "<div";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true);
        echo ">
  ";
        // line 45
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
  ";
        // line 46
        if ((isset($context["title"]) ? $context["title"] : null)) {
            // line 47
            echo "    ";
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "
  ";
        }
        // line 49
        echo "  ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "
  ";
        // line 50
        if ((isset($context["header"]) ? $context["header"] : null)) {
            // line 51
            echo "    <div class=\"view-header\">
      ";
            // line 52
            echo twig_drupal_escape_filter($this->env, (isset($context["header"]) ? $context["header"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 55
        echo "  ";
        if ((isset($context["exposed"]) ? $context["exposed"] : null)) {
            // line 56
            echo "    <div class=\"view-filters\">
      ";
            // line 57
            echo twig_drupal_escape_filter($this->env, (isset($context["exposed"]) ? $context["exposed"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 60
        echo "  ";
        if ((isset($context["attachment_before"]) ? $context["attachment_before"] : null)) {
            // line 61
            echo "    <div class=\"attachment attachment-before\">
      ";
            // line 62
            echo twig_drupal_escape_filter($this->env, (isset($context["attachment_before"]) ? $context["attachment_before"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 65
        echo "
  ";
        // line 66
        if ((isset($context["rows"]) ? $context["rows"] : null)) {
            // line 67
            echo "    <div class=\"view-content\">
      ";
            // line 68
            echo twig_drupal_escape_filter($this->env, (isset($context["rows"]) ? $context["rows"] : null), "html", null, true);
            echo "
    </div>
  ";
        } elseif ((isset($context["empty"]) ? $context["empty"] : null)) {
            // line 71
            echo "    <div class=\"view-empty\">
      ";
            // line 72
            echo twig_drupal_escape_filter($this->env, (isset($context["empty"]) ? $context["empty"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 75
        echo "
  ";
        // line 76
        if ((isset($context["pager"]) ? $context["pager"] : null)) {
            // line 77
            echo "    ";
            echo twig_drupal_escape_filter($this->env, (isset($context["pager"]) ? $context["pager"] : null), "html", null, true);
            echo "
  ";
        }
        // line 79
        echo "  ";
        if ((isset($context["attachment_after"]) ? $context["attachment_after"] : null)) {
            // line 80
            echo "    <div class=\"attachment attachment-after\">
      ";
            // line 81
            echo twig_drupal_escape_filter($this->env, (isset($context["attachment_after"]) ? $context["attachment_after"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 84
        echo "  ";
        if ((isset($context["more"]) ? $context["more"] : null)) {
            // line 85
            echo "    ";
            echo twig_drupal_escape_filter($this->env, (isset($context["more"]) ? $context["more"] : null), "html", null, true);
            echo "
  ";
        }
        // line 87
        echo "  ";
        if ((isset($context["footer"]) ? $context["footer"] : null)) {
            // line 88
            echo "    <div class=\"view-footer\">
      ";
            // line 89
            echo twig_drupal_escape_filter($this->env, (isset($context["footer"]) ? $context["footer"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 92
        echo "  ";
        if ((isset($context["feed_icons"]) ? $context["feed_icons"] : null)) {
            // line 93
            echo "    <div class=\"feed-icons\">
      ";
            // line 94
            echo twig_drupal_escape_filter($this->env, (isset($context["feed_icons"]) ? $context["feed_icons"] : null), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 97
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/views/templates/views-view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 97,  151 => 94,  148 => 93,  145 => 92,  139 => 89,  136 => 88,  133 => 87,  127 => 85,  124 => 84,  118 => 81,  115 => 80,  112 => 79,  106 => 77,  104 => 76,  101 => 75,  95 => 72,  92 => 71,  86 => 68,  83 => 67,  81 => 66,  78 => 65,  72 => 62,  69 => 61,  66 => 60,  60 => 57,  57 => 56,  54 => 55,  48 => 52,  45 => 51,  43 => 50,  38 => 49,  32 => 47,  30 => 46,  26 => 45,  21 => 44,  19 => 36,);
    }
}
