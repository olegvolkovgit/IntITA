<?php

/* acp_bbcodes.html */
class __TwigTemplate_3ddc0e3472d49021089936f6f783a22f extends Twig_Template
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
        // line 1
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_header.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (isset($context["S_EDIT_BBCODE"])) { $_S_EDIT_BBCODE_ = $context["S_EDIT_BBCODE"]; } else { $_S_EDIT_BBCODE_ = null; }
        if ($_S_EDIT_BBCODE_) {
            // line 6
            echo "
\t<a href=\"";
            // line 7
            if (isset($context["U_BACK"])) { $_U_BACK_ = $context["U_BACK"]; } else { $_U_BACK_ = null; }
            echo $_U_BACK_;
            echo "\" style=\"float: ";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 9
            echo $this->env->getExtension('phpbb')->lang("ACP_BBCODES");
            echo "</h1>

\t<p>";
            // line 11
            echo $this->env->getExtension('phpbb')->lang("ACP_BBCODES_EXPLAIN");
            echo "</p>

\t<form id=\"acp_bbcodes\" method=\"post\" action=\"";
            // line 13
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 16
            echo $this->env->getExtension('phpbb')->lang("BBCODE_USAGE");
            echo "</legend>
\t\t<p>";
            // line 17
            echo $this->env->getExtension('phpbb')->lang("BBCODE_USAGE_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_match\">";
            // line 19
            echo $this->env->getExtension('phpbb')->lang("EXAMPLES");
            echo "</label><br /><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("BBCODE_USAGE_EXAMPLE");
            echo "</span></dt>
\t\t<dd><textarea id=\"bbcode_match\" name=\"bbcode_match\" cols=\"60\" rows=\"5\">";
            // line 20
            if (isset($context["BBCODE_MATCH"])) { $_BBCODE_MATCH_ = $context["BBCODE_MATCH"]; } else { $_BBCODE_MATCH_ = null; }
            echo $_BBCODE_MATCH_;
            echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 25
            echo $this->env->getExtension('phpbb')->lang("HTML_REPLACEMENT");
            echo "</legend>
\t\t<p>";
            // line 26
            echo $this->env->getExtension('phpbb')->lang("HTML_REPLACEMENT_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_tpl\">";
            // line 28
            echo $this->env->getExtension('phpbb')->lang("EXAMPLES");
            echo "</label><br /><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("HTML_REPLACEMENT_EXAMPLE");
            echo "</span></dt>
\t\t<dd><textarea id=\"bbcode_tpl\" name=\"bbcode_tpl\" cols=\"60\" rows=\"8\">";
            // line 29
            if (isset($context["BBCODE_TPL"])) { $_BBCODE_TPL_ = $context["BBCODE_TPL"]; } else { $_BBCODE_TPL_ = null; }
            echo $_BBCODE_TPL_;
            echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 34
            echo $this->env->getExtension('phpbb')->lang("BBCODE_HELPLINE");
            echo "</legend>
\t\t<p>";
            // line 35
            echo $this->env->getExtension('phpbb')->lang("BBCODE_HELPLINE_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"bbcode_helpline\">";
            // line 37
            echo $this->env->getExtension('phpbb')->lang("BBCODE_HELPLINE_TEXT");
            echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"bbcode_helpline\" name=\"bbcode_helpline\" size=\"60\" maxlength=\"255\" value=\"";
            // line 38
            if (isset($context["BBCODE_HELPLINE"])) { $_BBCODE_HELPLINE_ = $context["BBCODE_HELPLINE"]; } else { $_BBCODE_HELPLINE_ = null; }
            echo $_BBCODE_HELPLINE_;
            echo "\" /></dd>
\t</dl>
\t</fieldset>

\t<fieldset>
\t\t<legend>";
            // line 43
            echo $this->env->getExtension('phpbb')->lang("SETTINGS");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"display_on_posting\">";
            // line 45
            echo $this->env->getExtension('phpbb')->lang("DISPLAY_ON_POSTING");
            echo "</label></dt>
\t\t<dd><input type=\"checkbox\" class=\"radio\" name=\"display_on_posting\" id=\"display_on_posting\" value=\"1\"";
            // line 46
            if (isset($context["DISPLAY_ON_POSTING"])) { $_DISPLAY_ON_POSTING_ = $context["DISPLAY_ON_POSTING"]; } else { $_DISPLAY_ON_POSTING_ = null; }
            if ($_DISPLAY_ON_POSTING_) {
                echo " checked=\"checked\"";
            }
            echo " /></dd>
\t</dl>
\t</fieldset>

\t";
            // line 50
            if (isset($context["acp_bbcodes_edit_fieldsets_after"])) { $_acp_bbcodes_edit_fieldsets_after_ = $context["acp_bbcodes_edit_fieldsets_after"]; } else { $_acp_bbcodes_edit_fieldsets_after_ = null; }
            // line 51
            echo "
\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
            // line 53
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 54
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 55
            echo $this->env->getExtension('phpbb')->lang("RESET");
            echo "\" />
\t\t";
            // line 56
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>
\t
\t<br />

\t<table class=\"table1\" id=\"down\">
\t<thead>
\t<tr>
\t\t<th colspan=\"2\">";
            // line 64
            echo $this->env->getExtension('phpbb')->lang("TOKENS");
            echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\" colspan=\"2\">";
            // line 67
            echo $this->env->getExtension('phpbb')->lang("TOKENS_EXPLAIN");
            echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
            // line 70
            echo $this->env->getExtension('phpbb')->lang("TOKEN");
            echo "</th>
\t\t<th>";
            // line 71
            echo $this->env->getExtension('phpbb')->lang("TOKEN_DEFINITION");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 75
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "token"));
            foreach ($context['_seq'] as $context["_key"] => $context["token"]) {
                // line 76
                echo "\t\t<tr style=\"vertical-align: top;\">
\t\t\t<td class=\"row1\">";
                // line 77
                if (isset($context["token"])) { $_token_ = $context["token"]; } else { $_token_ = null; }
                echo $this->getAttribute($_token_, "TOKEN");
                echo "</td>
\t\t\t<td class=\"row2\">";
                // line 78
                if (isset($context["token"])) { $_token_ = $context["token"]; } else { $_token_ = null; }
                echo $this->getAttribute($_token_, "EXPLAIN");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['token'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "\t</tbody>
\t</table>
\t</form>

";
        } else {
            // line 86
            echo "
\t<h1>";
            // line 87
            echo $this->env->getExtension('phpbb')->lang("ACP_BBCODES");
            echo "</h1>

\t<p>";
            // line 89
            echo $this->env->getExtension('phpbb')->lang("ACP_BBCODES_EXPLAIN");
            echo "</p>
\t
\t<form id=\"acp_bbcodes\" method=\"post\" action=\"";
            // line 91
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\">
\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 93
            echo $this->env->getExtension('phpbb')->lang("ACP_BBCODES");
            echo "</legend>

\t<table class=\"table1 zebra-table\" id=\"down\">
\t<thead>
\t<tr>
\t\t<th>";
            // line 98
            echo $this->env->getExtension('phpbb')->lang("BBCODE_TAG");
            echo "</th>
\t\t<th>";
            // line 99
            echo $this->env->getExtension('phpbb')->lang("ACTION");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 103
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "bbcodes"));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["bbcodes"]) {
                // line 104
                echo "\t\t<tr>
\t\t\t<td style=\"text-align: center;\">";
                // line 105
                if (isset($context["bbcodes"])) { $_bbcodes_ = $context["bbcodes"]; } else { $_bbcodes_ = null; }
                echo $this->getAttribute($_bbcodes_, "BBCODE_TAG");
                echo "</td>
\t\t\t<td class=\"actions\">";
                // line 106
                if (isset($context["acp_bbcodes_actions_prepend"])) { $_acp_bbcodes_actions_prepend_ = $context["acp_bbcodes_actions_prepend"]; } else { $_acp_bbcodes_actions_prepend_ = null; }
                echo " <a href=\"";
                if (isset($context["bbcodes"])) { $_bbcodes_ = $context["bbcodes"]; } else { $_bbcodes_ = null; }
                echo $this->getAttribute($_bbcodes_, "U_EDIT");
                echo "\">";
                if (isset($context["ICON_EDIT"])) { $_ICON_EDIT_ = $context["ICON_EDIT"]; } else { $_ICON_EDIT_ = null; }
                echo $_ICON_EDIT_;
                echo "</a> <a href=\"";
                if (isset($context["bbcodes"])) { $_bbcodes_ = $context["bbcodes"]; } else { $_bbcodes_ = null; }
                echo $this->getAttribute($_bbcodes_, "U_DELETE");
                echo "\" data-ajax=\"row_delete\">";
                if (isset($context["ICON_DELETE"])) { $_ICON_DELETE_ = $context["ICON_DELETE"]; } else { $_ICON_DELETE_ = null; }
                echo $_ICON_DELETE_;
                echo "</a> ";
                if (isset($context["acp_bbcodes_actions_append"])) { $_acp_bbcodes_actions_append_ = $context["acp_bbcodes_actions_append"]; } else { $_acp_bbcodes_actions_append_ = null; }
                echo "</td>
\t\t</tr>
\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 109
                echo "\t\t<tr class=\"row3\">
\t\t\t<td colspan=\"2\">";
                // line 110
                echo $this->env->getExtension('phpbb')->lang("ACP_NO_ITEMS");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bbcodes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "\t</tbody>
\t</table>

\t<p class=\"quick\">
\t\t<input class=\"button2\" name=\"submit\" type=\"submit\" value=\"";
            // line 117
            echo $this->env->getExtension('phpbb')->lang("ADD_BBCODE");
            echo "\" />
\t</p>
\t";
            // line 119
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>

\t</form>

";
        }
        // line 125
        echo "
";
        // line 126
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_footer.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_bbcodes.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  352 => 126,  349 => 125,  339 => 119,  334 => 117,  328 => 113,  319 => 110,  316 => 109,  294 => 106,  289 => 105,  286 => 104,  280 => 103,  273 => 99,  269 => 98,  261 => 93,  255 => 91,  250 => 89,  245 => 87,  242 => 86,  235 => 81,  225 => 78,  220 => 77,  217 => 76,  212 => 75,  205 => 71,  201 => 70,  195 => 67,  189 => 64,  177 => 56,  173 => 55,  169 => 54,  165 => 53,  161 => 51,  159 => 50,  149 => 46,  145 => 45,  140 => 43,  131 => 38,  127 => 37,  122 => 35,  118 => 34,  109 => 29,  103 => 28,  98 => 26,  94 => 25,  85 => 20,  79 => 19,  74 => 17,  70 => 16,  63 => 13,  58 => 11,  53 => 9,  42 => 7,  39 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }
}
