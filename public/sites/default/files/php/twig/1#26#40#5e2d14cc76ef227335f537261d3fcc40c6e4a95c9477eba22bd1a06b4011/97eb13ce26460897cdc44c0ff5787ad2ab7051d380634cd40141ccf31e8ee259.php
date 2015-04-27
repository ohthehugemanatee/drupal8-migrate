<?php

/* core/themes/classy/templates/dataset/item-list.html.twig */
class __TwigTemplate_26405e2d14cc76ef227335f537261d3fcc40c6e4a95c9477eba22bd1a06b4011 extends Twig_Template
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
        // line 19
        if (((isset($context["items"]) ? $context["items"] : null) || (isset($context["empty"]) ? $context["empty"] : null))) {
            // line 20
            echo "<div class=\"item-list\">";
            // line 21
            if ((!twig_test_empty((isset($context["title"]) ? $context["title"] : null)))) {
                // line 22
                echo "<h3>";
                echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
                echo "</h3>";
            }
            // line 24
            if ((isset($context["items"]) ? $context["items"] : null)) {
                // line 25
                echo "<";
                echo twig_drupal_escape_filter($this->env, (isset($context["list_type"]) ? $context["list_type"] : null), "html", null, true);
                echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
                echo ">";
                // line 26
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 27
                    echo "<li";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "attributes", array()), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "value", array()), "html", null, true);
                    echo "</li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "</";
                echo twig_drupal_escape_filter($this->env, (isset($context["list_type"]) ? $context["list_type"] : null), "html", null, true);
                echo ">";
            } else {
                // line 31
                echo twig_drupal_escape_filter($this->env, (isset($context["empty"]) ? $context["empty"] : null), "html", null, true);
            }
            // line 33
            echo "</div>";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/dataset/item-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 33,  56 => 31,  51 => 29,  41 => 27,  37 => 26,  32 => 25,  30 => 24,  25 => 22,  23 => 21,  21 => 20,  19 => 19,);
    }
}
