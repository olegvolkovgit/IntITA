<?php

/* viewtopic_topic_tools.html */
class __TwigTemplate_7239859d608c5a6d00a7ea60b492fd23 extends Twig_Template
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
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if (isset($context["U_WATCH_TOPIC"])) { $_U_WATCH_TOPIC_ = $context["U_WATCH_TOPIC"]; } else { $_U_WATCH_TOPIC_ = null; }
        if (isset($context["U_BOOKMARK_TOPIC"])) { $_U_BOOKMARK_TOPIC_ = $context["U_BOOKMARK_TOPIC"]; } else { $_U_BOOKMARK_TOPIC_ = null; }
        if (isset($context["U_BUMP_TOPIC"])) { $_U_BUMP_TOPIC_ = $context["U_BUMP_TOPIC"]; } else { $_U_BUMP_TOPIC_ = null; }
        if (isset($context["U_EMAIL_TOPIC"])) { $_U_EMAIL_TOPIC_ = $context["U_EMAIL_TOPIC"]; } else { $_U_EMAIL_TOPIC_ = null; }
        if (isset($context["U_PRINT_TOPIC"])) { $_U_PRINT_TOPIC_ = $context["U_PRINT_TOPIC"]; } else { $_U_PRINT_TOPIC_ = null; }
        if (isset($context["S_DISPLAY_TOPIC_TOOLS"])) { $_S_DISPLAY_TOPIC_TOOLS_ = $context["S_DISPLAY_TOPIC_TOOLS"]; } else { $_S_DISPLAY_TOPIC_TOOLS_ = null; }
        if (((!$_S_IS_BOT_) && ((((($_U_WATCH_TOPIC_ || $_U_BOOKMARK_TOPIC_) || $_U_BUMP_TOPIC_) || $_U_EMAIL_TOPIC_) || $_U_PRINT_TOPIC_) || $_S_DISPLAY_TOPIC_TOOLS_))) {
            // line 2
            echo "\t<div class=\"dropdown-container dropdown-button-control topic-tools\">
\t\t<span title=\"";
            // line 3
            echo $this->env->getExtension('phpbb')->lang("TOPIC_TOOLS");
            echo "\" class=\"button icon-button tools-icon dropdown-trigger dropdown-select\"></span>
\t\t<div class=\"dropdown hidden\">
\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t<ul class=\"dropdown-contents\">
\t\t\t\t";
            // line 7
            if (isset($context["viewtopic_topic_tools_before"])) { $_viewtopic_topic_tools_before_ = $context["viewtopic_topic_tools_before"]; } else { $_viewtopic_topic_tools_before_ = null; }
            // line 8
            echo "\t\t\t\t";
            if (isset($context["U_WATCH_TOPIC"])) { $_U_WATCH_TOPIC_ = $context["U_WATCH_TOPIC"]; } else { $_U_WATCH_TOPIC_ = null; }
            if ($_U_WATCH_TOPIC_) {
                // line 9
                echo "\t\t\t\t\t<li class=\"small-icon icon-";
                if (isset($context["S_WATCHING_TOPIC"])) { $_S_WATCHING_TOPIC_ = $context["S_WATCHING_TOPIC"]; } else { $_S_WATCHING_TOPIC_ = null; }
                if ($_S_WATCHING_TOPIC_) {
                    echo "unsubscribe";
                } else {
                    echo "subscribe";
                }
                echo "\">
\t\t\t\t\t\t<a href=\"";
                // line 10
                if (isset($context["U_WATCH_TOPIC"])) { $_U_WATCH_TOPIC_ = $context["U_WATCH_TOPIC"]; } else { $_U_WATCH_TOPIC_ = null; }
                echo $_U_WATCH_TOPIC_;
                echo "\" class=\"watch-topic-link\" title=\"";
                if (isset($context["S_WATCH_TOPIC_TITLE"])) { $_S_WATCH_TOPIC_TITLE_ = $context["S_WATCH_TOPIC_TITLE"]; } else { $_S_WATCH_TOPIC_TITLE_ = null; }
                echo $_S_WATCH_TOPIC_TITLE_;
                echo "\" data-ajax=\"toggle_link\" data-toggle-class=\"small-icon icon-";
                if (isset($context["S_WATCHING_TOPIC"])) { $_S_WATCHING_TOPIC_ = $context["S_WATCHING_TOPIC"]; } else { $_S_WATCHING_TOPIC_ = null; }
                if ((!$_S_WATCHING_TOPIC_)) {
                    echo "unsubscribe";
                } else {
                    echo "subscribe";
                }
                echo "\" data-toggle-text=\"";
                if (isset($context["S_WATCH_TOPIC_TOGGLE"])) { $_S_WATCH_TOPIC_TOGGLE_ = $context["S_WATCH_TOPIC_TOGGLE"]; } else { $_S_WATCH_TOPIC_TOGGLE_ = null; }
                echo $_S_WATCH_TOPIC_TOGGLE_;
                echo "\" data-toggle-url=\"";
                if (isset($context["U_WATCH_TOPIC_TOGGLE"])) { $_U_WATCH_TOPIC_TOGGLE_ = $context["U_WATCH_TOPIC_TOGGLE"]; } else { $_U_WATCH_TOPIC_TOGGLE_ = null; }
                echo $_U_WATCH_TOPIC_TOGGLE_;
                echo "\" data-update-all=\".watch-topic-link\">";
                if (isset($context["S_WATCH_TOPIC_TITLE"])) { $_S_WATCH_TOPIC_TITLE_ = $context["S_WATCH_TOPIC_TITLE"]; } else { $_S_WATCH_TOPIC_TITLE_ = null; }
                echo $_S_WATCH_TOPIC_TITLE_;
                echo "</a>
\t\t\t\t\t</li>
\t\t\t\t";
            }
            // line 13
            echo "\t\t\t\t";
            if (isset($context["U_BOOKMARK_TOPIC"])) { $_U_BOOKMARK_TOPIC_ = $context["U_BOOKMARK_TOPIC"]; } else { $_U_BOOKMARK_TOPIC_ = null; }
            if ($_U_BOOKMARK_TOPIC_) {
                // line 14
                echo "\t\t\t\t\t<li class=\"small-icon icon-bookmark\">
\t\t\t\t\t\t<a href=\"";
                // line 15
                if (isset($context["U_BOOKMARK_TOPIC"])) { $_U_BOOKMARK_TOPIC_ = $context["U_BOOKMARK_TOPIC"]; } else { $_U_BOOKMARK_TOPIC_ = null; }
                echo $_U_BOOKMARK_TOPIC_;
                echo "\" class=\"bookmark-link\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BOOKMARK_TOPIC");
                echo "\" data-ajax=\"alt_text\" data-alt-text=\"";
                if (isset($context["S_BOOKMARK_TOGGLE"])) { $_S_BOOKMARK_TOGGLE_ = $context["S_BOOKMARK_TOGGLE"]; } else { $_S_BOOKMARK_TOGGLE_ = null; }
                echo $_S_BOOKMARK_TOGGLE_;
                echo "\" data-update-all=\".bookmark-link\">";
                if (isset($context["S_BOOKMARK_TOPIC"])) { $_S_BOOKMARK_TOPIC_ = $context["S_BOOKMARK_TOPIC"]; } else { $_S_BOOKMARK_TOPIC_ = null; }
                echo $_S_BOOKMARK_TOPIC_;
                echo "</a>
\t\t\t\t\t</li>
\t\t\t\t";
            }
            // line 18
            echo "\t\t\t\t";
            if (isset($context["U_BUMP_TOPIC"])) { $_U_BUMP_TOPIC_ = $context["U_BUMP_TOPIC"]; } else { $_U_BUMP_TOPIC_ = null; }
            if ($_U_BUMP_TOPIC_) {
                echo "<li class=\"small-icon icon-bump\"><a href=\"";
                if (isset($context["U_BUMP_TOPIC"])) { $_U_BUMP_TOPIC_ = $context["U_BUMP_TOPIC"]; } else { $_U_BUMP_TOPIC_ = null; }
                echo $_U_BUMP_TOPIC_;
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BUMP_TOPIC");
                echo "\" data-ajax=\"true\">";
                echo $this->env->getExtension('phpbb')->lang("BUMP_TOPIC");
                echo "</a></li>";
            }
            // line 19
            echo "\t\t\t\t";
            if (isset($context["U_EMAIL_TOPIC"])) { $_U_EMAIL_TOPIC_ = $context["U_EMAIL_TOPIC"]; } else { $_U_EMAIL_TOPIC_ = null; }
            if ($_U_EMAIL_TOPIC_) {
                echo "<li class=\"small-icon icon-sendemail\"><a href=\"";
                if (isset($context["U_EMAIL_TOPIC"])) { $_U_EMAIL_TOPIC_ = $context["U_EMAIL_TOPIC"]; } else { $_U_EMAIL_TOPIC_ = null; }
                echo $_U_EMAIL_TOPIC_;
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("EMAIL_TOPIC");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("EMAIL_TOPIC");
                echo "</a></li>";
            }
            // line 20
            echo "\t\t\t\t";
            if (isset($context["U_PRINT_TOPIC"])) { $_U_PRINT_TOPIC_ = $context["U_PRINT_TOPIC"]; } else { $_U_PRINT_TOPIC_ = null; }
            if ($_U_PRINT_TOPIC_) {
                echo "<li class=\"small-icon icon-print\"><a href=\"";
                if (isset($context["U_PRINT_TOPIC"])) { $_U_PRINT_TOPIC_ = $context["U_PRINT_TOPIC"]; } else { $_U_PRINT_TOPIC_ = null; }
                echo $_U_PRINT_TOPIC_;
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("PRINT_TOPIC");
                echo "\" accesskey=\"p\">";
                echo $this->env->getExtension('phpbb')->lang("PRINT_TOPIC");
                echo "</a></li>";
            }
            // line 21
            echo "\t\t\t\t";
            if (isset($context["viewtopic_topic_tools_after"])) { $_viewtopic_topic_tools_after_ = $context["viewtopic_topic_tools_after"]; } else { $_viewtopic_topic_tools_after_ = null; }
            // line 22
            echo "\t\t\t</ul>
