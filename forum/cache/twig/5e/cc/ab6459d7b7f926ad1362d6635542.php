<?php

/* posting_attach_body.html */
class __TwigTemplate_5eccab6459d7b7f926ad1362d6635542 extends Twig_Template
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
        echo "<div class=\"panel bg3 panel-container\" id=\"attach-panel\">
\t<div class=\"inner\">

\t<p>";
        // line 4
        echo $this->env->getExtension('phpbb')->lang("ADD_ATTACHMENT_EXPLAIN");
        echo " <span class=\"hidden\" id=\"drag-n-drop-message\">";
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_DRAG_TEXTAREA");
        echo "</span></p>
\t
\t<fieldset class=\"fields2\" id=\"attach-panel-basic\">
\t<dl>
\t\t<dt><label for=\"fileupload\">";
        // line 8
        echo $this->env->getExtension('phpbb')->lang("FILENAME");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>
\t\t\t<input type=\"file\" name=\"fileupload\" id=\"fileupload\" maxlength=\"";
        // line 10
        if (isset($context["FILESIZE"])) { $_FILESIZE_ = $context["FILESIZE"]; } else { $_FILESIZE_ = null; }
        echo $_FILESIZE_;
        echo "\" value=\"\" class=\"inputbox autowidth\" /> 
\t\t\t<input type=\"submit\" name=\"add_file\" value=\"";
        // line 11
        echo $this->env->getExtension('phpbb')->lang("ADD_FILE");
        echo "\" class=\"button2\" onclick=\"upload = true;\" />
\t\t</dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"filecomment\">";
        // line 15
        echo $this->env->getExtension('phpbb')->lang("FILE_COMMENT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd><textarea name=\"filecomment\" id=\"filecomment\" rows=\"1\" cols=\"40\" class=\"inputbox autowidth\">";
        // line 16
        if (isset($context["FILE_COMMENT"])) { $_FILE_COMMENT_ = $context["FILE_COMMENT"]; } else { $_FILE_COMMENT_ = null; }
        echo $_FILE_COMMENT_;
        echo "</textarea></dd>
\t</dl>
\t</fieldset>

\t<div id=\"attach-panel-multi\">
\t\t<input type=\"button\" class=\"button2\" value=\"";
        // line 21
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_ADD_FILES");
        echo "\" id=\"add_files\" />
\t</div>

\t<div class=\"panel";
        // line 24
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ((!twig_length_filter($this->env, $this->getAttribute($_loops_, "attach_row")))) {
            echo " hidden";
        }
        echo "\" id=\"file-list-container\">
\t\t<div class=\"inner\">
\t\t\t<table class=\"table1 zebra-list fixed-width-table\">
\t\t\t\t<thead>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th class=\"attach-name\">";
        // line 29
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_FILENAME");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-comment\">";
        // line 30
        echo $this->env->getExtension('phpbb')->lang("FILE_COMMENT");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-filesize\">";
        // line 31
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_SIZE");
        echo "</th>
\t\t\t\t\t\t<th class=\"attach-status\">";
        // line 32
        echo $this->env->getExtension('phpbb')->lang("PLUPLOAD_STATUS");
        echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody class=\"responsive-skip-empty\" id=\"file-list\">
\t\t\t\t\t<tr class=\"attach-row\" id=\"attach-row-tpl\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"></span>
\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t<input type=\"button\" value=\"";
        // line 40
        echo $this->env->getExtension('phpbb')->lang("PLACE_INLINE");
        echo "\" class=\"button2 hidden file-inline-bbcode\" />&nbsp;
\t\t\t\t\t\t\t\t\t<input type=\"button\" value=\"";
        // line 41
        echo $this->env->getExtension('phpbb')->lang("DELETE_FILE");
        echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea rows=\"1\" cols=\"30\" class=\"inputbox\"></textarea>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-progress\">
\t\t\t\t\t\t\t\t\t<span class=\"file-progress-bar\"></span>
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"file-status\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t\t";
        // line 58
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "attach_row"));
        foreach ($context['_seq'] as $context["_key"] => $context["attach_row"]) {
            // line 59
            echo "\t\t\t\t\t\t<tr class=\"attach-row\" data-attach-id=\"";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ATTACH_ID");
            echo "\">
\t\t\t\t\t\t\t<td class=\"attach-name\">
\t\t\t\t\t\t\t\t<span class=\"file-name ellipsis-text\"><a href=\"";
            // line 61
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "U_VIEW_ATTACHMENT");
            echo "\">";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILENAME");
            echo "</a></span>
