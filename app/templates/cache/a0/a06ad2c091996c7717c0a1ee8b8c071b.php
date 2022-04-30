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

/* partials/blockquote.html */
class __TwigTemplate_28c5d85b38fbda8a3d36e1694b53342d extends Template
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
        echo "<blockquote>
    <div class=\"sayer\">
        <a href=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "sayer_link", [], "any", false, false, false, 3), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "sayer", [], "any", false, false, false, 3), "html", null, true);
        echo "</a>
    </div>
    <div class=\"quote\">
        ";
        // line 6
        if ( !($context["is_single_quote"] ?? null)) {
            echo "<a href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "link", [], "any", false, false, false, 6), "html", null, true);
            echo "\">";
        }
        // line 7
        echo "        ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "quote", [], "any", false, false, false, 7), "html", null, true);
        echo "
        ";
        // line 8
        if ( !($context["is_single_quote"] ?? null)) {
            echo "</a>";
        }
        // line 9
        echo "    </div>
    <div class=\"meta\">
        <div><span class=\"icon-clock\"></span> ";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "ago", [], "any", false, false, false, 11), "html", null, true);
        echo "</div>
        <div><span class=\"icon-pencil\"></span> <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "submitter_link", [], "any", false, false, false, 12), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "submitter", [], "any", false, false, false, 12), "html", null, true);
        echo "</a></div>
        <div class=\"like-container\">
            <a class=\"icon-heart1 quote-btn-like\" data-id=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "id", [], "any", false, false, false, 14), "html", null, true);
        echo "\"></a> <span id=\"q";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "id", [], "any", false, false, false, 14), "html", null, true);
        echo "-likes\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "likes", [], "any", false, false, false, 14), "html", null, true);
        echo "</span>
            <div id=\"q";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "id", [], "any", false, false, false, 15), "html", null, true);
        echo "-anim\" class=\"anim\">
                <span class=\"heart\"><span class=\"icon icon-heart1\"></span></span>
                <span class=\"heart\"><span class=\"icon icon-heart1\"></span></span>
                <span class=\"heart\"><span class=\"icon icon-heart1\"></span></span>
            </div>
        </div>
        <div><a href=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "link", [], "any", false, false, false, 21), "html", null, true);
        echo "\" class=\"icon-share quote-btn-share\"></a></div>
        <div><span class=\"icon-price-tags\"></span>";
        // line 22
        echo twig_get_attribute($this->env, $this->source, ($context["quote"] ?? null), "tags_links", [], "any", false, false, false, 22);
        echo "</div>
    </div>
</blockquote>
";
    }

    public function getTemplateName()
    {
        return "partials/blockquote.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 22,  96 => 21,  87 => 15,  79 => 14,  72 => 12,  68 => 11,  64 => 9,  60 => 8,  55 => 7,  49 => 6,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "partials/blockquote.html", "/var/www/templates/partials/blockquote.html");
    }
}
