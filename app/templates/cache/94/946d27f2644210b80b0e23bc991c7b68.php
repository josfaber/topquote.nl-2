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

/* base.html */
class __TwigTemplate_cfdfb8f33f994852a4090186a4697d26 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'title' => [$this, 'block_title'],
            'nav' => [$this, 'block_nav'],
            'content' => [$this, 'block_content'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 15
        echo "    </head>
    <body class=\"";
        // line 16
        if (($context["is_home"] ?? null)) {
            echo "home";
        }
        if (($context["is_single_quote"] ?? null)) {
            echo " single-quote ";
        }
        echo "\">
        <nav>
            ";
        // line 18
        $this->displayBlock('nav', $context, $blocks);
        // line 21
        echo "        </nav>
        <main>
            ";
        // line 23
        $this->displayBlock('content', $context, $blocks);
        // line 26
        echo "        </main>
        ";
        // line 27
        $this->displayBlock('scripts', $context, $blocks);
        // line 33
        echo "        <div id=\"terms-container\" class=\"terms-container\">
            <input type=\"text\" id=\"terms\">
        </div>
        <div id=\"share-container\" class=\"share-container\">
            <div id=\"share-url\" class=\"share-url\">";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["tqd"] ?? null), "site_url", [], "any", false, false, false, 37), "html", null, true);
        echo "</div>
            <div class=\"share-buttons\">
                <span id=\"btnCopy\" class=\"icon-copy\" data-action=\"copy\"></span>
                <span id=\"btnTweet\" class=\"icon-twitter\" data-action=\"twitter\"></span>
                <span id=\"btnMail\" class=\"icon-mail\" data-action=\"mail\"></span>
            </div>
        </div>
        <div id=\"loader-container\" class=\"loader-container\">
            <span class=\"icon-spinner\"></span>
        </div>
    </body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
            <link rel=\"profile\" href=\"http://gmpg.org/xfn/11\" />
            <link rel=\"dns-prefetch\" href=\"//use.typekit.net\">
            <link rel=\"preconnect\" href=\"https://use.typekit.net/\" crossorigin>
            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["css_files"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["css_file"]) {
            // line 11
            echo "                <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $context["css_file"], "html", null, true);
            echo "\">
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "            <title>";
        $this->displayBlock('title', $context, $blocks);
        echo " - topquote</title>
        ";
    }

    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 18
    public function block_nav($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 19
        echo "            ";
        echo twig_include($this->env, $context, "partials/nav.html");
        echo "
            ";
    }

    // line 23
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 24
        echo "                content
            ";
    }

    // line 27
    public function block_scripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 28
        echo "            <script>window.tqd = { is_search: ";
        if (($context["is_search"] ?? null)) {
            echo "true";
        } else {
            echo "false";
        }
        echo " , rsk: '";
        echo twig_escape_filter($this->env, ($context["RECAPTCHA_SITE_KEY"] ?? null), "html", null, true);
        echo "', ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tqd"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo ": '";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "', ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tqd_num"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo ", ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " };</script>
            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["js_files"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_file"]) {
            // line 30
            echo "                <script src=\"";
            echo twig_escape_filter($this->env, $context["js_file"], "html", null, true);
            echo "\"></script>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "        ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 32,  197 => 30,  193 => 29,  157 => 28,  153 => 27,  148 => 24,  144 => 23,  137 => 19,  133 => 18,  121 => 13,  112 => 11,  108 => 10,  101 => 5,  97 => 4,  81 => 37,  75 => 33,  73 => 27,  70 => 26,  68 => 23,  64 => 21,  62 => 18,  52 => 16,  49 => 15,  47 => 4,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.html", "/var/www/templates/base.html");
    }
}
