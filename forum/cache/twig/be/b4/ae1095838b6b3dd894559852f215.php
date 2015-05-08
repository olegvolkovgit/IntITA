<?php

/* jumpbox.html */
class __TwigTemplate_beb4ae1095838b6b3dd894559852f215 extends Twig_Template
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
";
        // line 2
        if (isset($context["S_VIEWTOPIC"])) { $_S_VIEWTOPIC_ = $context["S_VIEWTOPIC"]; } else { $_S_VIEWTOPIC_ = null; }
        if (isset($context["S_VIEWFORUM"])) { $_S_VIEWFORUM_ = $context["S_VIEWFORUM"]; } else { $_S_VIEWFORUM_ = null; }
        if (isset($context["SEARCH_TOPIC"])) { $_SEARCH_TOPIC_ = $context["SEARCH_TOPIC"]; } else { $_SEARCH_TOPIC_ = null; }
        if (isset($context["S_SEARCH_ACTION"])) { $_S_SEARCH_ACTION_ = $context["S_SEARCH_ACTION"]; } else { $_S_SEARCH_ACTION_ = null; }
        if ($_S_VIEWTOPIC_) {
            // line 3
            echo "\t<p class=\"jumpbox-return\"><a href=\"";
            if (isset($context["U_VIEW_FORUM"])) { $_U_VIEW_FORUM_ = $context["U_VIEW_FORUM"]; } else { $_U_VIEW_FORUM_ = null; }
            echo $_U_VIEW_FORUM_;
            echo "\" class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_FORUM");
            echo "</a></p>
";
        } elseif ($_S_VIEWFORUM_) {
            // line 5
            echo "\t<p class=\"jumpbox-return\"><a href=\"";
            if (isset($context["U_INDEX"])) { $_U_INDEX_ = $context["U_INDEX"]; } else { $_U_INDEX_ = null; }
            echo $_U_INDEX_;
            echo "\" class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_INDEX");
            echo "</a></p>
";
        } elseif ($_SEARCH_TOPIC_) {
            // line 7
            echo "\t<p class=\"jumpbox-return\"><a class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH_TOPIC"])) { $_U_SEARCH_TOPIC_ = $context["U_SEARCH_TOPIC"]; } else { $_U_SEARCH_TOPIC_ = null; }
            echo $_U_SEARCH_TOPIC_;
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("RETURN_TO_TOPIC");
            echo "</a></p>
";
        } elseif ($_S_SEARCH_ACTION_) {
            // line 9
            echo "\t<p class=\"jumpbox-return\"><a class=\"left-box arrow-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo "\" href=\"";
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\" accesskey=\"r\">";
            echo $this->env->getExtension('phpbb')->lang("GO_TO_SEARCH_ADV");
            echo "</a></p>
";
        }
        // line 11
        echo "
