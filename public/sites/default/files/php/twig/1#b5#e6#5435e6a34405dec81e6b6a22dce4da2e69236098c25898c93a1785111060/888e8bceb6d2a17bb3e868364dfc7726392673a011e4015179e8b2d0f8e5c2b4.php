<?php

/* core/themes/classy/templates/navigation/pager.html.twig */
class __TwigTemplate_b5e65435e6a34405dec81e6b6a22dce4da2e69236098c25898c93a1785111060 extends Twig_Template
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
        // line 32
        if ((isset($context["items"]) ? $context["items"] : null)) {
            // line 33
            echo "  <nav class=\"pager\" role=\"navigation\" aria-labelledby=\"pagination-heading\">
    <h4 id=\"pagination-heading\" class=\"visually-hidden\">";
            // line 34
            echo twig_render_var(t("Pagination"));
            echo "</h4>
    <ul class=\"pager__items\">
      ";
            // line 37
            echo "      ";
            if ($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "first", array())) {
                // line 38
                echo "        <li class=\"pager__item pager__item--first\">
          <a href=\"";
                // line 39
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "first", array()), "href", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_render_var(t("Go to first page"));
                echo "\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "first", array()), "attributes", array()), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 40
                echo twig_render_var(t("First page"));
                echo "</span>
            <span aria-hidden=\"true\">";
                // line 41
                echo twig_drupal_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "first", array(), "any", false, true), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "first", array(), "any", false, true), "text", array()), t("« first"))) : (t("« first"))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 45
            echo "      ";
            // line 46
            echo "      ";
            if ($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "previous", array())) {
                // line 47
                echo "        <li class=\"pager__item pager__item--previous\">
          <a href=\"";
                // line 48
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "previous", array()), "href", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_render_var(t("Go to previous page"));
                echo "\" rel=\"prev\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "previous", array()), "attributes", array()), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 49
                echo twig_render_var(t("Previous page"));
                echo "</span>
            <span aria-hidden=\"true\">";
                // line 50
                echo twig_drupal_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "previous", array(), "any", false, true), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "previous", array(), "any", false, true), "text", array()), t("‹ previous"))) : (t("‹ previous"))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 54
            echo "      ";
            // line 55
            echo "      ";
            if ($this->getAttribute((isset($context["ellipses"]) ? $context["ellipses"] : null), "previous", array())) {
                // line 56
                echo "        <li class=\"pager__item pager__item--ellipsis\" role=\"presentation\">&hellip;</li>
      ";
            }
            // line 58
            echo "      ";
            // line 59
            echo "      ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "pages", array()));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 60
                echo "        <li class=\"pager__item";
                echo twig_render_var(((((isset($context["current"]) ? $context["current"] : null) == $context["key"])) ? (" is-active") : ("")));
                echo "\">
          ";
                // line 61
                if (((isset($context["current"]) ? $context["current"] : null) == $context["key"])) {
                    // line 62
                    echo "            ";
                    $context["title"] = t("Current page");
                    // line 63
                    echo "          ";
                } else {
                    // line 64
                    echo "            ";
                    $context["title"] = t("Go to page @key", array("@key" => $context["key"]));
                    // line 65
                    echo "          ";
                }
                // line 66
                echo "          <a href=\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "href", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                echo "\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "attributes", array()), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">
              ";
                // line 68
                echo twig_render_var(((((isset($context["current"]) ? $context["current"] : null) == $context["key"])) ? (t("Current page")) : (t("Page"))));
                echo "
            </span>";
                // line 70
                echo twig_drupal_escape_filter($this->env, $context["key"], "html", null, true);
                // line 71
                echo "</a>
        </li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "      ";
            // line 75
            echo "      ";
            if ($this->getAttribute((isset($context["ellipses"]) ? $context["ellipses"] : null), "next", array())) {
                // line 76
                echo "        <li class=\"pager__item pager__item--ellipsis\" role=\"presentation\">&hellip;</li>
      ";
            }
            // line 78
            echo "      ";
            // line 79
            echo "      ";
            if ($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "next", array())) {
                // line 80
                echo "        <li class=\"pager__item pager__item--next\">
          <a href=\"";
                // line 81
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "next", array()), "href", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_render_var(t("Go to next page"));
                echo "\" rel=\"next\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "next", array()), "attributes", array()), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 82
                echo twig_render_var(t("Next page"));
                echo "</span>
            <span aria-hidden=\"true\">";
                // line 83
                echo twig_drupal_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "next", array(), "any", false, true), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "next", array(), "any", false, true), "text", array()), t("next ›"))) : (t("next ›"))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 87
            echo "      ";
            // line 88
            echo "      ";
            if ($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "last", array())) {
                // line 89
                echo "        <li class=\"pager__item pager__item--last\">
          <a href=\"";
                // line 90
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "last", array()), "href", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_render_var(t("Go to last page"));
                echo "\"";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "last", array()), "attributes", array()), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 91
                echo twig_render_var(t("Last page"));
                echo "</span>
            <span aria-hidden=\"true\">";
                // line 92
                echo twig_drupal_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "last", array(), "any", false, true), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["items"]) ? $context["items"] : null), "last", array(), "any", false, true), "text", array()), t("last »"))) : (t("last »"))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 96
            echo "    </ul>
  </nav>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/navigation/pager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 96,  196 => 92,  192 => 91,  184 => 90,  181 => 89,  178 => 88,  176 => 87,  169 => 83,  165 => 82,  157 => 81,  154 => 80,  151 => 79,  149 => 78,  145 => 76,  142 => 75,  140 => 74,  132 => 71,  130 => 70,  126 => 68,  116 => 66,  113 => 65,  110 => 64,  107 => 63,  104 => 62,  102 => 61,  97 => 60,  92 => 59,  90 => 58,  86 => 56,  83 => 55,  81 => 54,  74 => 50,  70 => 49,  62 => 48,  59 => 47,  56 => 46,  54 => 45,  47 => 41,  43 => 40,  35 => 39,  32 => 38,  29 => 37,  24 => 34,  21 => 33,  19 => 32,);
    }
}
