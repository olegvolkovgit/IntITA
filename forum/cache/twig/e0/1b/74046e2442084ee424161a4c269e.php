<?php

/* viewforum_body.html */
class __TwigTemplate_e01b74046e2442084ee424161a4c269e extends Twig_Template
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
<h2 class=\"forum-title\">";
        // line 3
        if (isset($context["viewforum_forum_name_prepend"])) { $_viewforum_forum_name_prepend_ = $context["viewforum_forum_name_prepend"]; } else { $_viewforum_forum_name_prepend_ = null; }
        echo "<a href=\"";
        if (isset($context["U_VIEW_FORUM"])) { $_U_VIEW_FORUM_ = $context["U_VIEW_FORUM"]; } else { $_U_VIEW_FORUM_ = null; }
        echo $_U_VIEW_FORUM_;
        echo "\">";
        if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
        echo $_FORUM_NAME_;
        echo "</a>";
        if (isset($context["viewforum_forum_name_append"])) { $_viewforum_forum_name_append_ = $context["viewforum_forum_name_append"]; } else { $_viewforum_forum_name_append_ = null; }
        echo "</h2>

";
        // line 5
        if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
        if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
        if (isset($context["U_MCP"])) { $_U_MCP_ = $context["U_MCP"]; } else { $_U_MCP_ = null; }
        if ((($_FORUM_DESC_ || $_MODERATORS_) || $_U_MCP_)) {
            // line 6
            echo "<div>
\t<!-- NOTE: remove the style=\"display: none\" when you want to have the forum description on the forum body -->
\t";
            // line 8
            if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
            if ($_FORUM_DESC_) {
                echo "<div style=\"display: none !important;\">";
                if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
                echo $_FORUM_DESC_;
                echo "<br /></div>";
            }
            // line 9
            echo "\t";
            if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
            if ($_MODERATORS_) {
                echo "<p><strong>";
                if (isset($context["S_SINGLE_MODERATOR"])) { $_S_SINGLE_MODERATOR_ = $context["S_SINGLE_MODERATOR"]; } else { $_S_SINGLE_MODERATOR_ = null; }
                if ($_S_SINGLE_MODERATOR_) {
                    echo $this->env->getExtension('phpbb')->lang("MODERATOR");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("MODERATORS");
                }
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
                echo $_MODERATORS_;
                echo "</p>";
            }
            // line 10
            echo "</div>
";
        }
        // line 12
        echo "
";
        // line 13
        if (isset($context["S_FORUM_RULES"])) { $_S_FORUM_RULES_ = $context["S_FORUM_RULES"]; } else { $_S_FORUM_RULES_ = null; }
        if ($_S_FORUM_RULES_) {
            // line 14
            echo "\t<div class=\"rules";
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                echo " rules-link";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t";
            // line 17
            if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
            if ($_U_FORUM_RULES_) {
                // line 18
                echo "\t\t\t<a href=\"";
                if (isset($context["U_FORUM_RULES"])) { $_U_FORUM_RULES_ = $context["U_FORUM_RULES"]; } else { $_U_FORUM_RULES_ = null; }
                echo $_U_FORUM_RULES_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</a>
\t\t";
            } else {
                // line 20
                echo "\t\t\t<strong>";
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
                echo "</strong><br />
\t\t\t";
                // line 21
                if (isset($context["FORUM_RULES"])) { $_FORUM_RULES_ = $context["FORUM_RULES"]; } else { $_FORUM_RULES_ = null; }
                echo $_FORUM_RULES_;
                echo "
\t\t";
            }
            // line 23
            echo "
\t\t</div>
\t</div>
";
        }
        // line 27
        echo "
";
        // line 28
        if (isset($context["S_HAS_SUBFORUM"])) { $_S_HAS_SUBFORUM_ = $context["S_HAS_SUBFORUM"]; } else { $_S_HAS_SUBFORUM_ = null; }
        if ($_S_HAS_SUBFORUM_) {
            // line 29
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["U_MARK_FORUMS"])) { $_U_MARK_FORUMS_ = $context["U_MARK_FORUMS"]; } else { $_U_MARK_FORUMS_ = null; }
            if (((!$_S_IS_BOT_) && $_U_MARK_FORUMS_)) {
                // line 30
                echo "\t<div class=\"action-bar compact\">
\t\t<a href=\"";
                // line 31
                if (isset($context["U_MARK_FORUMS"])) { $_U_MARK_FORUMS_ = $context["U_MARK_FORUMS"]; } else { $_U_MARK_FORUMS_ = null; }
                echo $_U_MARK_FORUMS_;
                echo "\" class=\"mark-read rightside\" data-ajax=\"mark_forums_read\">";
                echo $this->env->getExtension('phpbb')->lang("MARK_SUBFORUMS_READ");
                echo "</a>
\t</div>
";
            }
            // line 34
            echo "\t";
            $location = "forumlist_body.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->env->loadTemplate("forumlist_body.html")->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 36
        echo "
