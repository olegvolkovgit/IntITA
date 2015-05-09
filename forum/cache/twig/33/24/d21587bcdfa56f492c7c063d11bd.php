<?php

/* notification_dropdown.html */
class __TwigTemplate_3324d21587bcdfa56f492c7c063d11bd extends Twig_Template
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
        echo "<div id=\"notification_list\" class=\"dropdown dropdown-extended notification_list\">
\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t<div class=\"dropdown-contents\">
\t\t<div class=\"header\">
\t\t\t";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("NOTIFICATIONS");
        echo "
\t\t\t<span class=\"header_settings\">
\t\t\t\t<a href=\"";
        // line 7
        if (isset($context["U_NOTIFICATION_SETTINGS"])) { $_U_NOTIFICATION_SETTINGS_ = $context["U_NOTIFICATION_SETTINGS"]; } else { $_U_NOTIFICATION_SETTINGS_ = null; }
        echo $_U_NOTIFICATION_SETTINGS_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("SETTINGS");
        echo "</a>
\t\t\t\t";
        // line 8
        if (isset($context["NOTIFICATIONS_COUNT"])) { $_NOTIFICATIONS_COUNT_ = $context["NOTIFICATIONS_COUNT"]; } else { $_NOTIFICATIONS_COUNT_ = null; }
        if ($_NOTIFICATIONS_COUNT_) {
            // line 9
            echo "\t\t\t\t\t<span id=\"mark_all_notifications\"> &bull; <a href=\"";
            if (isset($context["U_MARK_ALL_NOTIFICATIONS"])) { $_U_MARK_ALL_NOTIFICATIONS_ = $context["U_MARK_ALL_NOTIFICATIONS"]; } else { $_U_MARK_ALL_NOTIFICATIONS_ = null; }
            echo $_U_MARK_ALL_NOTIFICATIONS_;
            echo "\" data-ajax=\"notification.mark_all_read\">";
            echo $this->env->getExtension('phpbb')->lang("MARK_ALL_READ");
            echo "</a></span>
\t\t\t\t";
        }
        // line 11
        echo "\t\t\t</span>
\t\t</div>

\t\t<ul>
\t\t\t";
        // line 15
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ((!twig_length_filter($this->env, $this->getAttribute($_loops_, "notifications")))) {
            // line 16
            echo "\t\t\t\t<li class=\"no_notifications\">
\t\t\t\t\t";
            // line 17
            echo $this->env->getExtension('phpbb')->lang("NO_NOTIFICATIONS");
            echo "
\t\t\t\t</li>
\t\t\t";
        }
        // line 20
        echo "\t\t\t";
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "notifications"));
        foreach ($context['_seq'] as $context["_key"] => $context["notifications"]) {
            // line 21
            echo "\t\t\t\t<li class=\"";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "UNREAD")) {
                echo " bg2";
            }
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "STYLING")) {
                echo " ";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "STYLING");
            }
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ((!$this->getAttribute($_notifications_, "URL"))) {
                echo " no-url";
            }
            echo "\">
\t\t\t\t\t";
            // line 22
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "URL")) {
                // line 23
                echo "\t\t\t\t\t\t<a class=\"notification-block\" href=\"";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                if ($this->getAttribute($_notifications_, "UNREAD")) {
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "U_MARK_READ");
                    echo "\" data-real-url=\"";
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "URL");
                } else {
                    if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                    echo $this->getAttribute($_notifications_, "URL");
                }
                echo "\">
\t\t\t\t\t";
            }
            // line 25
            echo "\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "AVATAR")) {
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "AVATAR");
            } else {
                echo "<img src=\"";
                if (isset($context["T_THEME_PATH"])) { $_T_THEME_PATH_ = $context["T_THEME_PATH"]; } else { $_T_THEME_PATH_ = null; }
                echo $_T_THEME_PATH_;
                echo "/images/no_avatar.gif\" alt=\"\" />";
            }
            // line 26
            echo "\t\t\t\t\t\t<div class=\"notification_text\">
\t\t\t\t\t\t\t<p class=\"notification-title\">";
            // line 27
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            echo $this->getAttribute($_notifications_, "FORMATTED_TITLE");
            echo "</p>
