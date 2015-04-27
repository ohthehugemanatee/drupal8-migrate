<?php

/* @classy/block/block--system-menu-block.html.twig */
class __TwigTemplate_bcf730392e18d13056f9a940f0627ea8e84e3406b2877b6391fdc398a09c6201 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 42
        $context["classes"] = array(0 => "block", 1 => "block-menu", 2 => "navigation", 3 => ("menu--" . \Drupal\Component\Utility\Html::getClass((isset($context["derivative_plugin_id"]) ? $context["derivative_plugin_id"] : null))));
        // line 49
        $context["heading_id"] = ($this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "id", array()) . \Drupal\Component\Utility\Html::getId("-menu"));
        // line 50
        echo "<nav";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true);
        echo " role=\"navigation\" aria-labelledby=\"";
        echo twig_drupal_escape_filter($this->env, (isset($context["heading_id"]) ? $context["heading_id"] : null), "html", null, true);
        echo "\">
  ";
        // line 52
        echo "  ";
        if ((!$this->getAttribute((isset($context["configuration"]) ? $context["configuration"] : null), "label_display", array()))) {
            // line 53
            echo "    ";
            $context["title_attributes"] = $this->getAttribute((isset($context["title_attributes"]) ? $context["title_attributes"] : null), "addClass", array(0 => "visually-hidden"), "method");
            // line 54
            echo "  ";
        }
        // line 55
        echo "  ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
  <h2 id=\"";
        // line 56
        echo twig_drupal_escape_filter($this->env, (isset($context["heading_id"]) ? $context["heading_id"] : null), "html", null, true);
        echo "\"";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_attributes"]) ? $context["title_attributes"] : null), "html", null, true);
        echo ">";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["configuration"]) ? $context["configuration"] : null), "label", array()), "html", null, true);
        echo "</h2>
  ";
        // line 57
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "

  ";
        // line 60
        echo "  ";
        $this->displayBlock('content', $context, $blocks);
        // line 63
        echo "</nav>
";
    }

    // line 60
    public function block_content($context, array $blocks = array())
    {
        // line 61
        echo "    ";
        echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "@classy/block/block--system-menu-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 61,  66 => 60,  61 => 63,  58 => 60,  53 => 57,  45 => 56,  40 => 55,  37 => 54,  34 => 53,  31 => 52,  24 => 50,  22 => 49,  20 => 42,);
    }
}