";
        // line 37
        if (isset($context["S_DISPLAY_POST_INFO"])) { $_S_DISPLAY_POST_INFO_ = $context["S_DISPLAY_POST_INFO"]; } else { $_S_DISPLAY_POST_INFO_ = null; }
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        if (isset($context["TOTAL_TOPICS"])) { $_TOTAL_TOPICS_ = $context["TOTAL_TOPICS"]; } else { $_TOTAL_TOPICS_ = null; }
        if (((($_S_DISPLAY_POST_INFO_ || twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) || $_TOTAL_POSTS_) || $_TOTAL_TOPICS_)) {
            // line 38
            echo "\t<div class=\"action-bar top\">

\t";
            // line 40
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["S_DISPLAY_POST_INFO"])) { $_S_DISPLAY_POST_INFO_ = $context["S_DISPLAY_POST_INFO"]; } else { $_S_DISPLAY_POST_INFO_ = null; }
            if (((!$_S_IS_BOT_) && $_S_DISPLAY_POST_INFO_)) {
                // line 41
                echo "\t\t<div class=\"buttons\">
\t\t\t";
                // line 42
                if (isset($context["viewforum_buttons_top_before"])) { $_viewforum_buttons_top_before_ = $context["viewforum_buttons_top_before"]; } else { $_viewforum_buttons_top_before_ = null; }
                // line 43
                echo "
\t\t\t<a href=\"";
                // line 44
                if (isset($context["U_POST_NEW_TOPIC"])) { $_U_POST_NEW_TOPIC_ = $context["U_POST_NEW_TOPIC"]; } else { $_U_POST_NEW_TOPIC_ = null; }
                echo $_U_POST_NEW_TOPIC_;
                echo "\" class=\"button icon-button ";
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo "locked-icon";
                } else {
                    echo "post-icon";
                }
                echo "\" title=\"";
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo $this->env->getExtension('phpbb')->lang("FORUM_LOCKED");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("POST_TOPIC");
                }
                echo "\">
\t\t\t\t";
                // line 45
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo $this->env->getExtension('phpbb')->lang("BUTTON_FORUM_LOCKED");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("BUTTON_NEW_TOPIC");
                }
                // line 46
                echo "\t\t\t</a>

\t\t\t";
                // line 48
                if (isset($context["viewforum_buttons_top_after"])) { $_viewforum_buttons_top_after_ = $context["viewforum_buttons_top_after"]; } else { $_viewforum_buttons_top_after_ = null; }
                // line 49
                echo "\t\t</div>
\t";
            }
            // line 51
            echo "
\t";
            // line 52
            if (isset($context["S_DISPLAY_SEARCHBOX"])) { $_S_DISPLAY_SEARCHBOX_ = $context["S_DISPLAY_SEARCHBOX"]; } else { $_S_DISPLAY_SEARCHBOX_ = null; }
            if ($_S_DISPLAY_SEARCHBOX_) {
                // line 53
                echo "\t\t<div class=\"search-box\" role=\"search\">
\t\t\t<form method=\"get\" id=\"forum-search\" action=\"";
                // line 54
                if (isset($context["S_SEARCHBOX_ACTION"])) { $_S_SEARCHBOX_ACTION_ = $context["S_SEARCHBOX_ACTION"]; } else { $_S_SEARCHBOX_ACTION_ = null; }
                echo $_S_SEARCHBOX_ACTION_;
                echo "\">
\t\t\t<fieldset>
\t\t\t\t<input class=\"inputbox search tiny\" type=\"search\" name=\"keywords\" id=\"search_keywords\" size=\"20\" placeholder=\"";
                // line 56
                echo $this->env->getExtension('phpbb')->lang("SEARCH_FORUM");
                echo "\" />
\t\t\t\t<button class=\"button icon-button search-icon\" type=\"submit\" title=\"";
                // line 57
                echo $this->env->getExtension('phpbb')->lang("SEARCH");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH");
                echo "</button>
\t\t\t\t<a href=\"";
                // line 58
                if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
                echo $_U_SEARCH_;
                echo "\" class=\"button icon-button search-adv-icon\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
                echo "</a>
\t\t\t\t";
                // line 59
                if (isset($context["S_SEARCH_LOCAL_HIDDEN_FIELDS"])) { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = $context["S_SEARCH_LOCAL_HIDDEN_FIELDS"]; } else { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = null; }
                echo $_S_SEARCH_LOCAL_HIDDEN_FIELDS_;
                echo "
\t\t\t</fieldset>
\t\t\t</form>
\t\t</div>
\t";
            }
            // line 64
            echo "
\t<div class=\"pagination\">
\t\t";
            // line 66
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["U_MARK_TOPICS"])) { $_U_MARK_TOPICS_ = $context["U_MARK_TOPICS"]; } else { $_U_MARK_TOPICS_ = null; }
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if ((((!$_S_IS_BOT_) && $_U_MARK_TOPICS_) && twig_length_filter($this->env, $this->getAttribute($_loops_, "topicrow")))) {
                echo "<a href=\"";
                if (isset($context["U_MARK_TOPICS"])) { $_U_MARK_TOPICS_ = $context["U_MARK_TOPICS"]; } else { $_U_MARK_TOPICS_ = null; }
                echo $_U_MARK_TOPICS_;
                echo "\" class=\"mark\" accesskey=\"m\" data-ajax=\"mark_topics_read\">";
                echo $this->env->getExtension('phpbb')->lang("MARK_TOPICS_READ");
                echo "</a> &bull; ";
            }
            // line 67
            echo "\t\t";
            if (isset($context["TOTAL_TOPICS"])) { $_TOTAL_TOPICS_ = $context["TOTAL_TOPICS"]; } else { $_TOTAL_TOPICS_ = null; }
            echo $_TOTAL_TOPICS_;
            echo "
