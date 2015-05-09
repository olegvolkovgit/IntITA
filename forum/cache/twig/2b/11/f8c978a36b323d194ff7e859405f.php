<?php

/* posting_buttons.html */
class __TwigTemplate_2b11f8c978a36b323d194ff7e859405f extends Twig_Template
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
        echo "
<script type=\"text/javascript\">
// <![CDATA[
\tvar form_name = 'postform';
\tvar text_name = ";
        // line 5
        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
        if ($this->getAttribute($_definition_, "SIG_EDIT")) {
            echo "'signature'";
        } else {
            echo "'message'";
        }
        echo ";
\tvar load_draft = false;
\tvar upload = false;

\t// Define the bbCode tags
\tvar bbcode = new Array();
\tvar bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]'";
        // line 11
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "custom_tags"));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
            echo ", ";
            if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
            echo $this->getAttribute($_custom_tags_, "BBCODE_NAME");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo ");
\tvar imageTag = false;

\t// Helpline messages
\tvar help_line = {
\t\tb: '";
        // line 16
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_B_HELP"));
        echo "',
\t\ti: '";
        // line 17
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_I_HELP"));
        echo "',
\t\tu: '";
        // line 18
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_U_HELP"));
        echo "',
\t\tq: '";
        // line 19
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_Q_HELP"));
        echo "',
\t\tc: '";
        // line 20
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_C_HELP"));
        echo "',
\t\tl: '";
        // line 21
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_L_HELP"));
        echo "',
\t\to: '";
        // line 22
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_O_HELP"));
        echo "',
\t\tp: '";
        // line 23
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_P_HELP"));
        echo "',
\t\tw: '";
        // line 24
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_W_HELP"));
        echo "',
\t\ta: '";
        // line 25
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_A_HELP"));
        echo "',
\t\ts: '";
        // line 26
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_S_HELP"));
        echo "',
\t\tf: '";
        // line 27
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_F_HELP"));
        echo "',
\t\ty: '";
        // line 28
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_Y_HELP"));
        echo "',
\t\td: '";
        // line 29
        echo addslashes($this->env->getExtension('phpbb')->lang("BBCODE_D_HELP"));
        echo "'
\t\t";
        // line 30
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "custom_tags"));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
            // line 31
            echo "\t\t\t,cb_";
            if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
            echo $this->getAttribute($_custom_tags_, "BBCODE_ID");
            echo ": '";
            if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
            echo $this->getAttribute($_custom_tags_, "A_BBCODE_HELPLINE");
            echo "'
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "\t}

\tfunction change_palette()
\t{
\t\tphpbb.toggleDisplay('colour_palette');
\t\te = document.getElementById('colour_palette');

\t\tif (e.style.display == 'block')
\t\t{
\t\t\tdocument.getElementById('bbpalette').value = '";
        // line 42
        echo addslashes($this->env->getExtension('phpbb')->lang("FONT_COLOR_HIDE"));
        echo "';
\t\t}
\t\telse
\t\t{
\t\t\tdocument.getElementById('bbpalette').value = '";
        // line 46
        echo addslashes($this->env->getExtension('phpbb')->lang("FONT_COLOR"));
        echo "';
\t\t}
\t}

