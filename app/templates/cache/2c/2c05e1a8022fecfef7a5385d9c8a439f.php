<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* partials/nav.html */
class __TwigTemplate_b3d9e31518442c0248ba1056ce32b1d0 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div id=\"topbar\" class=\"topbar\">
    <div class=\"menu-items\">
        <div id=\"btnSearch\" class=\"search\"><span class=\"icon-search\"></span></div>
        <div id=\"title\" class=\"title\"><a href=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 4), "html", null, true);
        echo "\">topquote.nl</a></div>
        <div class=\"menu\">
            <input type=\"checkbox\" class=\"menu-cb\" id=\"menucb\">
            <label for=\"menucb\">
                <div class=\"menu-panel\">
                    <ul>
                        <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 10), "html", null, true);
        echo "/quotes\"><span class=\"icon-clock\"></span>Nieuwste</a></li>
                        <li><a href=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 11), "html", null, true);
        echo "/quotes?ob=likes\"><span class=\"icon-heart1\"></span>Meeste&nbsp;likes</a></li>
                        <li><a href=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 12), "html", null, true);
        echo "/add\" class=\"btn\"><span class=\"icon-plus\"></span>Toevoegen</a></li>
                        <li><a href=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 13), "html", null, true);
        echo "/feedback\"><span class=\"icon-pen\"></span>Mail ons</a></li>
                        <li><a href=\"http://eepurl.com/hm_WEr\" target=\"_blank\" rel=\"noopener\"><span class=\"icon-mail\"></span>Mailinglijst</a></li>
                        <li class=\"clrs\">
                            ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, 6));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 17
            echo "                            <div class=\"clr c-";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            if (($context["i"] == 0)) {
                echo " active";
            }
            echo "\" data-c=\"";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "\"></div>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "                        </li>
                    </ul>
                </div>
                <div class=\"spinner-container\"><span class=\"icon-ellipsis\"></span></div>
            </label>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "partials/nav.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 19,  73 => 17,  69 => 16,  63 => 13,  59 => 12,  55 => 11,  51 => 10,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "partials/nav.html", "/var/www/templates/partials/nav.html");
    }
}
