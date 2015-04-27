<?php

/* core/themes/classy/templates/navigation/links.html.twig */
class __TwigTemplate_1961429fcab5e412b8c76aed826aaba381a94300f4459cc9127ba01c9a65b3aa extends Twig_Template
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
        // line 37
        if ((isset($context["links"]) ? $context["links"] : null)) {
            // line 38
            if ((isset($context["heading"]) ? $context["heading"] : null)) {
                // line 39
                if ($this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level", array())) {
                    // line 40
                    echo "<";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level", array()), "html", null, true);
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "attributes", array()), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "text", array()), "html", null, true);
                    echo "</";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "level", array()), "html", null, true);
                    echo ">";
                } else {
                    // line 42
                    echo "<h2";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "attributes", array()), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["heading"]) ? $context["heading"] : null), "text", array()), "html", null, true);
                    echo "</h2>";
                }
            }
            // line 45
            echo "<ul";
            echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
            echo ">";
            // line 46
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["links"]) ? $context["links"] : null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 47
                echo "<li";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["item"], "attributes", array()), "addClass", array(0 => \Drupal\Component\Utility\Html::getClass($context["key"])), "method"), "html", null, true);
                echo ">";
                // line 48
                if ($this->getAttribute($context["item"], "link", array())) {
                    // line 49
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()), "html", null, true);
                } elseif ($this->getAttribute($context["item"], "text_attributes", array())) {
                    // line 51
                    echo "<span";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "text_attributes", array()), "html", null, true);
                    echo ">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "text", array()), "html", null, true);
                    echo "</span>";
                } else {
                    // line 53
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["item"], "text", array()), "html", null, true);
                }
                // line 55
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "</ul>";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/navigation/links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 57,  70 => 55,  67 => 53,  60 => 51,  57 => 49,  55 => 48,  51 => 47,  47 => 46,  43 => 45,  35 => 42,  25 => 40,  23 => 39,  21 => 38,  19 => 37,);
    }
}
