<?php

/* core/themes/bartik/templates/block--system-menu-block.html.twig */
class __TwigTemplate_0d719db7ac95666e7e797633c4d244aabdd42a2d82b3587e4aa1a4ef289f6704 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@classy/block/block--system-menu-block.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@classy/block/block--system-menu-block.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 10
        $context["show_anchor"] = ("show-" . \Drupal\Component\Utility\Html::getId($this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "id", array())));
        // line 11
        $context["hide_anchor"] = ("hide-" . \Drupal\Component\Utility\Html::getId($this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "id", array())));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        // line 13
        echo "  ";
        // line 14
        echo "  ";
        if ($this->getAttribute((isset($context["configuration"]) ? $context["configuration"] : null), "label_display", array())) {
            // line 15
            echo "    <div";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["content_attributes"]) ? $context["content_attributes"] : null), "addClass", array(0 => "content"), "method"), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
            echo "</div>
  ";
        } else {
            // line 17
            echo "    ";
            // line 18
            echo "    <div class=\"menu-toggle-target menu-toggle-target-show\" id=\"";
            echo twig_drupal_escape_filter($this->env, (isset($context["show_anchor"]) ? $context["show_anchor"] : null), "html", null, true);
            echo "\"></div>
    <div class=\"menu-toggle-target\" id=\"";
            // line 19
            echo twig_drupal_escape_filter($this->env, (isset($context["hide_anchor"]) ? $context["hide_anchor"] : null), "html", null, true);
            echo "\"></div>
    <a class=\"menu-toggle\" href=\"#";
            // line 20
            echo twig_drupal_escape_filter($this->env, (isset($context["show_anchor"]) ? $context["show_anchor"] : null), "html", null, true);
            echo "\">";
            echo twig_render_var(t("Menu"));
            echo "</a>
    <a class=\"menu-toggle menu-toggle--hide\" href=\"#";
            // line 21
            echo twig_drupal_escape_filter($this->env, (isset($context["hide_anchor"]) ? $context["hide_anchor"] : null), "html", null, true);
            echo "\">";
            echo twig_render_var(t("Menu"));
            echo "</a>
    ";
            // line 22
            echo twig_drupal_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
            echo "
  ";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/block--system-menu-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 22,  65 => 21,  59 => 20,  55 => 19,  50 => 18,  48 => 17,  40 => 15,  37 => 14,  35 => 13,  32 => 12,  27 => 11,  25 => 10,);
    }
}
