<?php

/* core/themes/classy/templates/layout/html.html.twig */
class __TwigTemplate_59b3e5b3ebb5ff4c578705e505d2ecaec62d8c7150930948311663de69dc0c95 extends Twig_Template
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
        // line 31
        $context["body_classes"] = array(0 => (((isset($context["logged_in"]) ? $context["logged_in"] : null)) ? ("user-logged-in") : ("")), 1 => (((!(isset($context["root_path"]) ? $context["root_path"] : null))) ? ("path-frontpage") : (("path-" . \Drupal\Component\Utility\Html::getClass((isset($context["root_path"]) ? $context["root_path"] : null))))), 2 => (((isset($context["node_type"]) ? $context["node_type"] : null)) ? (("node--type-" . \Drupal\Component\Utility\Html::getClass((isset($context["node_type"]) ? $context["node_type"] : null)))) : ("")));
        // line 37
        echo "<!DOCTYPE html>
<html";
        // line 38
        echo twig_drupal_escape_filter($this->env, (isset($context["html_attributes"]) ? $context["html_attributes"] : null), "html", null, true);
        echo ">
  <head>
    ";
        // line 40
        echo twig_drupal_escape_filter($this->env, (isset($context["head"]) ? $context["head"] : null), "html", null, true);
        echo "
    <title>";
        // line 41
        echo twig_drupal_escape_filter($this->env, (isset($context["head_title"]) ? $context["head_title"] : null), "html", null, true);
        echo "</title>
    ";
        // line 42
        echo twig_drupal_escape_filter($this->env, (isset($context["styles"]) ? $context["styles"] : null), "html", null, true);
        echo "
    ";
        // line 43
        echo twig_drupal_escape_filter($this->env, (isset($context["scripts"]) ? $context["scripts"] : null), "html", null, true);
        echo "
  </head>
  <body";
        // line 45
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["body_classes"]) ? $context["body_classes"] : null)), "method"), "html", null, true);
        echo ">
    <a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
      ";
        // line 47
        echo twig_render_var(t("Skip to main content"));
        echo "
    </a>
    ";
        // line 49
        echo twig_drupal_escape_filter($this->env, (isset($context["page_top"]) ? $context["page_top"] : null), "html", null, true);
        echo "
    ";
        // line 50
        echo twig_drupal_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : null), "html", null, true);
        echo "
    ";
        // line 51
        echo twig_drupal_escape_filter($this->env, (isset($context["page_bottom"]) ? $context["page_bottom"] : null), "html", null, true);
        echo "
    ";
        // line 52
        echo twig_drupal_escape_filter($this->env, (isset($context["scripts_bottom"]) ? $context["scripts_bottom"] : null), "html", null, true);
        echo "
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/layout/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 52,  64 => 51,  60 => 50,  56 => 49,  51 => 47,  46 => 45,  41 => 43,  37 => 42,  33 => 41,  29 => 40,  24 => 38,  21 => 37,  19 => 31,);
    }
}