\t\t";
            // line 68
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
                // line 69
                echo "\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->env->loadTemplate("pagination.html")->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 70
                echo "\t\t";
            } else {
                // line 71
                echo "\t\t\t&bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t";
            }
            // line 73
            echo "\t</div>

\t</div>
";
        }
        // line 77
        echo "
";
        // line 78
        if (isset($context["S_NO_READ_ACCESS"])) { $_S_NO_READ_ACCESS_ = $context["S_NO_READ_ACCESS"]; } else { $_S_NO_READ_ACCESS_ = null; }
        if ($_S_NO_READ_ACCESS_) {
            // line 79
            echo "
\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<strong>";
            // line 82
            echo $this->env->getExtension('phpbb')->lang("NO_READ_ACCESS");
            echo "</strong>
\t\t</div>
\t</div>

\t";
            // line 86
            if (isset($context["S_USER_LOGGED_IN"])) { $_S_USER_LOGGED_IN_ = $context["S_USER_LOGGED_IN"]; } else { $_S_USER_LOGGED_IN_ = null; }
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (((!$_S_USER_LOGGED_IN_) && (!$_S_IS_BOT_))) {
                // line 87
                echo "
\t\t<form action=\"";
                // line 88
                if (isset($context["S_LOGIN_ACTION"])) { $_S_LOGIN_ACTION_ = $context["S_LOGIN_ACTION"]; } else { $_S_LOGIN_ACTION_ = null; }
                echo $_S_LOGIN_ACTION_;
                echo "\" method=\"post\">

\t\t<div class=\"panel\">
\t\t\t<div class=\"inner\">

\t\t\t<div class=\"content\">
\t\t\t\t<h3><a href=\"";
                // line 94
                if (isset($context["U_LOGIN_LOGOUT"])) { $_U_LOGIN_LOGOUT_ = $context["U_LOGIN_LOGOUT"]; } else { $_U_LOGIN_LOGOUT_ = null; }
                echo $_U_LOGIN_LOGOUT_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("LOGIN_LOGOUT");
                echo "</a>";
                if (isset($context["S_REGISTER_ENABLED"])) { $_S_REGISTER_ENABLED_ = $context["S_REGISTER_ENABLED"]; } else { $_S_REGISTER_ENABLED_ = null; }
                if ($_S_REGISTER_ENABLED_) {
                    echo "&nbsp; &bull; &nbsp;<a href=\"";
                    if (isset($context["U_REGISTER"])) { $_U_REGISTER_ = $context["U_REGISTER"]; } else { $_U_REGISTER_ = null; }
                    echo $_U_REGISTER_;
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("REGISTER");
                    echo "</a>";
                }
                echo "</h3>

\t\t\t\t<fieldset class=\"fields1\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"username\">";
                // line 98
                echo $this->env->getExtension('phpbb')->lang("USERNAME");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t\t\t<dd><input type=\"text\" tabindex=\"1\" name=\"username\" id=\"username\" size=\"25\" value=\"";
                // line 99
                if (isset($context["USERNAME"])) { $_USERNAME_ = $context["USERNAME"]; } else { $_USERNAME_ = null; }
                echo $_USERNAME_;
                echo "\" class=\"inputbox autowidth\" /></dd>
\t\t\t\t</dl>
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"password\">";
                // line 102
                echo $this->env->getExtension('phpbb')->lang("PASSWORD");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t\t\t<dd><input type=\"password\" tabindex=\"2\" id=\"password\" name=\"password\" size=\"25\" class=\"inputbox autowidth\" /></dd>
\t\t\t\t\t";
                // line 104
                if (isset($context["S_AUTOLOGIN_ENABLED"])) { $_S_AUTOLOGIN_ENABLED_ = $context["S_AUTOLOGIN_ENABLED"]; } else { $_S_AUTOLOGIN_ENABLED_ = null; }
                if ($_S_AUTOLOGIN_ENABLED_) {
                    echo "<dd><label for=\"autologin\"><input type=\"checkbox\" name=\"autologin\" id=\"autologin\" tabindex=\"3\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("LOG_ME_IN");
                    echo "</label></dd>";
                }
                // line 105
                echo "\t\t\t\t\t<dd><label for=\"viewonline\"><input type=\"checkbox\" name=\"viewonline\" id=\"viewonline\" tabindex=\"4\" /> ";
                echo $this->env->getExtension('phpbb')->lang("HIDE_ME");
                echo "</label></dd>
\t\t\t\t</dl>
\t\t\t\t<dl>
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd><input type=\"submit\" name=\"login\" tabindex=\"5\" value=\"";
                // line 109
                echo $this->env->getExtension('phpbb')->lang("LOGIN");
                echo "\" class=\"button1\" /></dd>
\t\t\t\t</dl>
\t\t\t\t";
                // line 111
                if (isset($context["S_LOGIN_REDIRECT"])) { $_S_LOGIN_REDIRECT_ = $context["S_LOGIN_REDIRECT"]; } else { $_S_LOGIN_REDIRECT_ = null; }
                echo $_S_LOGIN_REDIRECT_;
                echo "
\t\t\t\t</fieldset>
\t\t\t</div>

\t\t\t</div>
\t\t</div>

\t\t</form>

\t";
            }
            // line 121
            echo "
";
        }
        // line 123
        echo "