// ]]>
</script>
";
        // line 52
        if (isset($context["T_ASSETS_PATH"])) { $_T_ASSETS_PATH_ = $context["T_ASSETS_PATH"]; } else { $_T_ASSETS_PATH_ = null; }
        $asset_file = (("" . $_T_ASSETS_PATH_) . "/javascript/editor.js");
        $asset = new \phpbb\template\asset($asset_file, $this->getEnvironment()->get_path_helper());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->getEnvironment()->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->getEnvironment()->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            $asset->add_assets_version('1');
            $asset_file = $asset->get_url();
            }
        }
        $context['definition']->append('SCRIPTS', '<script type="text/javascript" src="' . $asset_file. '"></script>

');
        // line 53
        echo "
";
        // line 54
        if (isset($context["S_BBCODE_ALLOWED"])) { $_S_BBCODE_ALLOWED_ = $context["S_BBCODE_ALLOWED"]; } else { $_S_BBCODE_ALLOWED_ = null; }
        if ($_S_BBCODE_ALLOWED_) {
            // line 55
            echo "<div id=\"colour_palette\" style=\"display: none;\">
\t<dl style=\"clear: left;\">
\t\t<dt><label>";
            // line 57
            echo $this->env->getExtension('phpbb')->lang("FONT_COLOR");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd id=\"color_palette_placeholder\" data-orientation=\"h\" data-height=\"12\" data-width=\"15\" data-bbcode=\"true\"></dd>
\t</dl>
</div>

";
            // line 62
            if (isset($context["posting_editor_buttons_before"])) { $_posting_editor_buttons_before_ = $context["posting_editor_buttons_before"]; } else { $_posting_editor_buttons_before_ = null; }
            // line 63
            echo "<div id=\"format-buttons\">
\t<input type=\"button\" class=\"button2 bbcode-b\" accesskey=\"b\" name=\"addbbcode0\" value=\" B \" style=\"font-weight:bold; width: 30px\" onclick=\"bbstyle(0)\" title=\"";
            // line 64
            echo $this->env->getExtension('phpbb')->lang("BBCODE_B_HELP");
            echo "\" />
\t<input type=\"button\" class=\"button2 bbcode-i\" accesskey=\"i\" name=\"addbbcode2\" value=\" i \" style=\"font-style:italic; width: 30px\" onclick=\"bbstyle(2)\" title=\"";
            // line 65
            echo $this->env->getExtension('phpbb')->lang("BBCODE_I_HELP");
            echo "\" />
\t<input type=\"button\" class=\"button2 bbcode-u\" accesskey=\"u\" name=\"addbbcode4\" value=\" u \" style=\"text-decoration: underline; width: 30px\" onclick=\"bbstyle(4)\" title=\"";
            // line 66
            echo $this->env->getExtension('phpbb')->lang("BBCODE_U_HELP");
            echo "\" />
\t";
            // line 67
            if (isset($context["S_BBCODE_QUOTE"])) { $_S_BBCODE_QUOTE_ = $context["S_BBCODE_QUOTE"]; } else { $_S_BBCODE_QUOTE_ = null; }
            if ($_S_BBCODE_QUOTE_) {
                // line 68
                echo "\t\t<input type=\"button\" class=\"button2 bbcode-quote\" accesskey=\"q\" name=\"addbbcode6\" value=\"Quote\" style=\"width: 50px\" onclick=\"bbstyle(6)\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BBCODE_Q_HELP");
                echo "\" />
\t";
            }
            // line 70
            echo "\t<input type=\"button\" class=\"button2 bbcode-code\" accesskey=\"c\" name=\"addbbcode8\" value=\"Code\" style=\"width: 40px\" onclick=\"bbstyle(8)\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("BBCODE_C_HELP");
            echo "\" />
\t<input type=\"button\" class=\"button2 bbcode-list\" accesskey=\"l\" name=\"addbbcode10\" value=\"List\" style=\"width: 40px\" onclick=\"bbstyle(10)\" title=\"";
            // line 71
            echo $this->env->getExtension('phpbb')->lang("BBCODE_L_HELP");
            echo "\" />
\t<input type=\"button\" class=\"button2 bbcode-list-\" accesskey=\"o\" name=\"addbbcode12\" value=\"List=\" style=\"width: 40px\" onclick=\"bbstyle(12)\" title=\"";
            // line 72
            echo $this->env->getExtension('phpbb')->lang("BBCODE_O_HELP");
            echo "\" />
\t<input type=\"button\" class=\"button2 bbcode-asterisk\" accesskey=\"y\" name=\"addlistitem\" value=\"[*]\" style=\"width: 40px\" onclick=\"bbstyle(-1)\" title=\"";
            // line 73
            echo $this->env->getExtension('phpbb')->lang("BBCODE_LISTITEM_HELP");
            echo "\" />
\t";
            // line 74
            if (isset($context["S_BBCODE_IMG"])) { $_S_BBCODE_IMG_ = $context["S_BBCODE_IMG"]; } else { $_S_BBCODE_IMG_ = null; }
            if ($_S_BBCODE_IMG_) {
                // line 75
                echo "\t\t<input type=\"button\" class=\"button2 bbcode-img\" accesskey=\"p\" name=\"addbbcode14\" value=\"Img\" style=\"width: 40px\" onclick=\"bbstyle(14)\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BBCODE_P_HELP");
                echo "\" />
\t";
            }
            // line 77
            echo "\t";
            if (isset($context["S_LINKS_ALLOWED"])) { $_S_LINKS_ALLOWED_ = $context["S_LINKS_ALLOWED"]; } else { $_S_LINKS_ALLOWED_ = null; }
            if ($_S_LINKS_ALLOWED_) {
                // line 78
                echo "\t\t<input type=\"button\" class=\"button2 bbcode-url\" accesskey=\"w\" name=\"addbbcode16\" value=\"URL\" style=\"text-decoration: underline; width: 40px\" onclick=\"bbstyle(16)\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BBCODE_W_HELP");
                echo "\" />