\t\t\t\t\t\t\t";
            // line 28
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "REFERENCE")) {
                echo "<p class=\"notification-reference\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "REFERENCE");
                echo "</p>";
            }
            // line 29
            echo "\t\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "FORUM")) {
                echo "<p class=\"notification-forum\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "FORUM");
                echo "</p>";
            }
            // line 30
            echo "\t\t\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "REASON")) {
                echo "<p class=\"notification-reason\">";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "REASON");
                echo "</p>";
            }
            // line 31
            echo "\t\t\t\t\t\t\t<p class=\"notification-time\">";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            echo $this->getAttribute($_notifications_, "TIME");
            echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
            // line 33
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "URL")) {
                echo "</a>";
            }
            // line 34
            echo "\t\t\t\t\t";
            if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
            if ($this->getAttribute($_notifications_, "UNREAD")) {
                // line 35
                echo "\t\t\t\t\t\t<a href=\"";
                if (isset($context["notifications"])) { $_notifications_ = $context["notifications"]; } else { $_notifications_ = null; }
                echo $this->getAttribute($_notifications_, "U_MARK_READ");
                echo "\" class=\"mark_read icon-mark\" data-ajax=\"notification.mark_read\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("MARK_READ");
                echo "\"></a>
\t\t\t\t\t";
            }
            // line 37
            echo "\t\t\t\t</li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notifications'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "\t\t</ul>

\t\t<div class=\"footer\">
\t\t\t<a href=\"";
        // line 42
        if (isset($context["U_VIEW_ALL_NOTIFICATIONS"])) { $_U_VIEW_ALL_NOTIFICATIONS_ = $context["U_VIEW_ALL_NOTIFICATIONS"]; } else { $_U_VIEW_ALL_NOTIFICATIONS_ = null; }
        echo $_U_VIEW_ALL_NOTIFICATIONS_;
        echo "\"><span>";
        echo $this->env->getExtension('phpbb')->lang("SEE_ALL");
        echo "</span></a>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "notification_dropdown.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 35,  168 => 34,  138 => 29,  125 => 27,  122 => 26,  94 => 23,  73 => 21,  67 => 20,  58 => 16,  40 => 9,  37 => 8,  30 => 7,  25 => 5,  494 => 111,  483 => 109,  479 => 108,  476 => 107,  474 => 106,  471 => 105,  468 => 104,  462 => 103,  460 => 102,  442 => 101,  434 => 99,  423 => 98,  407 => 96,  401 => 94,  397 => 93,  392 => 90,  386 => 88,  377 => 86,  372 => 85,  362 => 84,  359 => 83,  355 => 81,  333 => 79,  323 => 77,  302 => 71,  284 => 64,  282 => 63,  260 => 59,  245 => 56,  228 => 52,  225 => 51,  215 => 49,  212 => 48,  209 => 47,  196 => 46,  181 => 37,  162 => 42,  156 => 31,  154 => 37,  150 => 35,  147 => 30,  136 => 33,  126 => 32,  123 => 31,  118 => 30,  115 => 29,  107 => 27,  99 => 25,  68 => 19,  55 => 15,  52 => 15,  49 => 11,  46 => 13,  43 => 12,  41 => 11,  26 => 6,  467 => 104,  464 => 103,  454 => 99,  450 => 97,  444 => 96,  439 => 100,  437 => 92,  433 => 90,  420 => 97,  418 => 88,  413 => 85,  404 => 95,  395 => 79,  389 => 89,  380 => 77,  374 => 75,  371 => 74,  366 => 73,  364 => 72,  358 => 69,  353 => 68,  327 => 78,  317 => 58,  315 => 57,  303 => 55,  299 => 53,  291 => 50,  288 => 66,  286 => 48,  276 => 45,  272 => 61,  262 => 41,  259 => 40,  256 => 39,  246 => 37,  243 => 36,  234 => 34,  229 => 33,  223 => 50,  218 => 31,  210 => 30,  200 => 22,  193 => 42,  190 => 19,  187 => 18,  163 => 33,  143 => 15,  130 => 28,  117 => 13,  104 => 12,  91 => 22,  77 => 21,  74 => 9,  38 => 7,  33 => 6,  22 => 2,  351 => 74,  348 => 67,  346 => 72,  343 => 80,  338 => 68,  336 => 67,  321 => 66,  319 => 65,  314 => 63,  311 => 74,  308 => 73,  305 => 72,  300 => 70,  297 => 52,  265 => 55,  263 => 60,  258 => 58,  255 => 57,  252 => 50,  249 => 49,  244 => 46,  241 => 45,  230 => 44,  216 => 43,  214 => 42,  211 => 41,  197 => 40,  194 => 39,  191 => 38,  188 => 39,  186 => 36,  183 => 45,  175 => 31,  170 => 30,  164 => 43,  160 => 27,  151 => 25,  148 => 24,  141 => 23,  134 => 22,  116 => 20,  110 => 25,  106 => 18,  103 => 17,  101 => 16,  98 => 15,  86 => 14,  83 => 22,  81 => 12,  72 => 9,  69 => 8,  66 => 7,  64 => 18,  61 => 17,  53 => 4,  34 => 7,  31 => 2,  19 => 1,);
    }
}