";
        // line 124
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "topicrow"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["topicrow"]) {
            // line 125
            echo "
\t";
            // line 126
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (((!$this->getAttribute($_topicrow_, "S_TOPIC_TYPE_SWITCH")) && (!$this->getAttribute($_topicrow_, "S_FIRST_ROW")))) {
                // line 127
                echo "\t\t</ul>
\t\t</div>
\t</div>
\t";
            }
            // line 131
            echo "
\t";
            // line 132
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (($this->getAttribute($_topicrow_, "S_FIRST_ROW") || (!$this->getAttribute($_topicrow_, "S_TOPIC_TYPE_SWITCH")))) {
                // line 133
                echo "\t\t<div class=\"forumbg";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if (($this->getAttribute($_topicrow_, "S_TOPIC_TYPE_SWITCH") && ($this->getAttribute($_topicrow_, "S_POST_ANNOUNCE") || $this->getAttribute($_topicrow_, "S_POST_GLOBAL")))) {
                    echo " announcement";
                }
                echo "\">
\t\t<div class=\"inner\">
\t\t<ul class=\"topiclist\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl class=\"icon\">
\t\t\t\t\t<dt";
                // line 138
                if (isset($context["S_DISPLAY_ACTIVE"])) { $_S_DISPLAY_ACTIVE_ = $context["S_DISPLAY_ACTIVE"]; } else { $_S_DISPLAY_ACTIVE_ = null; }
                if ($_S_DISPLAY_ACTIVE_) {
                    echo " id=\"active_topics\"";
                }
                echo "><div class=\"list-inner\">";
                if (isset($context["S_DISPLAY_ACTIVE"])) { $_S_DISPLAY_ACTIVE_ = $context["S_DISPLAY_ACTIVE"]; } else { $_S_DISPLAY_ACTIVE_ = null; }
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($_S_DISPLAY_ACTIVE_) {
                    echo $this->env->getExtension('phpbb')->lang("ACTIVE_TOPICS");
                } elseif (($this->getAttribute($_topicrow_, "S_TOPIC_TYPE_SWITCH") && ($this->getAttribute($_topicrow_, "S_POST_ANNOUNCE") || $this->getAttribute($_topicrow_, "S_POST_GLOBAL")))) {
                    echo $this->env->getExtension('phpbb')->lang("ANNOUNCEMENTS");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("TOPICS");
                }
                echo "</div></dt>
\t\t\t\t\t<dd class=\"posts\">";
                // line 139
                echo $this->env->getExtension('phpbb')->lang("REPLIES");
                echo "</dd>
\t\t\t\t\t<dd class=\"views\">";
                // line 140
                echo $this->env->getExtension('phpbb')->lang("VIEWS");
                echo "</dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 141
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo "</span></dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist topics\">
\t";
            }
            // line 147
            echo "
\t\t<li class=\"row";
            // line 148
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (($this->getAttribute($_topicrow_, "S_ROW_COUNT") % 2 == 0)) {
                echo " bg1";
            } else {
                echo " bg2";
            }
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_POST_GLOBAL")) {
                echo " global-announce";
            }
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_POST_ANNOUNCE")) {
                echo " announce";
            }
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_POST_STICKY")) {
                echo " sticky";
            }
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_TOPIC_REPORTED")) {
                echo " reported";
            }
            echo "\">
\t\t\t<dl class=\"icon ";
            // line 149
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "TOPIC_IMG_STYLE");
            echo "\">
\t\t\t\t<dt";
            // line 150
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (isset($context["S_TOPIC_ICONS"])) { $_S_TOPIC_ICONS_ = $context["S_TOPIC_ICONS"]; } else { $_S_TOPIC_ICONS_ = null; }
            if (($this->getAttribute($_topicrow_, "TOPIC_ICON_IMG") && $_S_TOPIC_ICONS_)) {
                echo " style=\"background-image: url(";
                if (isset($context["T_ICONS_PATH"])) { $_T_ICONS_PATH_ = $context["T_ICONS_PATH"]; } else { $_T_ICONS_PATH_ = null; }
                echo $_T_ICONS_PATH_;
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "TOPIC_ICON_IMG");
                echo "); background-repeat: no-repeat;\"";
            }
            echo " title=\"";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "TOPIC_FOLDER_IMG_ALT");
            echo "\">