\t";
            }
            // line 80
            echo "\t";
            if (isset($context["S_BBCODE_FLASH"])) { $_S_BBCODE_FLASH_ = $context["S_BBCODE_FLASH"]; } else { $_S_BBCODE_FLASH_ = null; }
            if ($_S_BBCODE_FLASH_) {
                // line 81
                echo "\t\t<input type=\"button\" class=\"button2 bbcode-flash\" accesskey=\"d\" name=\"addbbcode18\" value=\"Flash\" onclick=\"bbstyle(18)\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BBCODE_D_HELP");
                echo "\" />
\t";
            }
            // line 83
            echo "\t<select name=\"addbbcode20\" class=\"bbcode-size\" onchange=\"bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("BBCODE_F_HELP");
            echo "\">
\t\t<option value=\"50\">";
            // line 84
            echo $this->env->getExtension('phpbb')->lang("FONT_TINY");
            echo "</option>
\t\t<option value=\"85\">";
            // line 85
            echo $this->env->getExtension('phpbb')->lang("FONT_SMALL");
            echo "</option>
\t\t<option value=\"100\" selected=\"selected\">";
            // line 86
            echo $this->env->getExtension('phpbb')->lang("FONT_NORMAL");
            echo "</option>
\t\t";
            // line 87
            if (isset($context["MAX_FONT_SIZE"])) { $_MAX_FONT_SIZE_ = $context["MAX_FONT_SIZE"]; } else { $_MAX_FONT_SIZE_ = null; }
            if (((!$_MAX_FONT_SIZE_) || ($_MAX_FONT_SIZE_ >= 150))) {
                // line 88
                echo "\t\t\t<option value=\"150\">";
                echo $this->env->getExtension('phpbb')->lang("FONT_LARGE");
                echo "</option>
\t\t\t";
                // line 89
                if (isset($context["MAX_FONT_SIZE"])) { $_MAX_FONT_SIZE_ = $context["MAX_FONT_SIZE"]; } else { $_MAX_FONT_SIZE_ = null; }
                if (((!$_MAX_FONT_SIZE_) || ($_MAX_FONT_SIZE_ >= 200))) {
                    // line 90
                    echo "\t\t\t\t<option value=\"200\">";
                    echo $this->env->getExtension('phpbb')->lang("FONT_HUGE");
                    echo "</option>
\t\t\t";
                }
                // line 92
                echo "\t\t";
            }
            // line 93
            echo "\t</select>
\t<input type=\"button\" class=\"button2 bbcode-color\" name=\"bbpalette\" id=\"bbpalette\" value=\"";
            // line 94
            echo $this->env->getExtension('phpbb')->lang("FONT_COLOR");
            echo "\" onclick=\"change_palette();\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("BBCODE_S_HELP");
            echo "\" />

\t";
            // line 96
            if (isset($context["posting_editor_buttons_custom_tags_before"])) { $_posting_editor_buttons_custom_tags_before_ = $context["posting_editor_buttons_custom_tags_before"]; } else { $_posting_editor_buttons_custom_tags_before_ = null; }
            // line 97
            echo "
\t";
            // line 98
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "custom_tags"));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_tags"]) {
                // line 99
                echo "\t\t<input type=\"button\" class=\"button2 bbcode-";
                if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
                echo $this->getAttribute($_custom_tags_, "BBCODE_TAG_CLEAN");
                echo "\" name=\"addbbcode";
                if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
                echo $this->getAttribute($_custom_tags_, "BBCODE_ID");
                echo "\" value=\"";
                if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
                echo $this->getAttribute($_custom_tags_, "BBCODE_TAG");
                echo "\" onclick=\"bbstyle(";
                if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
                echo $this->getAttribute($_custom_tags_, "BBCODE_ID");
                echo ")\" title=\"";
                if (isset($context["custom_tags"])) { $_custom_tags_ = $context["custom_tags"]; } else { $_custom_tags_ = null; }
                echo $this->getAttribute($_custom_tags_, "BBCODE_HELPLINE");
                echo "\" />
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_tags'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 101
            echo "</div>
