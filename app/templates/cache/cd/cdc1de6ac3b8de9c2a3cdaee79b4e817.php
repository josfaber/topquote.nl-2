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

/* partials/mailform.html */
class __TwigTemplate_9030df1c7ee9111897764d5437fb44b2 extends Template
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
        echo "<form rel=\"noopener\" action=\"";
        echo twig_escape_filter($this->env, ($context["mailchimp_url"] ?? null), "html", null, true);
        echo "\" method=\"post\" id=\"mc-embedded-subscribe-form\"
    name=\"mc-embedded-subscribe-form\" class=\"validate\" target=\"_blank\" novalidate>
    <div id=\"mc_embed_signup_scroll\">
        <div class=\"mc-field-group g1\">
            <label for=\"mce-EMAIL\">E-mail<span class=\"asterisk\">*</span>
            </label>
            <input type=\"email\" value=\"\" name=\"EMAIL\" class=\"required email\" id=\"mce-EMAIL\">
        </div>
        <div class=\"mc-field-group g2\">
            <label for=\"mce-FNAME\">Voornaam</label>
            <input type=\"text\" value=\"\" name=\"FNAME\" class=\"\" id=\"mce-FNAME\">
        </div>
        <div id=\"mce-responses\" class=\"clear\">
            <div class=\"response\" id=\"mce-error-response\" style=\"display:none\"></div>
            <div class=\"response\" id=\"mce-success-response\" style=\"display:none\"></div>
        </div>
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style=\"position: absolute; left: -5000px;\" aria-hidden=\"true\"><input type=\"text\"
                name=\"b_5cf361923ba15b710ba59f543_465c5af3ba\" tabindex=\"-1\" value=\"\"></div>
        <div class=\"mc-field-group g3\"><button id=\"mc-embedded-subscribe\">Inschrijven</button></div>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "partials/mailform.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "partials/mailform.html", "/var/www/templates/partials/mailform.html");
    }
}