\t\t\t\t\t";
            // line 151
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (($this->getAttribute($_topicrow_, "S_UNREAD_TOPIC") && (!$_S_IS_BOT_))) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_NEWEST_POST");
                echo "\" class=\"icon-link\"></a>";
            }
            // line 152
            echo "\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
            // line 153
            if (isset($context["topiclist_row_prepend"])) { $_topiclist_row_prepend_ = $context["topiclist_row_prepend"]; } else { $_topiclist_row_prepend_ = null; }
            // line 154
            echo "\t\t\t\t\t\t";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (($this->getAttribute($_topicrow_, "S_UNREAD_TOPIC") && (!$_S_IS_BOT_))) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_NEWEST_POST");
                echo "\">";
                if (isset($context["NEWEST_POST_IMG"])) { $_NEWEST_POST_IMG_ = $context["NEWEST_POST_IMG"]; } else { $_NEWEST_POST_IMG_ = null; }
                echo $_NEWEST_POST_IMG_;
                echo "</a> ";
            }
            echo "<a href=\"";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "U_VIEW_TOPIC");
            echo "\" class=\"topictitle\">";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "TOPIC_TITLE");
            echo "</a>
\t\t\t\t\t\t";
            // line 155
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (($this->getAttribute($_topicrow_, "S_TOPIC_UNAPPROVED") || $this->getAttribute($_topicrow_, "S_POSTS_UNAPPROVED"))) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_MCP_QUEUE");
                echo "\">";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "UNAPPROVED_IMG");
                echo "</a> ";
            }
            // line 156
            echo "\t\t\t\t\t\t";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_TOPIC_DELETED")) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_MCP_QUEUE");
                echo "\">";
                if (isset($context["DELETED_IMG"])) { $_DELETED_IMG_ = $context["DELETED_IMG"]; } else { $_DELETED_IMG_ = null; }
                echo $_DELETED_IMG_;
                echo "</a> ";
            }
            // line 157
            echo "\t\t\t\t\t\t";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_TOPIC_REPORTED")) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_MCP_REPORT");
                echo "\">";
                if (isset($context["REPORTED_IMG"])) { $_REPORTED_IMG_ = $context["REPORTED_IMG"]; } else { $_REPORTED_IMG_ = null; }
                echo $_REPORTED_IMG_;
                echo "</a>";
            }
            echo "<br />

\t\t\t\t\t\t";
            // line 159
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ((!$_S_IS_BOT_)) {
                // line 160
                echo "\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t";
                // line 161
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo " ";
                echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                echo " ";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_AUTHOR_FULL");
                echo " &laquo; <a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_LAST_POST");
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("GOTO_LAST_POST");
                echo "\">";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "LAST_POST_TIME");
                echo "</a>
\t\t\t\t\t\t\t";
                // line 162
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if (isset($context["FORUM_ID"])) { $_FORUM_ID_ = $context["FORUM_ID"]; } else { $_FORUM_ID_ = null; }
                if (($this->getAttribute($_topicrow_, "S_POST_GLOBAL") && ($_FORUM_ID_ != $this->getAttribute($_topicrow_, "FORUM_ID")))) {
                    echo "<br />";
                    echo $this->env->getExtension('phpbb')->lang("POSTED");
                    echo " ";
                    echo $this->env->getExtension('phpbb')->lang("IN");
                    echo " <a href=\"";
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "U_VIEW_FORUM");
                    echo "\">";
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "FORUM_NAME");
                    echo "</a>";
                }
                // line 163
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                // line 164
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                if ($this->getAttribute($_topicrow_, "REPLIES")) {
                    echo "<span class=\"responsive-show left-box\" style=\"display: none;\">";
                    echo $this->env->getExtension('phpbb')->lang("REPLIES");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <strong>";
                    if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                    echo $this->getAttribute($_topicrow_, "REPLIES");
                    echo "</strong></span>";
                }
                // line 165
                echo "\t\t\t\t\t\t";
            }
            // line 166
            echo "
\t\t\t\t\t\t";
            // line 167
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_topicrow_, "pagination"))) {
                // line 168
                echo "\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t";
                // line 170
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_topicrow_, "pagination"));
                foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                    // line 171
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                    if ($this->getAttribute($_pagination_, "S_IS_PREV")) {
                        // line 172
                        echo "\t\t\t\t\t\t\t\t";
                    } elseif ($this->getAttribute($_pagination_, "S_IS_CURRENT")) {
                        echo "<li class=\"active\"><span>";
                        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                        echo $this->getAttribute($_pagination_, "PAGE_NUMBER");
                        echo "</span></li>
\t\t\t\t\t\t\t\t";
                    } elseif ($this->getAttribute($_pagination_, "S_IS_ELLIPSIS")) {
                        // line 173
                        echo "<li class=\"ellipsis\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("ELLIPSIS");
                        echo "</span></li>
\t\t\t\t\t\t\t\t";
                    } elseif ($this->getAttribute($_pagination_, "S_IS_NEXT")) {
                        // line 175
                        echo "\t\t\t\t\t\t\t\t";
                    } else {
                        echo "<li><a href=\"";
                        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                        echo $this->getAttribute($_pagination_, "PAGE_URL");
                        echo "\">";
                        if (isset($context["pagination"])) { $_pagination_ = $context["pagination"]; } else { $_pagination_ = null; }
                        echo $this->getAttribute($_pagination_, "PAGE_NUMBER");
                        echo "</a></li>
\t\t\t\t\t\t\t\t";
                    }
                    // line 177
                    echo "\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 178
                echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            // line 181
            echo "
