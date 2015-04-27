<?php

/* core/themes/bartik/templates/page.html.twig */
class __TwigTemplate_fe456f29b7b519904f694526cc10a2c691b478879af79f42767774c304959eae extends Twig_Template
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
        // line 75
        echo "<div id=\"page-wrapper\">
  <div id=\"page\">
    <header id=\"header\" class=\"header\" role=\"banner\" aria-label=\"";
        // line 77
        echo twig_render_var(t("Site header"));
        echo "\">
      <div class=\"section layout-container clearfix\">
        ";
        // line 79
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "secondary_menu", array()), "html", null, true);
        echo "
        ";
        // line 80
        if ((isset($context["logo"]) ? $context["logo"] : null)) {
            // line 81
            echo "          <a href=\"";
            echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
            echo "\" title=\"";
            echo twig_render_var(t("Home"));
            echo "\" rel=\"home\" id=\"logo\">
            <img src=\"";
            // line 82
            echo twig_drupal_escape_filter($this->env, (isset($context["logo"]) ? $context["logo"] : null), "html", null, true);
            echo "\" alt=\"";
            echo twig_render_var(t("Home"));
            echo "\" />
          </a>
        ";
        }
        // line 85
        echo "        ";
        if (((isset($context["site_name"]) ? $context["site_name"] : null) || (isset($context["site_slogan"]) ? $context["site_slogan"] : null))) {
            // line 86
            echo "          <div id=\"name-and-slogan\"";
            if (((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null) && (isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null))) {
                echo " class=\"visually-hidden\"";
            }
            echo ">
            ";
            // line 87
            if ((isset($context["site_name"]) ? $context["site_name"] : null)) {
                // line 88
                echo "              ";
                if ((isset($context["title"]) ? $context["title"] : null)) {
                    // line 89
                    echo "                <div id=\"site-name\"";
                    if ((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null)) {
                        echo " class=\"visually-hidden\"";
                    }
                    echo ">
                  <strong>
                    <a href=\"";
                    // line 91
                    echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
                    echo "\" title=\"";
                    echo twig_render_var(t("Home"));
                    echo "\" rel=\"home\"><span>";
                    echo twig_drupal_escape_filter($this->env, (isset($context["site_name"]) ? $context["site_name"] : null), "html", null, true);
                    echo "</span></a>
                  </strong>
                </div>
              ";
                    // line 95
                    echo "              ";
                } else {
                    // line 96
                    echo "                <h1 id=\"site-name\"";
                    if ((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null)) {
                        echo " class=\"visually-hidden\" ";
                    }
                    echo ">
                  <a href=\"";
                    // line 97
                    echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
                    echo "\" title=\"";
                    echo twig_render_var(t("Home"));
                    echo "\" rel=\"home\"><span>";
                    echo twig_drupal_escape_filter($this->env, (isset($context["site_name"]) ? $context["site_name"] : null), "html", null, true);
                    echo "</span></a>
                </h1>
              ";
                }
                // line 100
                echo "            ";
            }
            // line 101
            echo "            ";
            if ((isset($context["site_slogan"]) ? $context["site_slogan"] : null)) {
                // line 102
                echo "              <div id=\"site-slogan\"";
                if ((isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null)) {
                    echo " class=\"visually-hidden\"";
                }
                echo ">
                ";
                // line 103
                echo twig_drupal_escape_filter($this->env, (isset($context["site_slogan"]) ? $context["site_slogan"] : null), "html", null, true);
                echo "
              </div>
            ";
            }
            // line 106
            echo "          </div>
        ";
        }
        // line 108
        echo "        ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "html", null, true);
        echo "
        ";
        // line 109
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "primary_menu", array()), "html", null, true);
        echo "
      </div>
    </header>
    ";
        // line 112
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "messages", array()), "html", null, true);
        echo "
    ";
        // line 113
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_top", array())) {
            // line 114
            echo "      <div class=\"featured-top\">
        <aside class=\"featured-top__inner section layout-container clearfix\" role=\"complementary\">
          ";
            // line 116
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_top", array()), "html", null, true);
            echo "
        </aside>
      </div>
    ";
        }
        // line 120
        echo "    <div id=\"main-wrapper\" class=\"layout-main-wrapper layout-container clearfix\">
      <div id=\"main\" class=\"layout-main clearfix\">
        ";
        // line 122
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "breadcrumb", array()), "html", null, true);
        echo "
        <main id=\"content\" class=\"column main-content\" role=\"main\">
          <section class=\"section\">
            <a id=\"main-content\" tabindex=\"-1\"></a>
            ";
        // line 126
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
            ";
        // line 127
        if ((isset($context["title"]) ? $context["title"] : null)) {
            // line 128
            echo "              <h1 class=\"title\" id=\"page-title\">
                ";
            // line 129
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "
              </h1>
            ";
        }
        // line 132
        echo "            ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "
            ";
        // line 133
        if ((isset($context["tabs"]) ? $context["tabs"] : null)) {
            // line 134
            echo "              <nav class=\"tabs\" role=\"navigation\" aria-label=\"";
            echo twig_render_var(t("Tabs"));
            echo "\">
                ";
            // line 135
            echo twig_drupal_escape_filter($this->env, (isset($context["tabs"]) ? $context["tabs"] : null), "html", null, true);
            echo "
              </nav>
            ";
        }
        // line 138
        echo "            ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "help", array()), "html", null, true);
        echo "
            ";
        // line 139
        if ((isset($context["action_links"]) ? $context["action_links"] : null)) {
            // line 140
            echo "              <ul class=\"action-links\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["action_links"]) ? $context["action_links"] : null), "html", null, true);
            echo "</ul>
            ";
        }
        // line 142
        echo "            ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content", array()), "html", null, true);
        echo "
          </section>
        </main>
        ";
        // line 145
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array())) {
            // line 146
            echo "          <div id=\"sidebar-first\" class=\"column sidebar\">
            <aside class=\"section\" role=\"complementary\">
              ";
            // line 148
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array()), "html", null, true);
            echo "
            </aside>
          </div>
        ";
        }
        // line 152
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array())) {
            // line 153
            echo "          <div id=\"sidebar-second\" class=\"column sidebar\">
            <aside class=\"section\" role=\"complementary\">
              ";
            // line 155
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array()), "html", null, true);
            echo "
            </aside>
          </div>
        ";
        }
        // line 159
        echo "      </div>
    </div>
    ";
        // line 161
        if ((($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_first", array()) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_second", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_third", array()))) {
            // line 162
            echo "      <div id=\"featured-bottom-wrapper\">
        <aside id=\"featured-bottom\" class=\"section layout-container clearfix\" role=\"complementary\">
          ";
            // line 164
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_first", array()), "html", null, true);
            echo "
          ";
            // line 165
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_second", array()), "html", null, true);
            echo "
          ";
            // line 166
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured_bottom_third", array()), "html", null, true);
            echo "
        </aside>
      </div>
    ";
        }
        // line 170
        echo "    <div id=\"site-footer__wrapper\">
      <footer class=\"site-footer section layout-container\">
        ";
        // line 172
        if (((($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_first", array()) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_second", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_third", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fourth", array()))) {
            // line 173
            echo "          <div id=\"footer-columns\" class=\"clearfix\">
            ";
            // line 174
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_first", array()), "html", null, true);
            echo "
            ";
            // line 175
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_second", array()), "html", null, true);
            echo "
            ";
            // line 176
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_third", array()), "html", null, true);
            echo "
            ";
            // line 177
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fourth", array()), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 180
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fifth", array())) {
            // line 181
            echo "          <div id=\"site-footer__bottom\" role=\"contentinfo\">
            ";
            // line 182
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fifth", array()), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 185
        echo "      </footer>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  308 => 185,  302 => 182,  299 => 181,  296 => 180,  290 => 177,  286 => 176,  282 => 175,  278 => 174,  275 => 173,  273 => 172,  269 => 170,  262 => 166,  258 => 165,  254 => 164,  250 => 162,  248 => 161,  244 => 159,  237 => 155,  233 => 153,  230 => 152,  223 => 148,  219 => 146,  217 => 145,  210 => 142,  204 => 140,  202 => 139,  197 => 138,  191 => 135,  186 => 134,  184 => 133,  179 => 132,  173 => 129,  170 => 128,  168 => 127,  164 => 126,  157 => 122,  153 => 120,  146 => 116,  142 => 114,  140 => 113,  136 => 112,  130 => 109,  125 => 108,  121 => 106,  115 => 103,  108 => 102,  105 => 101,  102 => 100,  92 => 97,  85 => 96,  82 => 95,  72 => 91,  64 => 89,  61 => 88,  59 => 87,  52 => 86,  49 => 85,  41 => 82,  34 => 81,  32 => 80,  28 => 79,  23 => 77,  19 => 75,);
    }
}
