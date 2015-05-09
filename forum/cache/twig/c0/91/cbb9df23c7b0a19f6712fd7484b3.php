<?php

/* posting_poll_body.html */
class __TwigTemplate_c091cbb9df23c7b0a19f6712fd7484b3 extends Twig_Template
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
        echo "<div class=\"panel bg3\" id=\"poll-panel\">
\t<div class=\"inner\">

\t";
        // line 4
        if (isset($context["S_SHOW_POLL_BOX"])) { $_S_SHOW_POLL_BOX_ = $context["S_SHOW_POLL_BOX"]; } else { $_S_SHOW_POLL_BOX_ = null; }
        if ($_S_SHOW_POLL_BOX_) {
            // line 5
            echo "\t<p>";
            echo $this->env->getExtension('phpbb')->lang("ADD_POLL_EXPLAIN");
            echo "</p>
\t";
        }
        // line 7
        echo "
\t<fieldset class=\"fields2\">
\t";
        // line 9
        if (isset($context["S_SHOW_POLL_BOX"])) { $_S_SHOW_POLL_BOX_ = $context["S_SHOW_POLL_BOX"]; } else { $_S_SHOW_POLL_BOX_ = null; }
        if ($_S_SHOW_POLL_BOX_) {
            // line 10
            echo "\t\t";
            if (isset($context["S_POLL_DELETE"])) { $_S_POLL_DELETE_ = $context["S_POLL_DELETE"]; } else { $_S_POLL_DELETE_ = null; }
            if ($_S_POLL_DELETE_) {
                // line 11
                echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"poll_delete\">";
                // line 12
                echo $this->env->getExtension('phpbb')->lang("POLL_DELETE");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><label for=\"poll_delete\"><input type=\"checkbox\" name=\"poll_delete\" id=\"poll_delete\"";
                // line 13
                if (isset($context["S_POLL_DELETE_CHECKED"])) { $_S_POLL_DELETE_CHECKED_ = $context["S_POLL_DELETE_CHECKED"]; } else { $_S_POLL_DELETE_CHECKED_ = null; }
                if ($_S_POLL_DELETE_CHECKED_) {
                    echo " checked=\"checked\"";
                }
                echo " /> </label></dd>
\t\t\t</dl>
\t\t";
            }
            // line 16
            echo "\t\t<dl>
\t\t\t<dt><label for=\"poll_title\">";
            // line 17
            echo $this->env->getExtension('phpbb')->lang("POLL_QUESTION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"text\" name=\"poll_title\" id=\"poll_title\" maxlength=\"255\" value=\"";
            // line 18
            if (isset($context["POLL_TITLE"])) { $_POLL_TITLE_ = $context["POLL_TITLE"]; } else { $_POLL_TITLE_ = null; }
            echo $_POLL_TITLE_;
            echo "\" class=\"inputbox\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"poll_option_text\">";
            // line 21
            echo $this->env->getExtension('phpbb')->lang("POLL_OPTIONS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("POLL_OPTIONS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><textarea name=\"poll_option_text\" id=\"poll_option_text\" rows=\"5\" cols=\"35\" class=\"inputbox\">";
            // line 22
            if (isset($context["POLL_OPTIONS"])) { $_POLL_OPTIONS_ = $context["POLL_OPTIONS"]; } else { $_POLL_OPTIONS_ = null; }
            echo $_POLL_OPTIONS_;
            echo "</textarea></dd>
\t\t</dl>

\t\t<hr class=\"dashed\" />

\t\t<dl>
\t\t\t<dt><label for=\"poll_max_options\">";
            // line 28
            echo $this->env->getExtension('phpbb')->lang("POLL_MAX_OPTIONS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><input type=\"number\" min=\"0\" max=\"999\" name=\"poll_max_options\" id=\"poll_max_options\" size=\"3\" maxlength=\"3\" value=\"";
            // line 29
            if (isset($context["POLL_MAX_OPTIONS"])) { $_POLL_MAX_OPTIONS_ = $context["POLL_MAX_OPTIONS"]; } else { $_POLL_MAX_OPTIONS_ = null; }
            echo $_POLL_MAX_OPTIONS_;
            echo "\" class=\"inputbox autowidth\" /></dd>
\t\t\t<dd>";
            // line 30
            echo $this->env->getExtension('phpbb')->lang("POLL_MAX_OPTIONS_EXPLAIN");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"poll_length\">";
            // line 33
            echo $this->env->getExtension('phpbb')->lang("POLL_FOR");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label for=\"poll_length\"><input type=\"number\" min=\"0\" max=\"999\" name=\"poll_length\" id=\"poll_length\" size=\"3\" maxlength=\"3\" value=\"";
            // line 34
            if (isset($context["POLL_LENGTH"])) { $_POLL_LENGTH_ = $context["POLL_LENGTH"]; } else { $_POLL_LENGTH_ = null; }
            echo $_POLL_LENGTH_;
            echo "\" class=\"inputbox autowidth\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</label></dd>
\t\t\t<dd>";
            // line 35
            echo $this->env->getExtension('phpbb')->lang("POLL_FOR_EXPLAIN");
            echo "</dd>
\t\t</dl>

\t\t";
            // line 38
            if (isset($context["S_POLL_VOTE_CHANGE"])) { $_S_POLL_VOTE_CHANGE_ = $context["S_POLL_VOTE_CHANGE"]; } else { $_S_POLL_VOTE_CHANGE_ = null; }
            if ($_S_POLL_VOTE_CHANGE_) {
                // line 39
                echo "\t\t\t<hr class=\"dashed\" />

\t\t\t<dl>
\t\t\t\t<dt><label for=\"poll_vote_change\">";
                // line 42
                echo $this->env->getExtension('phpbb')->lang("POLL_VOTE_CHANGE");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t\t<dd><label for=\"poll_vote_change\"><input type=\"checkbox\" id=\"poll_vote_change\" name=\"poll_vote_change\"";
                // line 43
                if (isset($context["VOTE_CHANGE_CHECKED"])) { $_VOTE_CHANGE_CHECKED_ = $context["VOTE_CHANGE_CHECKED"]; } else { $_VOTE_CHANGE_CHECKED_ = null; }
                echo $_VOTE_CHANGE_CHECKED_;
                echo " /> ";
                echo $this->env->getExtension('phpbb')->lang("POLL_VOTE_CHANGE_EXPLAIN");
                echo "</label></dd>
\t\t\t</dl>
\t\t";
            }
            // line 46
            echo "\t";
        }
        // line 47
        echo "\t";
        if (isset($context["posting_poll_body_options_after"])) { $_posting_poll_body_options_after_ = $context["posting_poll_body_options_after"]; } else { $_posting_poll_body_options_after_ = null; }
        // line 48
        echo "
\t";
        // line 49
        if (isset($context["S_POLL_DELETE"])) { $_S_POLL_DELETE_ = $context["S_POLL_DELETE"]; } else { $_S_POLL_DELETE_ = null; }
        if ($_S_POLL_DELETE_) {
            // line 50
            echo "\t\t<dl class=\"fields1\">
\t\t\t<dt><label for=\"poll_delete\">";
            // line 51
            echo $this->env->getExtension('phpbb')->lang("POLL_DELETE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label for=\"poll_delete\"><input type=\"checkbox\" name=\"poll_delete\" id=\"poll_delete\"";
            // line 52
            if (isset($context["S_POLL_DELETE_CHECKED"])) { $_S_POLL_DELETE_CHECKED_ = $context["S_POLL_DELETE_CHECKED"]; } else { $_S_POLL_DELETE_CHECKED_ = null; }
            if ($_S_POLL_DELETE_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> </label></dd>
\t\t</dl>
\t";
        }
        // line 55
        echo "\t</fieldset>

\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "posting_poll_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 55,  164 => 51,  161 => 50,  140 => 43,  135 => 42,  130 => 39,  127 => 38,  103 => 30,  83 => 22,  64 => 17,  52 => 13,  27 => 5,  169 => 52,  157 => 64,  150 => 63,  141 => 61,  82 => 29,  71 => 24,  56 => 16,  51 => 15,  44 => 11,  24 => 4,  347 => 102,  344 => 101,  322 => 99,  317 => 98,  314 => 97,  305 => 94,  302 => 93,  299 => 92,  290 => 89,  285 => 88,  282 => 87,  274 => 85,  259 => 81,  255 => 80,  239 => 75,  236 => 74,  232 => 73,  228 => 72,  224 => 71,  213 => 68,  210 => 67,  206 => 66,  202 => 65,  198 => 80,  193 => 62,  180 => 55,  177 => 70,  174 => 53,  142 => 42,  131 => 33,  109 => 33,  97 => 26,  93 => 28,  89 => 24,  81 => 22,  77 => 21,  69 => 18,  65 => 21,  61 => 16,  770 => 189,  766 => 187,  759 => 184,  754 => 183,  751 => 182,  748 => 181,  745 => 180,  741 => 178,  735 => 176,  731 => 175,  724 => 174,  719 => 173,  715 => 171,  711 => 170,  708 => 169,  702 => 166,  695 => 165,  690 => 164,  687 => 163,  683 => 162,  680 => 161,  651 => 158,  641 => 157,  638 => 156,  635 => 155,  632 => 154,  628 => 152,  623 => 151,  620 => 150,  609 => 148,  605 => 147,  596 => 145,  592 => 144,  583 => 142,  579 => 141,  570 => 139,  566 => 138,  557 => 136,  553 => 135,  544 => 133,  540 => 132,  531 => 130,  527 => 129,  525 => 128,  519 => 124,  515 => 123,  512 => 122,  507 => 119,  501 => 116,  498 => 115,  493 => 114,  486 => 110,  482 => 108,  479 => 107,  475 => 106,  463 => 104,  458 => 103,  455 => 102,  445 => 95,  435 => 94,  427 => 93,  420 => 92,  415 => 91,  410 => 90,  405 => 87,  401 => 86,  398 => 85,  393 => 82,  390 => 81,  387 => 80,  384 => 79,  380 => 77,  378 => 76,  358 => 73,  354 => 71,  352 => 70,  348 => 68,  345 => 67,  337 => 66,  326 => 65,  320 => 64,  315 => 63,  312 => 96,  304 => 59,  298 => 57,  293 => 90,  287 => 55,  284 => 54,  278 => 86,  270 => 84,  266 => 50,  263 => 49,  254 => 47,  246 => 45,  221 => 43,  211 => 41,  207 => 40,  203 => 39,  199 => 37,  187 => 36,  184 => 73,  182 => 34,  179 => 33,  158 => 49,  153 => 29,  149 => 46,  129 => 58,  121 => 35,  118 => 31,  116 => 21,  113 => 30,  106 => 17,  101 => 27,  98 => 29,  94 => 32,  91 => 13,  86 => 30,  55 => 9,  46 => 8,  40 => 10,  33 => 7,  30 => 3,  330 => 84,  325 => 81,  310 => 80,  307 => 79,  291 => 78,  288 => 77,  273 => 52,  265 => 83,  262 => 71,  249 => 78,  245 => 77,  240 => 67,  234 => 63,  219 => 70,  216 => 42,  204 => 54,  195 => 63,  190 => 48,  185 => 46,  181 => 45,  176 => 32,  173 => 31,  170 => 40,  155 => 48,  152 => 47,  137 => 37,  134 => 59,  126 => 24,  122 => 30,  117 => 27,  114 => 34,  105 => 40,  102 => 23,  96 => 19,  90 => 31,  85 => 23,  76 => 21,  73 => 20,  63 => 10,  60 => 9,  57 => 16,  47 => 12,  37 => 9,  34 => 3,  31 => 2,  39 => 10,  25 => 5,  22 => 2,  19 => 1,);
    }
}