\t\t\t\t\t\t<div class=\"responsive-hide\">
\t\t\t\t\t\t\t";
            // line 183
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_HAS_POLL")) {
                if (isset($context["POLL_IMG"])) { $_POLL_IMG_ = $context["POLL_IMG"]; } else { $_POLL_IMG_ = null; }
                echo $_POLL_IMG_;
                echo " ";
            }
            // line 184
            echo "\t\t\t\t\t\t\t";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "ATTACH_ICON_IMG")) {
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "ATTACH_ICON_IMG");
                echo " ";
            }
            // line 185
            echo "\t\t\t\t\t\t\t";
            echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
            echo " ";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "TOPIC_AUTHOR_FULL");
            echo " &raquo; ";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "FIRST_POST_TIME");
            echo "
\t\t\t\t\t\t\t";
            // line 186
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if (isset($context["FORUM_ID"])) { $_FORUM_ID_ = $context["FORUM_ID"]; } else { $_FORUM_ID_ = null; }
            if (($this->getAttribute($_topicrow_, "S_POST_GLOBAL") && ($_FORUM_ID_ != $this->getAttribute($_topicrow_, "FORUM_ID")))) {
                echo " &raquo; ";
                echo $this->env->getExtension('phpbb')->lang("IN");
                echo " <a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_VIEW_FORUM");
                echo "\">";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "FORUM_NAME");
                echo "</a>";
            }
            // line 187
            echo "\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
            // line 189
            if (isset($context["topiclist_row_append"])) { $_topiclist_row_append_ = $context["topiclist_row_append"]; } else { $_topiclist_row_append_ = null; }
            // line 190
            echo "\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"posts\">";
            // line 192
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "REPLIES");
            echo " <dfn>";
            echo $this->env->getExtension('phpbb')->lang("REPLIES");
            echo "</dfn></dd>
\t\t\t\t<dd class=\"views\">";
            // line 193
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "VIEWS");
            echo " <dfn>";
            echo $this->env->getExtension('phpbb')->lang("VIEWS");
            echo "</dfn></dd>
\t\t\t\t<dd class=\"lastpost\"><span><dfn>";
            // line 194
            echo $this->env->getExtension('phpbb')->lang("LAST_POST");
            echo " </dfn>";
            echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
            echo " ";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "LAST_POST_AUTHOR_FULL");
            echo "
\t\t\t\t\t";
            // line 195
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ((!$_S_IS_BOT_)) {
                echo "<a href=\"";
                if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
                echo $this->getAttribute($_topicrow_, "U_LAST_POST");
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("GOTO_LAST_POST");
                echo "\">";
                if (isset($context["LAST_POST_IMG"])) { $_LAST_POST_IMG_ = $context["LAST_POST_IMG"]; } else { $_LAST_POST_IMG_ = null; }
                echo $_LAST_POST_IMG_;
                echo "</a> ";
            }
            echo "<br />";
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            echo $this->getAttribute($_topicrow_, "LAST_POST_TIME");
            echo "</span>
\t\t\t\t</dd>
\t\t\t</dl>
\t\t</li>