";
        // line 12
        if (isset($context["S_DISPLAY_JUMPBOX"])) { $_S_DISPLAY_JUMPBOX_ = $context["S_DISPLAY_JUMPBOX"]; } else { $_S_DISPLAY_JUMPBOX_ = null; }
        if ($_S_DISPLAY_JUMPBOX_) {
            // line 13
            echo "
\t<div class=\"dropdown-container dropdown-container-";
            // line 14
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if ((!$_S_IN_MCP_)) {
                echo " dropdown-up";
            }
            echo " dropdown-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo " dropdown-button-control\" id=\"jumpbox\">
\t\t<span title=\"";
            // line 15
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if (isset($context["S_MERGE_SELECT"])) { $_S_MERGE_SELECT_ = $context["S_MERGE_SELECT"]; } else { $_S_MERGE_SELECT_ = null; }
            if (($_S_IN_MCP_ && $_S_MERGE_SELECT_)) {
                echo $this->env->getExtension('phpbb')->lang("SELECT_TOPICS_FROM");
            } elseif ($_S_IN_MCP_) {
                echo $this->env->getExtension('phpbb')->lang("MODERATE_FORUM");
            } else {
                echo $this->env->getExtension('phpbb')->lang("JUMP_TO");
            }
            echo "\" class=\"dropdown-trigger button dropdown-select\">
\t\t\t";
            // line 16
            if (isset($context["S_IN_MCP"])) { $_S_IN_MCP_ = $context["S_IN_MCP"]; } else { $_S_IN_MCP_ = null; }
            if (isset($context["S_MERGE_SELECT"])) { $_S_MERGE_SELECT_ = $context["S_MERGE_SELECT"]; } else { $_S_MERGE_SELECT_ = null; }
            if (($_S_IN_MCP_ && $_S_MERGE_SELECT_)) {
                echo $this->env->getExtension('phpbb')->lang("SELECT_TOPICS_FROM");
            } elseif ($_S_IN_MCP_) {
                echo $this->env->getExtension('phpbb')->lang("MODERATE_FORUM");
            } else {
                echo $this->env->getExtension('phpbb')->lang("JUMP_TO");
            }
            // line 17
            echo "\t\t</span>
\t\t<div class=\"dropdown hidden\">
\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t<ul class=\"dropdown-contents\">
\t\t\t";
            // line 21
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "jumpbox_forums"));
            foreach ($context['_seq'] as $context["_key"] => $context["jumpbox_forums"]) {
                // line 22
                echo "\t\t\t\t";
                if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                if (($this->getAttribute($_jumpbox_forums_, "FORUM_ID") != (-1))) {
                    // line 23
                    echo "\t\t\t\t\t<li>";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($_jumpbox_forums_, "level"));
                    foreach ($context['_seq'] as $context["_key"] => $context["level"]) {
                        echo "&nbsp; &nbsp;";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['level'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo "<a href=\"";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    echo $this->getAttribute($_jumpbox_forums_, "LINK");
                    echo "\">";
                    if (isset($context["jumpbox_forums"])) { $_jumpbox_forums_ = $context["jumpbox_forums"]; } else { $_jumpbox_forums_ = null; }
                    echo $this->getAttribute($_jumpbox_forums_, "FORUM_NAME");
                    echo "</a></li>
\t\t\t\t";
                }
                // line 25
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['jumpbox_forums'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "\t\t\t</ul>
\t\t</div>
\t</div>

";
        } else {
            // line 31
            echo "\t<br /><br />
";
        }
    }

    public function getTemplateName()
    {
        return "jumpbox.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 26,  156 => 25,  132 => 22,  127 => 21,  121 => 17,  111 => 16,  99 => 15,  87 => 14,  84 => 13,  78 => 11,  40 => 5,  28 => 3,  22 => 2,  1113 => 272,  1110 => 271,  1094 => 268,  1090 => 267,  1087 => 266,  1084 => 265,  1081 => 264,  1074 => 261,  1060 => 260,  1057 => 259,  1054 => 258,  1051 => 257,  1039 => 256,  1036 => 255,  1031 => 252,  1024 => 250,  1021 => 249,  1008 => 248,  1005 => 247,  999 => 246,  987 => 245,  983 => 243,  979 => 241,  977 => 240,  973 => 238,  966 => 237,  947 => 236,  944 => 235,  942 => 234,  939 => 233,  935 => 232,  932 => 231,  928 => 230,  925 => 229,  919 => 225,  914 => 223,  909 => 222,  902 => 221,  893 => 220,  890 => 219,  883 => 217,  879 => 216,  876 => 215,  865 => 210,  861 => 208,  857 => 207,  851 => 205,  845 => 201,  842 => 200,  820 => 195,  811 => 194,  804 => 193,  797 => 192,  793 => 190,  791 => 189,  787 => 187,  773 => 186,  762 => 185,  754 => 184,  747 => 183,  743 => 181,  738 => 178,  732 => 177,  720 => 175,  714 => 173,  705 => 172,  701 => 171,  696 => 170,  692 => 168,  689 => 167,  686 => 166,  683 => 165,  672 => 164,  669 => 163,  653 => 162,  636 => 161,  633 => 160,  630 => 159,  615 => 157,  603 => 156,  592 => 155,  571 => 154,  569 => 153,  566 => 152,  557 => 151,  541 => 150,  536 => 149,  511 => 148,  508 => 147,  499 => 141,  495 => 140,  491 => 139,  474 => 138,  462 => 133,  459 => 132,  456 => 131,  450 => 127,  447 => 126,  444 => 125,  438 => 124,  435 => 123,  431 => 121,  417 => 111,  412 => 109,  404 => 105,  397 => 104,  391 => 102,  384 => 99,  379 => 98,  359 => 94,  349 => 88,  346 => 87,  342 => 86,  335 => 82,  330 => 79,  327 => 78,  324 => 77,  318 => 73,  311 => 71,  308 => 70,  295 => 69,  292 => 68,  286 => 67,  274 => 66,  270 => 64,  261 => 59,  252 => 58,  246 => 57,  242 => 56,  236 => 54,  233 => 53,  230 => 52,  227 => 51,  223 => 49,  221 => 48,  217 => 46,  210 => 45,  191 => 44,  188 => 43,  186 => 42,  183 => 41,  179 => 40,  175 => 38,  169 => 31,  166 => 36,  152 => 34,  143 => 31,  140 => 30,  136 => 23,  133 => 28,  130 => 27,  124 => 23,  118 => 21,  113 => 20,  104 => 18,  101 => 17,  91 => 14,  88 => 13,  85 => 12,  81 => 12,  64 => 9,  56 => 8,  52 => 7,  47 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }
}
