<?php

/* core/themes/classy/templates/block/block.html.twig */
class __TwigTemplate_ad1700627bcc4c9d5ae8a841cb4347eb9e6ad18f7fc952c339850288156de48c extends Twig_Template
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
        // line 36
        $context["classes"] = array(0 => "block", 1 => ("block-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute((isset($context["configuration"]) ? $context["configuration"] : null), "provider", array()))));
        // line 41
        echo "<div";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true);
        echo ">
  ";
        // line 42
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
  ";
        // line 43
        if ((isset($context["label"]) ? $context["label"] : null)) {
            // line 44
            echo "    <h2";
            echo twig_drupal_escape_filter($this->env, (isset($context["title_attributes"]) ? $context["title_attributes"] : null), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true);
            echo "</h2>
  ";
        }
        // line 46
        echo "  ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "
  ";
        // line 47
        $this->displayBlock('content', $context, $blocks);
        // line 50
        echo "</div>
";
    }

    // line 47
    public function block_content($context, array $blocks = array())
    {
        // line 48
        echo "    ";
        echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/block/block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 48,  53 => 47,  48 => 50,  46 => 47,  41 => 46,  33 => 44,  31 => 43,  27 => 42,  22 => 41,  20 => 36,);
    }
}