\t\t\t\t\t\t\t\t<span class=\"attach-controls\">
\t\t\t\t\t\t\t\t\t";
            // line 63
            if (isset($context["S_INLINE_ATTACHMENT_OPTIONS"])) { $_S_INLINE_ATTACHMENT_OPTIONS_ = $context["S_INLINE_ATTACHMENT_OPTIONS"]; } else { $_S_INLINE_ATTACHMENT_OPTIONS_ = null; }
            if ($_S_INLINE_ATTACHMENT_OPTIONS_) {
                echo "<input type=\"button\" value=\"";
                echo $this->env->getExtension('phpbb')->lang("PLACE_INLINE");
                echo "\" class=\"button2 file-inline-bbcode\" />&nbsp; ";
            }
            // line 64
            echo "\t\t\t\t\t\t\t\t\t<input type=\"submit\" name=\"delete_file[";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ASSOC_INDEX");
            echo "]\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("DELETE_FILE");
            echo "\" class=\"button2 file-delete\" />
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t<span class=\"clear\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-comment\">
\t\t\t\t\t\t\t\t<textarea name=\"comment_list[";
            // line 69
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "ASSOC_INDEX");
            echo "]\" rows=\"1\" cols=\"30\" class=\"inputbox\">";
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILE_COMMENT");
            echo "</textarea>
\t\t\t\t\t\t\t\t";
            // line 70
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "S_HIDDEN");
            echo "
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-filesize\">
\t\t\t\t\t\t\t\t<span class=\"file-size\">";
            // line 73
            if (isset($context["attach_row"])) { $_attach_row_ = $context["attach_row"]; } else { $_attach_row_ = null; }
            echo $this->getAttribute($_attach_row_, "FILESIZE");
            echo "</span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t<td class=\"attach-status\">
\t\t\t\t\t\t\t\t<span class=\"file-status file-uploaded\"></span>
\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attach_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "posting_attach_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 69,  157 => 64,  150 => 63,  141 => 61,  82 => 29,  71 => 24,  56 => 16,  51 => 15,  44 => 11,  24 => 4,  347 => 102,  344 => 101,  322 => 99,  317 => 98,  314 => 97,  305 => 94,  302 => 93,  299 => 92,  290 => 89,  285 => 88,  282 => 87,  274 => 85,  259 => 81,  255 => 80,  239 => 75,  236 => 74,  232 => 73,  228 => 72,  224 => 71,  213 => 68,  210 => 67,  206 => 66,  202 => 65,  198 => 80,  193 => 62,  180 => 55,  177 => 70,  174 => 53,  142 => 42,  131 => 33,  109 => 41,  97 => 26,  93 => 25,  89 => 24,  81 => 22,  77 => 21,  69 => 19,  65 => 21,  61 => 17,  770 => 189,  766 => 187,  759 => 184,  754 => 183,  751 => 182,  748 => 181,  745 => 180,  741 => 178,  735 => 176,  731 => 175,  724 => 174,  719 => 173,  715 => 171,  711 => 170,  708 => 169,  702 => 166,  695 => 165,  690 => 164,  687 => 163,  683 => 162,  680 => 161,  651 => 158,  641 => 157,  638 => 156,  635 => 155,  632 => 154,  628 => 152,  623 => 151,  620 => 150,  609 => 148,  605 => 147,  596 => 145,  592 => 144,  583 => 142,  579 => 141,  570 => 139,  566 => 138,  557 => 136,  553 => 135,  544 => 133,  540 => 132,  531 => 130,  527 => 129,  525 => 128,  519 => 124,  515 => 123,  512 => 122,  507 => 119,  501 => 116,  498 => 115,  493 => 114,  486 => 110,  482 => 108,  479 => 107,  475 => 106,  463 => 104,  458 => 103,  455 => 102,  445 => 95,  435 => 94,  427 => 93,  420 => 92,  415 => 91,  410 => 90,  405 => 87,  401 => 86,  398 => 85,  393 => 82,  390 => 81,  387 => 80,  384 => 79,  380 => 77,  378 => 76,  358 => 73,  354 => 71,  352 => 70,  348 => 68,  345 => 67,  337 => 66,  326 => 65,  320 => 64,  315 => 63,  312 => 96,  304 => 59,  298 => 57,  293 => 90,  287 => 55,  284 => 54,  278 => 86,  270 => 84,  266 => 50,  263 => 49,  254 => 47,  246 => 45,  221 => 43,  211 => 41,  207 => 40,  203 => 39,  199 => 37,  187 => 36,  184 => 73,  182 => 34,  179 => 33,  158 => 52,  153 => 29,  149 => 46,  129 => 58,  121 => 23,  118 => 31,  116 => 21,  113 => 30,  106 => 17,  101 => 27,  98 => 15,  94 => 32,  91 => 13,  86 => 30,  55 => 9,  46 => 8,  40 => 6,  33 => 8,  30 => 3,  330 => 84,  325 => 81,  310 => 80,  307 => 79,  291 => 78,  288 => 77,  273 => 52,  265 => 83,  262 => 71,  249 => 78,  245 => 77,  240 => 67,  234 => 63,  219 => 70,  216 => 42,  204 => 54,  195 => 63,  190 => 48,  185 => 46,  181 => 45,  176 => 32,  173 => 31,  170 => 40,  155 => 39,  152 => 38,  137 => 37,  134 => 59,  126 => 24,  122 => 30,  117 => 27,  114 => 26,  105 => 40,  102 => 23,  96 => 19,  90 => 31,  85 => 23,  76 => 14,  73 => 20,  63 => 10,  60 => 9,  57 => 16,  47 => 6,  37 => 5,  34 => 3,  31 => 2,  39 => 10,  25 => 5,  22 => 2,  19 => 1,);
    }
}
