<?php

/* core/themes/classy/templates/form/select.html.twig */
class __TwigTemplate_4462a0a5facea4a8f48e2703d6b182d829011b40a2f59bb0a7f870e375f23188 extends Twig_Template
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
        // line 13
        echo "<select";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">";
        echo twig_drupal_escape_filter($this->env, (isset($context["options"]) ? $context["options"] : null), "html", null, true);
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/form/select.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 13,);
    }
}