\t";
            // line 200
            if (isset($context["topicrow"])) { $_topicrow_ = $context["topicrow"]; } else { $_topicrow_ = null; }
            if ($this->getAttribute($_topicrow_, "S_LAST_ROW")) {
                // line 201
                echo "\t\t\t</ul>
\t\t</div>
\t</div>
\t";
            }
            // line 205
            echo "
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 207
            echo "\t";
            if (isset($context["S_IS_POSTABLE"])) { $_S_IS_POSTABLE_ = $context["S_IS_POSTABLE"]; } else { $_S_IS_POSTABLE_ = null; }
            if ($_S_IS_POSTABLE_) {
                // line 208
                echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<strong>";
                // line 210
                echo $this->env->getExtension('phpbb')->lang("NO_TOPICS");
                echo "</strong>
\t\t</div>
\t</div>
\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topicrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 215
        echo "
";
        // line 216
        if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
        if (isset($context["S_DISPLAY_ACTIVE"])) { $_S_DISPLAY_ACTIVE_ = $context["S_DISPLAY_ACTIVE"]; } else { $_S_DISPLAY_ACTIVE_ = null; }
        if (($_S_SELECT_SORT_DAYS_ && (!$_S_DISPLAY_ACTIVE_))) {
            // line 217
            echo "\t<form method=\"post\" action=\"";
            if (isset($context["S_FORUM_ACTION"])) { $_S_FORUM_ACTION_ = $context["S_FORUM_ACTION"]; } else { $_S_FORUM_ACTION_ = null; }
            echo $_S_FORUM_ACTION_;
            echo "\">
\t\t<fieldset class=\"display-options\">
\t";
            // line 219
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ((!$_S_IS_BOT_)) {
                // line 220
                echo "\t\t\t<label>";
                echo $this->env->getExtension('phpbb')->lang("DISPLAY_TOPICS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo " ";
                if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
                echo $_S_SELECT_SORT_DAYS_;
                echo "</label>
\t\t\t<label>";
                // line 221
                echo $this->env->getExtension('phpbb')->lang("SORT_BY");
                echo " ";
                if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
                echo $_S_SELECT_SORT_KEY_;
                echo "</label>
\t\t\t<label>";
                // line 222
                if (isset($context["S_SELECT_SORT_DIR"])) { $_S_SELECT_SORT_DIR_ = $context["S_SELECT_SORT_DIR"]; } else { $_S_SELECT_SORT_DIR_ = null; }
                echo $_S_SELECT_SORT_DIR_;
                echo "</label>
\t\t\t<input type=\"submit\" name=\"sort\" value=\"";
                // line 223
                echo $this->env->getExtension('phpbb')->lang("GO");
                echo "\" class=\"button2\" />
\t";
            }
            // line 225
            echo "\t\t</fieldset>
\t</form>
\t<hr />
";
        }
        // line 229
        echo "
";
        // line 230
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["S_DISPLAY_ACTIVE"])) { $_S_DISPLAY_ACTIVE_ = $context["S_DISPLAY_ACTIVE"]; } else { $_S_DISPLAY_ACTIVE_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "topicrow")) && (!$_S_DISPLAY_ACTIVE_))) {
            // line 231
            echo "\t<div class=\"action-bar bottom\">
\t\t";
            // line 232
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["S_DISPLAY_POST_INFO"])) { $_S_DISPLAY_POST_INFO_ = $context["S_DISPLAY_POST_INFO"]; } else { $_S_DISPLAY_POST_INFO_ = null; }
            if (((!$_S_IS_BOT_) && $_S_DISPLAY_POST_INFO_)) {
                // line 233
                echo "\t\t\t<div class=\"buttons\">
\t\t\t\t";
                // line 234
                if (isset($context["viewforum_buttons_bottom_before"])) { $_viewforum_buttons_bottom_before_ = $context["viewforum_buttons_bottom_before"]; } else { $_viewforum_buttons_bottom_before_ = null; }
                // line 235
                echo "
\t\t\t\t<a href=\"";
                // line 236
                if (isset($context["U_POST_NEW_TOPIC"])) { $_U_POST_NEW_TOPIC_ = $context["U_POST_NEW_TOPIC"]; } else { $_U_POST_NEW_TOPIC_ = null; }
                echo $_U_POST_NEW_TOPIC_;
                echo "\" class=\"button icon-button ";
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo "locked-icon";
                } else {
                    echo "post-icon";
                }
                echo "\" title=\"";
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo $this->env->getExtension('phpbb')->lang("FORUM_LOCKED");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("POST_TOPIC");
                }
                echo "\">
\t\t\t\t\t";
                // line 237
                if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
                if ($_S_IS_LOCKED_) {
                    echo $this->env->getExtension('phpbb')->lang("BUTTON_FORUM_LOCKED");
                } else {
                    echo $this->env->getExtension('phpbb')->lang("BUTTON_NEW_TOPIC");
                }
                // line 238
                echo "\t\t\t\t</a>

\t\t\t\t";
                // line 240
                if (isset($context["viewforum_buttons_bottom_after"])) { $_viewforum_buttons_bottom_after_ = $context["viewforum_buttons_bottom_after"]; } else { $_viewforum_buttons_bottom_after_ = null; }
                // line 241
                echo "\t\t\t</div>
\t\t";
            }
            // line 243
            echo "
\t\t<div class=\"pagination\">
\t\t\t";
            // line 245
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["U_MARK_TOPICS"])) { $_U_MARK_TOPICS_ = $context["U_MARK_TOPICS"]; } else { $_U_MARK_TOPICS_ = null; }
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if ((((!$_S_IS_BOT_) && $_U_MARK_TOPICS_) && twig_length_filter($this->env, $this->getAttribute($_loops_, "topicrow")))) {
                echo "<a href=\"";
                if (isset($context["U_MARK_TOPICS"])) { $_U_MARK_TOPICS_ = $context["U_MARK_TOPICS"]; } else { $_U_MARK_TOPICS_ = null; }
                echo $_U_MARK_TOPICS_;
                echo "\" data-ajax=\"mark_topics_read\">";
                echo $this->env->getExtension('phpbb')->lang("MARK_TOPICS_READ");
                echo "</a> &bull; ";
            }
            // line 246
            echo "\t\t\t";
            if (isset($context["TOTAL_TOPICS"])) { $_TOTAL_TOPICS_ = $context["TOTAL_TOPICS"]; } else { $_TOTAL_TOPICS_ = null; }
            echo $_TOTAL_TOPICS_;
            echo "
\t\t\t";
            // line 247
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
                // line 248
                echo "\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->env->loadTemplate("pagination.html")->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 249
                echo "\t\t\t";
            } else {
                // line 250
                echo "\t\t\t\t &bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 252
            echo "\t\t</div>
\t</div>
";
        }
        // line 255
        echo "