";
            // line 102
            if (isset($context["posting_editor_buttons_after"])) { $_posting_editor_buttons_after_ = $context["posting_editor_buttons_after"]; } else { $_posting_editor_buttons_after_ = null; }
        }
    }

    public function getTemplateName()
    {
        return "posting_buttons.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  347 => 102,  344 => 101,  322 => 99,  317 => 98,  314 => 97,  305 => 94,  302 => 93,  299 => 92,  290 => 89,  285 => 88,  282 => 87,  274 => 85,  259 => 81,  255 => 80,  239 => 75,  236 => 74,  232 => 73,  228 => 72,  224 => 71,  213 => 68,  210 => 67,  206 => 66,  202 => 65,  198 => 64,  193 => 62,  180 => 55,  177 => 54,  174 => 53,  142 => 42,  131 => 33,  109 => 29,  97 => 26,  93 => 25,  89 => 24,  81 => 22,  77 => 21,  69 => 19,  65 => 18,  61 => 17,  770 => 189,  766 => 187,  759 => 184,  754 => 183,  751 => 182,  748 => 181,  745 => 180,  741 => 178,  735 => 176,  731 => 175,  724 => 174,  719 => 173,  715 => 171,  711 => 170,  708 => 169,  702 => 166,  695 => 165,  690 => 164,  687 => 163,  683 => 162,  680 => 161,  651 => 158,  641 => 157,  638 => 156,  635 => 155,  632 => 154,  628 => 152,  623 => 151,  620 => 150,  609 => 148,  605 => 147,  596 => 145,  592 => 144,  583 => 142,  579 => 141,  570 => 139,  566 => 138,  557 => 136,  553 => 135,  544 => 133,  540 => 132,  531 => 130,  527 => 129,  525 => 128,  519 => 124,  515 => 123,  512 => 122,  507 => 119,  501 => 116,  498 => 115,  493 => 114,  486 => 110,  482 => 108,  479 => 107,  475 => 106,  463 => 104,  458 => 103,  455 => 102,  445 => 95,  435 => 94,  427 => 93,  420 => 92,  415 => 91,  410 => 90,  405 => 87,  401 => 86,  398 => 85,  393 => 82,  390 => 81,  387 => 80,  384 => 79,  380 => 77,  378 => 76,  358 => 73,  354 => 71,  352 => 70,  348 => 68,  345 => 67,  337 => 66,  326 => 65,  320 => 64,  315 => 63,  312 => 96,  304 => 59,  298 => 57,  293 => 90,  287 => 55,  284 => 54,  278 => 86,  270 => 84,  266 => 50,  263 => 49,  254 => 47,  246 => 45,  221 => 43,  211 => 41,  207 => 40,  203 => 39,  199 => 37,  187 => 36,  184 => 57,  182 => 34,  179 => 33,  158 => 52,  153 => 29,  149 => 46,  129 => 25,  121 => 23,  118 => 31,  116 => 21,  113 => 30,  106 => 17,  101 => 27,  98 => 15,  94 => 14,  91 => 13,  86 => 10,  55 => 9,  46 => 8,  40 => 6,  33 => 4,  30 => 3,  330 => 84,  325 => 81,  310 => 80,  307 => 79,  291 => 78,  288 => 77,  273 => 52,  265 => 83,  262 => 71,  249 => 78,  245 => 77,  240 => 67,  234 => 63,  219 => 70,  216 => 42,  204 => 54,  195 => 63,  190 => 48,  185 => 46,  181 => 45,  176 => 32,  173 => 31,  170 => 40,  155 => 39,  152 => 38,  137 => 37,  134 => 26,  126 => 24,  122 => 30,  117 => 27,  114 => 26,  105 => 28,  102 => 23,  96 => 19,  90 => 17,  85 => 23,  76 => 14,  73 => 20,  63 => 10,  60 => 9,  57 => 16,  47 => 6,  37 => 5,  34 => 3,  31 => 2,  39 => 11,  25 => 5,  22 => 2,  19 => 1,);
    }
}
