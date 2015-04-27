<?php

/* core/themes/classy/templates/form/fieldset.html.twig */
class __TwigTemplate_b3b69c3897453a958601c8859a8672a0874f93a4351b9ef42a18826adc2fc773 extends Twig_Template
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
        // line 22
        echo "<fieldset";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => "form-item", 1 => "form-wrapper"), "method"), "html", null, true);
        echo ">
  ";
        // line 24
        $context["legend_span_classes"] = array(0 => "fieldset-legend", 1 => (((isset($context["required"]) ? $context["required"] : null)) ? ("form-required") : ("")));
        // line 29
        echo "  ";
        // line 30
        echo "  <legend";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["legend"]) ? $context["legend"] : null), "attributes", array()), "html", null, true);
        echo ">
    <span";
        // line 31
        echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["legend_span"]) ? $context["legend_span"] : null), "attributes", array()), "addClass", array(0 => (isset($context["legend_span_classes"]) ? $context["legend_span_classes"] : null)), "method"), "html", null, true);
        echo ">";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["legend"]) ? $context["legend"] : null), "title", array()), "html", null, true);
        echo "</span>
  </legend>
  <div class=\"fieldset-wrapper\">
    ";
        // line 34
        if ((isset($context["prefix"]) ? $context["prefix"] : null)) {
            // line 35
            echo "      <span class=\"field-prefix\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["prefix"]) ? $context["prefix"] : null), "html", null, true);
            echo "</span>
    ";
        }
        // line 37
        echo "    ";
        echo twig_drupal_escape_filter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true);
        echo "
    ";
        // line 38
        if ((isset($context["suffix"]) ? $context["suffix"] : null)) {
            // line 39
            echo "      <span class=\"field-suffix\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["suffix"]) ? $context["suffix"] : null), "html", null, true);
            echo "</span>
    ";
        }
        // line 41
        echo "    ";
        if ($this->getAttribute((isset($context["description"]) ? $context["description"] : null), "content", array())) {
            // line 42
            echo "      <div";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["description"]) ? $context["description"] : null), "attributes", array()), "addClass", array(0 => "description"), "method"), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["description"]) ? $context["description"] : null), "content", array()), "html", null, true);
            echo "</div>
    ";
        }
        // line 44
        echo "  </div>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/form/fieldset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 44,  65 => 42,  62 => 41,  56 => 39,  54 => 38,  49 => 37,  43 => 35,  41 => 34,  33 => 31,  28 => 30,  26 => 29,  24 => 24,  19 => 22,);
    }
}
