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

/* home.html */
class __TwigTemplate_0e4501d0192a2b94e8498583e519c8fd extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html", "home.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Home";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
    <meta property=\"og:title\" content=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["site_title"] ?? null), "html", null, true);
        echo "\" />
    <meta property=\"og:url\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 7), "html", null, true);
        echo "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta name=\"description\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["site_description"] ?? null), "html", null, true);
        echo "\">
    <meta property=\"og:description\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["site_description"] ?? null), "html", null, true);
        echo "\" />
";
    }

    // line 13
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 14
        echo "<h2 id=\"home_title_bg\" class=\"fixed\">topquote</h2>
<a class=\"h1\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["site_url"] ?? null), "html", null, true);
        echo "\"><h1 id=\"home_title\">topquote</h1></a>

<section id=\"quotes_list\" class=\"quotes-list\">

    <h3 class=\"full\">Afgelopen maand gezegd</h3>
    ";
        // line 20
        $context["quote"] = ($context["said_last_week"] ?? null);
        // line 21
        echo "    ";
        echo twig_include($this->env, $context, "partials/blockquote.html");
        echo "

    <h3 class=\"full\">Random uitspraak</h3>
    ";
        // line 24
        $context["quote"] = ($context["random_quote"] ?? null);
        // line 25
        echo "    ";
        echo twig_include($this->env, $context, "partials/blockquote.html");
        echo "
    
    <div class=\"readable ranking marg-bot\">
        <h3 class=\"full\">Top tags</h3>
        <p>De populairste tags van deze week:</p>
        <ul class=\"rank-cloud\">
            ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["top_tags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 32
            echo "            <li><span class=\"icon-price-tags\"></span><a href=\"";
            echo twig_escape_filter($this->env, ($context["site_url"] ?? null), "html", null, true);
            echo "/quotes/tag/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 32), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 32), "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "        </ul>
    </div>
    
    <div class=\"readable marg-bot\">
        <h3 class=\"full\">Sla je eigen uitspraken op!</h3>
        <p>Sla al die prachtige, ontwapenende en hilarische quotes van je collega&rsquo;s, kinderen, vriend-en-vijanden en (on)bekenden op. Je hoeft geen account te maken.</p>
        <div class=\"centered pad-top-20\">
            <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, ($context["site_url"] ?? null), "html", null, true);
        echo "/add\" class=\"btn\">Uitspraak toevoegen</a>
        </div>
    </div>
    
    <div class=\"readable ranking marg-bot\">
        <h3 class=\"full\">Top zeggers</h3>
        <p>Ranking the stars! De meeste uitspraken zijn momenteel van ...</p>
        <ul class=\"rank-cloud\">
            ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["top_sayers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sayer"]) {
            // line 50
            echo "            <li><span class=\"icon-topquote-logo-outlines\"></span><a href=\"";
            echo twig_escape_filter($this->env, ($context["site_url"] ?? null), "html", null, true);
            echo "/quotes/by/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["sayer"], "sayer_slug", [], "any", false, false, false, 50), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["sayer"], "sayer", [], "any", false, false, false, 50), "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sayer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "        </ul>
    </div>
    
    <div class=\"readable marg-bot\">
        <h3 class=\"full\">Op de hoogte blijven</h3>
        <p>Schrijf je hier in om af en toe een update te krijgen. We geven je e-mailadres niet aan derden. Beloofd!</p>
        <div id=\"mc_embed_signup\">
            ";
        // line 59
        echo twig_include($this->env, $context, "partials/mailform.html");
        echo "
        </div>
    </div>
    
    <div class=\"readable ranking marg-bot\">
        <h3 class=\"full\">Top inzenders</h3>
        <p>Op dit moment zijn de meeste uitspraken die werden ingezonden van:</p>
        <ul class=\"rank-cloud\">
            ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["top_submitters"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["submitter"]) {
            // line 68
            echo "            <li><span class=\"icon-pencil\"></span><a href=\"";
            echo twig_escape_filter($this->env, ($context["site_url"] ?? null), "html", null, true);
            echo "/quotes/from/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["submitter"], "submitter_slug", [], "any", false, false, false, 68), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["submitter"], "submitter", [], "any", false, false, false, 68), "html", null, true);
            echo "</a></li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['submitter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "        </ul>
    </div>


";
    }

    public function getTemplateName()
    {
        return "home.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 70,  197 => 68,  193 => 67,  182 => 59,  173 => 52,  160 => 50,  156 => 49,  145 => 41,  136 => 34,  123 => 32,  119 => 31,  109 => 25,  107 => 24,  100 => 21,  98 => 20,  90 => 15,  87 => 14,  83 => 13,  77 => 10,  73 => 9,  68 => 7,  64 => 6,  59 => 5,  55 => 4,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "home.html", "/var/www/templates/home.html");
    }
}