\t\t</div>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "viewtopic_topic_tools.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 22,  141 => 21,  128 => 20,  115 => 19,  102 => 18,  87 => 15,  84 => 14,  80 => 13,  54 => 10,  44 => 9,  40 => 8,  38 => 7,  28 => 2,  1710 => 400,  1707 => 399,  1700 => 396,  1686 => 395,  1683 => 394,  1680 => 393,  1677 => 392,  1665 => 391,  1663 => 390,  1658 => 387,  1654 => 385,  1647 => 383,  1644 => 382,  1631 => 381,  1628 => 380,  1623 => 379,  1620 => 378,  1616 => 377,  1613 => 376,  1607 => 372,  1589 => 370,  1583 => 369,  1578 => 368,  1569 => 364,  1560 => 363,  1557 => 362,  1554 => 361,  1542 => 360,  1538 => 358,  1536 => 357,  1533 => 356,  1529 => 354,  1522 => 353,  1502 => 352,  1498 => 351,  1495 => 350,  1493 => 349,  1489 => 347,  1487 => 346,  1484 => 345,  1478 => 341,  1473 => 339,  1463 => 338,  1454 => 337,  1451 => 336,  1444 => 334,  1440 => 333,  1437 => 332,  1423 => 330,  1420 => 329,  1417 => 328,  1411 => 326,  1400 => 320,  1394 => 316,  1392 => 315,  1389 => 314,  1377 => 313,  1374 => 312,  1366 => 311,  1363 => 310,  1359 => 308,  1348 => 307,  1343 => 306,  1340 => 305,  1336 => 303,  1325 => 302,  1320 => 301,  1317 => 300,  1313 => 299,  1305 => 298,  1303 => 297,  1300 => 296,  1296 => 294,  1286 => 292,  1281 => 291,  1276 => 289,  1272 => 287,  1269 => 286,  1263 => 284,  1260 => 283,  1251 => 280,  1248 => 279,  1245 => 278,  1242 => 277,  1234 => 273,  1229 => 272,  1225 => 271,  1221 => 270,  1217 => 269,  1210 => 267,  1202 => 263,  1197 => 262,  1193 => 261,  1189 => 260,  1185 => 259,  1178 => 257,  1175 => 256,  1172 => 255,  1170 => 254,  1145 => 253,  1143 => 252,  1140 => 251,  1137 => 250,  1133 => 248,  1130 => 247,  1119 => 244,  1116 => 243,  1112 => 242,  1101 => 239,  1098 => 238,  1094 => 237,  1083 => 234,  1080 => 233,  1076 => 232,  1065 => 229,  1062 => 228,  1058 => 227,  1047 => 224,  1044 => 223,  1040 => 222,  1029 => 219,  1026 => 218,  1022 => 217,  1020 => 216,  1017 => 215,  1013 => 214,  1010 => 213,  980 => 211,  968 => 209,  965 => 208,  958 => 205,  953 => 204,  947 => 203,  940 => 200,  935 => 199,  929 => 198,  925 => 197,  922 => 196,  916 => 192,  913 => 191,  906 => 186,  900 => 185,  896 => 183,  892 => 182,  883 => 180,  859 => 179,  855 => 177,  851 => 176,  844 => 175,  840 => 174,  835 => 173,  824 => 169,  818 => 167,  815 => 166,  810 => 165,  808 => 164,  805 => 163,  802 => 162,  796 => 161,  782 => 159,  778 => 158,  772 => 157,  770 => 156,  767 => 155,  757 => 153,  754 => 152,  751 => 151,  748 => 150,  736 => 149,  724 => 148,  702 => 147,  699 => 146,  685 => 145,  681 => 143,  678 => 142,  666 => 141,  664 => 140,  661 => 139,  658 => 138,  655 => 137,  638 => 136,  634 => 135,  632 => 134,  615 => 132,  605 => 131,  570 => 128,  558 => 126,  554 => 125,  551 => 124,  546 => 123,  543 => 122,  533 => 116,  528 => 115,  521 => 111,  518 => 110,  509 => 107,  505 => 105,  502 => 104,  499 => 103,  493 => 100,  489 => 98,  486 => 97,  476 => 94,  468 => 92,  465 => 91,  459 => 90,  457 => 89,  441 => 87,  414 => 86,  380 => 85,  364 => 84,  342 => 83,  339 => 82,  334 => 81,  317 => 78,  310 => 77,  299 => 71,  296 => 70,  292 => 68,  289 => 67,  285 => 65,  278 => 63,  275 => 62,  262 => 61,  259 => 60,  244 => 59,  241 => 58,  237 => 57,  234 => 56,  225 => 51,  216 => 50,  210 => 49,  206 => 48,  200 => 46,  197 => 45,  194 => 44,  191 => 43,  179 => 42,  175 => 40,  173 => 39,  170 => 38,  166 => 36,  159 => 35,  139 => 34,  135 => 33,  132 => 32,  130 => 31,  124 => 27,  118 => 23,  112 => 21,  107 => 20,  98 => 18,  95 => 17,  85 => 14,  82 => 13,  79 => 12,  64 => 9,  61 => 8,  58 => 7,  55 => 6,  47 => 5,  34 => 3,  31 => 3,  19 => 1,);
    }
}