";
        // line 256
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("jumpbox.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 257
        echo "
";
        // line 258
        if (isset($context["S_DISPLAY_ONLINE_LIST"])) { $_S_DISPLAY_ONLINE_LIST_ = $context["S_DISPLAY_ONLINE_LIST"]; } else { $_S_DISPLAY_ONLINE_LIST_ = null; }
        if ($_S_DISPLAY_ONLINE_LIST_) {
            // line 259
            echo "\t<div class=\"stat-block online-list\">
\t\t<h3>";
            // line 260
            if (isset($context["U_VIEWONLINE"])) { $_U_VIEWONLINE_ = $context["U_VIEWONLINE"]; } else { $_U_VIEWONLINE_ = null; }
            if ($_U_VIEWONLINE_) {
                echo "<a href=\"";
                if (isset($context["U_VIEWONLINE"])) { $_U_VIEWONLINE_ = $context["U_VIEWONLINE"]; } else { $_U_VIEWONLINE_ = null; }
                echo $_U_VIEWONLINE_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
                echo "</a>";
            } else {
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
            }
            echo "</h3>
\t\t<p>";
            // line 261
            if (isset($context["LOGGED_IN_USER_LIST"])) { $_LOGGED_IN_USER_LIST_ = $context["LOGGED_IN_USER_LIST"]; } else { $_LOGGED_IN_USER_LIST_ = null; }
            echo $_LOGGED_IN_USER_LIST_;
            echo "</p>
\t</div>
";
        }
        // line 264
        echo "
";
        // line 265
        if (isset($context["S_DISPLAY_POST_INFO"])) { $_S_DISPLAY_POST_INFO_ = $context["S_DISPLAY_POST_INFO"]; } else { $_S_DISPLAY_POST_INFO_ = null; }
        if ($_S_DISPLAY_POST_INFO_) {
            // line 266
            echo "\t<div class=\"stat-block permissions\">
\t\t<h3>";
            // line 267
            echo $this->env->getExtension('phpbb')->lang("FORUM_PERMISSIONS");
            echo "</h3>
\t\t<p>";
            // line 268
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "rules"));
            foreach ($context['_seq'] as $context["_key"] => $context["rules"]) {
                if (isset($context["rules"])) { $_rules_ = $context["rules"]; } else { $_rules_ = null; }
                echo $this->getAttribute($_rules_, "RULE");
                echo "<br />";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rules'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</p>
\t</div>
";
        }
        // line 271
        echo "
";
        // line 272
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
        return "viewforum_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1113 => 272,  1110 => 271,  1094 => 268,  1090 => 267,  1087 => 266,  1084 => 265,  1081 => 264,  1074 => 261,  1060 => 260,  1057 => 259,  1054 => 258,  1051 => 257,  1039 => 256,  1036 => 255,  1031 => 252,  1024 => 250,  1021 => 249,  1008 => 248,  1005 => 247,  999 => 246,  987 => 245,  983 => 243,  979 => 241,  977 => 240,  973 => 238,  966 => 237,  947 => 236,  944 => 235,  942 => 234,  939 => 233,  935 => 232,  932 => 231,  928 => 230,  925 => 229,  919 => 225,  914 => 223,  909 => 222,  902 => 221,  893 => 220,  890 => 219,  883 => 217,  879 => 216,  876 => 215,  865 => 210,  861 => 208,  857 => 207,  851 => 205,  845 => 201,  842 => 200,  820 => 195,  811 => 194,  804 => 193,  797 => 192,  793 => 190,  791 => 189,  787 => 187,  773 => 186,  762 => 185,  754 => 184,  747 => 183,  743 => 181,  738 => 178,  732 => 177,  720 => 175,  714 => 173,  705 => 172,  701 => 171,  696 => 170,  692 => 168,  689 => 167,  686 => 166,  683 => 165,  672 => 164,  669 => 163,  653 => 162,  636 => 161,  633 => 160,  630 => 159,  615 => 157,  603 => 156,  592 => 155,  571 => 154,  569 => 153,  566 => 152,  557 => 151,  541 => 150,  536 => 149,  511 => 148,  508 => 147,  499 => 141,  495 => 140,  491 => 139,  474 => 138,  462 => 133,  459 => 132,  456 => 131,  450 => 127,  447 => 126,  444 => 125,  438 => 124,  435 => 123,  431 => 121,  417 => 111,  412 => 109,  404 => 105,  397 => 104,  391 => 102,  384 => 99,  379 => 98,  359 => 94,  349 => 88,  346 => 87,  342 => 86,  335 => 82,  330 => 79,  327 => 78,  324 => 77,  318 => 73,  311 => 71,  308 => 70,  295 => 69,  292 => 68,  286 => 67,  274 => 66,  270 => 64,  261 => 59,  252 => 58,  246 => 57,  242 => 56,  236 => 54,  233 => 53,  230 => 52,  227 => 51,  223 => 49,  221 => 48,  217 => 46,  210 => 45,  191 => 44,  188 => 43,  186 => 42,  183 => 41,  179 => 40,  175 => 38,  169 => 37,  166 => 36,  152 => 34,  143 => 31,  140 => 30,  136 => 29,  133 => 28,  130 => 27,  124 => 23,  118 => 21,  113 => 20,  104 => 18,  101 => 17,  91 => 14,  88 => 13,  85 => 12,  81 => 10,  64 => 9,  56 => 8,  52 => 6,  47 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }
}
