<?php

/* core/themes/classy/templates/form/details.html.twig */
class __TwigTemplate_2f5c575ed84372aa953ebd1635355e9db58606c2baff0707442806952f2f6160 extends Twig_Template
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
        // line 16
        echo "<details";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">";
        // line 17
        if ((isset($context["title"]) ? $context["title"] : null)) {
            // line 18
            echo "<summary";
            echo twig_drupal_escape_filter($this->env, (isset($context["summary_attributes"]) ? $context["summary_attributes"] : null), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "</summary>";
        }
        // line 20
        echo "<div class=\"details-wrapper\">";
        // line 21
        if ((isset($context["description"]) ? $context["description"] : null)) {
            // line 22
            echo "<div class=\"details-description\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["description"]) ? $context["description"] : null), "html", null, true);
            echo "</div>";
        }
        // line 24
        if ((isset($context["children"]) ? $context["children"] : null)) {
            // line 25
            echo twig_drupal_escape_filter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true);
        }
        // line 27
        if ((isset($context["value"]) ? $context["value"] : null)) {
            // line 28
            echo twig_drupal_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        }
        // line 30
        echo "</div>
</details>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/form/details.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 30,  48 => 28,  46 => 27,  43 => 25,  41 => 24,  36 => 22,  34 => 21,  32 => 20,  25 => 18,  23 => 17,  19 => 16,);
    }
}
