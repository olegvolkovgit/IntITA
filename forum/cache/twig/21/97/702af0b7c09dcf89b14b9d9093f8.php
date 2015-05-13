<?php

/* viewtopic_body.html */
class __TwigTemplate_2197702af0b7c09dcf89b14b9d9093f8 extends Twig_Template
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
<h2 class=\"topic-title\">";
        // line 3
        if (isset($context["viewtopic_topic_title_prepend"])) { $_viewtopic_topic_title_prepend_ = $context["viewtopic_topic_title_prepend"]; } else { $_viewtopic_topic_title_prepend_ = null; }
        echo "<a href=\"";
        if (isset($context["U_VIEW_TOPIC"])) { $_U_VIEW_TOPIC_ = $context["U_VIEW_TOPIC"]; } else { $_U_VIEW_TOPIC_ = null; }
        echo $_U_VIEW_TOPIC_;
        echo "\">";
        if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
        echo $_TOPIC_TITLE_;
        echo "</a>";
        if (isset($context["viewtopic_topic_title_append"])) { $_viewtopic_topic_title_append_ = $context["viewtopic_topic_title_append"]; } else { $_viewtopic_topic_title_append_ = null; }
        echo "</h2>
<!-- NOTE: remove the style=\"display: none\" when you want to have the forum description on the topic body -->
";
        // line 5
        if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
        if ($_FORUM_DESC_) {
            echo "<div style=\"display: none !important;\">";
            if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
            echo $_FORUM_DESC_;
            echo "<br /></div>";
        }
        // line 6
        echo "
";
        // line 7
        if (isset($context["MODERATORS"])) { $_MODERATORS_ = $context["MODERATORS"]; } else { $_MODERATORS_ = null; }
        if ($_MODERATORS_) {
            // line 8
            echo "<p>
\t<strong>";
            // line 9
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
            echo "
</p>
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
<div class=\"action-bar top\">

\t<div class=\"buttons\">
\t\t";
        // line 31
        if (isset($context["viewtopic_buttons_top_before"])) { $_viewtopic_buttons_top_before_ = $context["viewtopic_buttons_top_before"]; } else { $_viewtopic_buttons_top_before_ = null; }
        // line 32
        echo "
\t";
        // line 33
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if (isset($context["S_DISPLAY_REPLY_INFO"])) { $_S_DISPLAY_REPLY_INFO_ = $context["S_DISPLAY_REPLY_INFO"]; } else { $_S_DISPLAY_REPLY_INFO_ = null; }
        if (((!$_S_IS_BOT_) && $_S_DISPLAY_REPLY_INFO_)) {
            // line 34
            echo "\t\t<a href=\"";
            if (isset($context["U_POST_REPLY_TOPIC"])) { $_U_POST_REPLY_TOPIC_ = $context["U_POST_REPLY_TOPIC"]; } else { $_U_POST_REPLY_TOPIC_ = null; }
            echo $_U_POST_REPLY_TOPIC_;
            echo "\" class=\"button icon-button ";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo "locked-icon";
            } else {
                echo "reply-icon";
            }
            echo "\" title=\"";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("POST_REPLY");
            }
            echo "\">
\t\t\t";
            // line 35
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_POST_REPLY");
            }
            // line 36
            echo "\t\t</a>
\t";
        }
        // line 38
        echo "
\t\t";
        // line 39
        if (isset($context["viewtopic_buttons_top_after"])) { $_viewtopic_buttons_top_after_ = $context["viewtopic_buttons_top_after"]; } else { $_viewtopic_buttons_top_after_ = null; }
        // line 40
        echo "\t</div>

\t";
        // line 42
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("viewtopic_topic_tools.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 43
        echo "
\t";
        // line 44
        if (isset($context["S_DISPLAY_SEARCHBOX"])) { $_S_DISPLAY_SEARCHBOX_ = $context["S_DISPLAY_SEARCHBOX"]; } else { $_S_DISPLAY_SEARCHBOX_ = null; }
        if ($_S_DISPLAY_SEARCHBOX_) {
            // line 45
            echo "\t\t<div class=\"search-box\" role=\"search\">
\t\t\t<form method=\"get\" id=\"topic-search\" action=\"";
            // line 46
            if (isset($context["S_SEARCHBOX_ACTION"])) { $_S_SEARCHBOX_ACTION_ = $context["S_SEARCHBOX_ACTION"]; } else { $_S_SEARCHBOX_ACTION_ = null; }
            echo $_S_SEARCHBOX_ACTION_;
            echo "\">
\t\t\t<fieldset>
\t\t\t\t<input class=\"inputbox search tiny\"  type=\"search\" name=\"keywords\" id=\"search_keywords\" size=\"20\" placeholder=\"";
            // line 48
            echo $this->env->getExtension('phpbb')->lang("SEARCH_TOPIC");
            echo "\" />
\t\t\t\t<button class=\"button icon-button search-icon\" type=\"submit\" title=\"";
            // line 49
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "</button>
\t\t\t\t<a href=\"";
            // line 50
            if (isset($context["U_SEARCH"])) { $_U_SEARCH_ = $context["U_SEARCH"]; } else { $_U_SEARCH_ = null; }
            echo $_U_SEARCH_;
            echo "\" class=\"button icon-button search-adv-icon\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "</a>
\t\t\t\t";
            // line 51
            if (isset($context["S_SEARCH_LOCAL_HIDDEN_FIELDS"])) { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = $context["S_SEARCH_LOCAL_HIDDEN_FIELDS"]; } else { $_S_SEARCH_LOCAL_HIDDEN_FIELDS_ = null; }
            echo $_S_SEARCH_LOCAL_HIDDEN_FIELDS_;
            echo "
\t\t\t</fieldset>
\t\t\t</form>
\t\t</div>
\t";
        }
        // line 56
        echo "
\t";
        // line 57
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination")) || $_TOTAL_POSTS_)) {
            // line 58
            echo "\t\t<div class=\"pagination\">
\t\t\t";
            // line 59
            if (isset($context["U_VIEW_UNREAD_POST"])) { $_U_VIEW_UNREAD_POST_ = $context["U_VIEW_UNREAD_POST"]; } else { $_U_VIEW_UNREAD_POST_ = null; }
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (($_U_VIEW_UNREAD_POST_ && (!$_S_IS_BOT_))) {
                echo "<a href=\"";
                if (isset($context["U_VIEW_UNREAD_POST"])) { $_U_VIEW_UNREAD_POST_ = $context["U_VIEW_UNREAD_POST"]; } else { $_U_VIEW_UNREAD_POST_ = null; }
                echo $_U_VIEW_UNREAD_POST_;
                echo "\" class=\"mark\">";
                echo $this->env->getExtension('phpbb')->lang("VIEW_UNREAD_POST");
                echo "</a> &bull; ";
            }
            if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
            echo $_TOTAL_POSTS_;
            echo "
\t\t\t";
            // line 60
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
                // line 61
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
                // line 62
                echo "\t\t\t";
            } else {
                // line 63
                echo "\t\t\t\t&bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 65
            echo "\t\t</div>
\t";
        }
        // line 67
        echo "\t";
        if (isset($context["viewtopic_body_pagination_top_after"])) { $_viewtopic_body_pagination_top_after_ = $context["viewtopic_body_pagination_top_after"]; } else { $_viewtopic_body_pagination_top_after_ = null; }
        // line 68
        echo "</div>

";
        // line 70
        if (isset($context["S_HAS_POLL"])) { $_S_HAS_POLL_ = $context["S_HAS_POLL"]; } else { $_S_HAS_POLL_ = null; }
        if ($_S_HAS_POLL_) {
            // line 71
            echo "\t<form method=\"post\" action=\"";
            if (isset($context["S_POLL_ACTION"])) { $_S_POLL_ACTION_ = $context["S_POLL_ACTION"]; } else { $_S_POLL_ACTION_ = null; }
            echo $_S_POLL_ACTION_;
            echo "\" data-ajax=\"vote_poll\" class=\"topic_poll\">

\t<div class=\"panel\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h2 class=\"poll-title\">";
            // line 77
            if (isset($context["viewtopic_body_poll_question_prepend"])) { $_viewtopic_body_poll_question_prepend_ = $context["viewtopic_body_poll_question_prepend"]; } else { $_viewtopic_body_poll_question_prepend_ = null; }
            if (isset($context["POLL_QUESTION"])) { $_POLL_QUESTION_ = $context["POLL_QUESTION"]; } else { $_POLL_QUESTION_ = null; }
            echo $_POLL_QUESTION_;
            if (isset($context["viewtopic_body_poll_question_append"])) { $_viewtopic_body_poll_question_append_ = $context["viewtopic_body_poll_question_append"]; } else { $_viewtopic_body_poll_question_append_ = null; }
            echo "</h2>
\t\t\t<p class=\"author\">";
            // line 78
            echo $this->env->getExtension('phpbb')->lang("POLL_LENGTH");
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if (isset($context["L_POLL_LENGTH"])) { $_L_POLL_LENGTH_ = $context["L_POLL_LENGTH"]; } else { $_L_POLL_LENGTH_ = null; }
            if (($_S_CAN_VOTE_ && $_L_POLL_LENGTH_)) {
                echo "<br />";
            }
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if ($_S_CAN_VOTE_) {
                echo "<span class=\"poll_max_votes\">";
                echo $this->env->getExtension('phpbb')->lang("MAX_VOTES");
                echo "</span>";
            }
            echo "</p>

\t\t\t<fieldset class=\"polls\">
\t\t\t";
            // line 81
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "poll_option"));
            foreach ($context['_seq'] as $context["_key"] => $context["poll_option"]) {
                // line 82
                echo "\t\t\t\t";
                if (isset($context["viewtopic_body_poll_option_before"])) { $_viewtopic_body_poll_option_before_ = $context["viewtopic_body_poll_option_before"]; } else { $_viewtopic_body_poll_option_before_ = null; }
                // line 83
                echo "\t\t\t\t<dl class=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED")) {
                    echo "voted";
                }
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_MOST_VOTES")) {
                    echo " most-votes";
                }
                echo "\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED")) {
                    echo " title=\"";
                    echo $this->env->getExtension('phpbb')->lang("POLL_VOTED_OPTION");
                    echo "\"";
                }
                echo " data-poll-option-id=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                echo "\">
\t\t\t\t\t<dt>";
                // line 84
                if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
                if ($_S_CAN_VOTE_) {
                    echo "<label for=\"vote_";
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                    echo "\">";
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_CAPTION");
                    echo "</label>";
                } else {
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_CAPTION");
                }
                echo "</dt>
\t\t\t\t\t";
                // line 85
                if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
                if ($_S_CAN_VOTE_) {
                    echo "<dd style=\"width: auto;\" class=\"poll_option_select\">";
                    if (isset($context["S_IS_MULTI_CHOICE"])) { $_S_IS_MULTI_CHOICE_ = $context["S_IS_MULTI_CHOICE"]; } else { $_S_IS_MULTI_CHOICE_ = null; }
                    if ($_S_IS_MULTI_CHOICE_) {
                        echo "<input type=\"checkbox\" name=\"vote_id[]\" id=\"vote_";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                        echo "\" value=\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                        echo "\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED")) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    } else {
                        echo "<input type=\"radio\" name=\"vote_id[]\" id=\"vote_";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                        echo "\" value=\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        echo $this->getAttribute($_poll_option_, "POLL_OPTION_ID");
                        echo "\"";
                        if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                        if ($this->getAttribute($_poll_option_, "POLL_OPTION_VOTED")) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    }
                    echo "</dd>";
                }
                // line 86
                echo "\t\t\t\t\t<dd class=\"resultbar";
                if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
                if ((!$_S_DISPLAY_RESULTS_)) {
                    echo " hidden";
                }
                echo "\"><div class=\"";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT") < 20)) {
                    echo "pollbar1";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT") < 40)) {
                    echo "pollbar2";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT") < 60)) {
                    echo "pollbar3";
                } elseif (($this->getAttribute($_poll_option_, "POLL_OPTION_PCT") < 80)) {
                    echo "pollbar4";
                } else {
                    echo "pollbar5";
                }
                echo "\" style=\"width:";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_PERCENT_REL");
                echo ";\">";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                echo $this->getAttribute($_poll_option_, "POLL_OPTION_RESULT");
                echo "</div></dd>
\t\t\t\t\t<dd class=\"poll_option_percent";
                // line 87
                if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
                if ((!$_S_DISPLAY_RESULTS_)) {
                    echo " hidden";
                }
                echo "\">";
                if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                if (($this->getAttribute($_poll_option_, "POLL_OPTION_RESULT") == 0)) {
                    echo $this->env->getExtension('phpbb')->lang("NO_VOTES");
                } else {
                    if (isset($context["poll_option"])) { $_poll_option_ = $context["poll_option"]; } else { $_poll_option_ = null; }
                    echo $this->getAttribute($_poll_option_, "POLL_OPTION_PERCENT");
                }
                echo "</dd>
\t\t\t\t</dl>
\t\t\t\t";
                // line 89
                if (isset($context["viewtopic_body_poll_option_after"])) { $_viewtopic_body_poll_option_after_ = $context["viewtopic_body_poll_option_after"]; } else { $_viewtopic_body_poll_option_after_ = null; }
                // line 90
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['poll_option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 91
            echo "
\t\t\t\t<dl class=\"poll_total_votes";
            // line 92
            if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
            if ((!$_S_DISPLAY_RESULTS_)) {
                echo " hidden";
            }
            echo "\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\">";
            // line 94
            echo $this->env->getExtension('phpbb')->lang("TOTAL_VOTES");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <span class=\"poll_total_vote_cnt\">";
            if (isset($context["TOTAL_VOTES"])) { $_TOTAL_VOTES_ = $context["TOTAL_VOTES"]; } else { $_TOTAL_VOTES_ = null; }
            echo $_TOTAL_VOTES_;
            echo "</span></dd>
\t\t\t\t</dl>

\t\t\t";
            // line 97
            if (isset($context["S_CAN_VOTE"])) { $_S_CAN_VOTE_ = $context["S_CAN_VOTE"]; } else { $_S_CAN_VOTE_ = null; }
            if ($_S_CAN_VOTE_) {
                // line 98
                echo "\t\t\t\t<dl style=\"border-top: none;\" class=\"poll_vote\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\"><input type=\"submit\" name=\"update\" value=\"";
                // line 100
                echo $this->env->getExtension('phpbb')->lang("SUBMIT_VOTE");
                echo "\" class=\"button1\" /></dd>
\t\t\t\t</dl>
\t\t\t";
            }
            // line 103
            echo "
\t\t\t";
            // line 104
            if (isset($context["S_DISPLAY_RESULTS"])) { $_S_DISPLAY_RESULTS_ = $context["S_DISPLAY_RESULTS"]; } else { $_S_DISPLAY_RESULTS_ = null; }
            if ((!$_S_DISPLAY_RESULTS_)) {
                // line 105
                echo "\t\t\t\t<dl style=\"border-top: none;\" class=\"poll_view_results\">
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd class=\"resultbar\"><a href=\"";
                // line 107
                if (isset($context["U_VIEW_RESULTS"])) { $_U_VIEW_RESULTS_ = $context["U_VIEW_RESULTS"]; } else { $_U_VIEW_RESULTS_ = null; }
                echo $_U_VIEW_RESULTS_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("VIEW_RESULTS");
                echo "</a></dd>
\t\t\t\t</dl>
\t\t\t";
            }
            // line 110
            echo "\t\t\t</fieldset>
\t\t\t<div class=\"vote-submitted hidden\">";
            // line 111
            echo $this->env->getExtension('phpbb')->lang("VOTE_SUBMITTED");
            echo "</div>
\t\t</div>

\t\t</div>
\t\t";
            // line 115
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t\t";
            // line 116
            if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
            echo $_S_HIDDEN_FIELDS_;
            echo "
\t</div>

\t</form>
\t<hr />
";
        }
        // line 122
        echo "
";
        // line 123
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "postrow"));
        foreach ($context['_seq'] as $context["_key"] => $context["postrow"]) {
            // line 124
            echo "\t";
            if (isset($context["viewtopic_body_postrow_post_before"])) { $_viewtopic_body_postrow_post_before_ = $context["viewtopic_body_postrow_post_before"]; } else { $_viewtopic_body_postrow_post_before_ = null; }
            // line 125
            echo "\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_FIRST_UNREAD")) {
                // line 126
                echo "\t\t<a id=\"unread\" class=\"anchor\"";
                if (isset($context["S_UNREAD_VIEW"])) { $_S_UNREAD_VIEW_ = $context["S_UNREAD_VIEW"]; } else { $_S_UNREAD_VIEW_ = null; }
                if ($_S_UNREAD_VIEW_) {
                    echo " data-url=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_MINI_POST");
                    echo "\"";
                }
                echo "></a>
\t";
            }
            // line 128
            echo "\t<div id=\"p";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\" class=\"post has-profile ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "S_ROW_COUNT") % 2 == 1)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_UNREAD_POST")) {
                echo " unreadpost";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_REPORTED")) {
                echo " reported";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_DELETED")) {
                echo " deleted";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "S_ONLINE") && (!$this->getAttribute($_postrow_, "S_POST_HIDDEN")))) {
                echo " online";
            }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_WARNINGS")) {
                echo " warned";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t<dl class=\"postprofile\" id=\"profile";
            // line 131
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN")) {
                echo " style=\"display: none;\"";
            }
            echo ">
\t\t\t<dt class=\"";
            // line 132
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "RANK_TITLE") || $this->getAttribute($_postrow_, "RANK_IMG"))) {
                echo "has-profile-rank";
            } else {
                echo "no-profile-rank";
            }
            echo " ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_AVATAR")) {
                echo "has-avatar";
            } else {
                echo "no-avatar";
            }
            echo "\">
\t\t\t\t<div class=\"avatar-container\">
\t\t\t\t\t";
            // line 134
            if (isset($context["viewtopic_body_avatar_before"])) { $_viewtopic_body_avatar_before_ = $context["viewtopic_body_avatar_before"]; } else { $_viewtopic_body_avatar_before_ = null; }
            // line 135
            echo "\t\t\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_AVATAR")) {
                // line 136
                echo "\t\t\t\t\t\t";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "U_POST_AUTHOR")) {
                    echo "<a href=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_POST_AUTHOR");
                    echo "\" class=\"avatar\">";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POSTER_AVATAR");
                    echo "</a>";
                } else {
                    echo "<span class=\"avatar\">";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POSTER_AVATAR");
                    echo "</span>";
                }
                // line 137
                echo "\t\t\t\t\t";
            }
            // line 138
            echo "\t\t\t\t\t";
            if (isset($context["viewtopic_body_avatar_after"])) { $_viewtopic_body_avatar_after_ = $context["viewtopic_body_avatar_after"]; } else { $_viewtopic_body_avatar_after_ = null; }
            // line 139
            echo "\t\t\t\t</div>
\t\t\t\t";
            // line 140
            if (isset($context["viewtopic_body_post_author_before"])) { $_viewtopic_body_post_author_before_ = $context["viewtopic_body_post_author_before"]; } else { $_viewtopic_body_post_author_before_ = null; }
            // line 141
            echo "\t\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ((!$this->getAttribute($_postrow_, "U_POST_AUTHOR"))) {
                echo "<strong>";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL");
                echo "</strong>";
            } else {
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL");
            }
            // line 142
            echo "\t\t\t\t";
            if (isset($context["viewtopic_body_post_author_after"])) { $_viewtopic_body_post_author_after_ = $context["viewtopic_body_post_author_after"]; } else { $_viewtopic_body_post_author_after_ = null; }
            // line 143
            echo "\t\t\t</dt>

\t\t\t";
            // line 145
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "RANK_TITLE") || $this->getAttribute($_postrow_, "RANK_IMG"))) {
                echo "<dd class=\"profile-rank\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "RANK_TITLE");
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "RANK_TITLE") && $this->getAttribute($_postrow_, "RANK_IMG"))) {
                    echo "<br />";
                }
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "RANK_IMG");
                echo "</dd>";
            }
            // line 146
            echo "
\t\t";
            // line 147
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "POSTER_POSTS") != "")) {
                echo "<dd class=\"profile-posts\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POSTS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "U_SEARCH") !== "")) {
                    echo "<a href=\"";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "U_SEARCH");
                    echo "\">";
                }
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_POSTS");
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (($this->getAttribute($_postrow_, "U_SEARCH") !== "")) {
                    echo "</a>";
                }
                echo "</dd>";
            }
            // line 148
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_JOINED")) {
                echo "<dd class=\"profile-joined\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("JOINED");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_JOINED");
                echo "</dd>";
            }
            // line 149
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POSTER_WARNINGS")) {
                echo "<dd class=\"profile-warnings\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("WARNINGS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POSTER_WARNINGS");
                echo "</dd>";
            }
            // line 150
            echo "
\t\t";
            // line 151
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_PROFILE_FIELD1")) {
                // line 152
                echo "\t\t\t<!-- Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
\t\t\t<dd><strong>";
                // line 153
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "PROFILE_FIELD1_NAME");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong> ";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "PROFILE_FIELD1_VALUE");
                echo "</dd>
\t\t";
            }
            // line 155
            echo "
\t\t";
            // line 156
            if (isset($context["viewtopic_body_postrow_custom_fields_before"])) { $_viewtopic_body_postrow_custom_fields_before_ = $context["viewtopic_body_postrow_custom_fields_before"]; } else { $_viewtopic_body_postrow_custom_fields_before_ = null; }
            // line 157
            echo "\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "custom_fields"));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_fields"]) {
                // line 158
                echo "\t\t\t";
                if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                if ((!$this->getAttribute($_custom_fields_, "S_PROFILE_CONTACT"))) {
                    // line 159
                    echo "\t\t\t\t<dd class=\"profile-custom-field profile-";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_IDENT");
                    echo "\"><strong>";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_NAME");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> ";
                    if (isset($context["custom_fields"])) { $_custom_fields_ = $context["custom_fields"]; } else { $_custom_fields_ = null; }
                    echo $this->getAttribute($_custom_fields_, "PROFILE_FIELD_VALUE");
                    echo "</dd>
\t\t\t";
                }
                // line 161
                echo "\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_fields'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 162
            echo "\t\t";
            if (isset($context["viewtopic_body_postrow_custom_fields_after"])) { $_viewtopic_body_postrow_custom_fields_after_ = $context["viewtopic_body_postrow_custom_fields_after"]; } else { $_viewtopic_body_postrow_custom_fields_after_ = null; }
            // line 163
            echo "
\t\t";
            // line 164
            if (isset($context["viewtopic_body_contact_fields_before"])) { $_viewtopic_body_contact_fields_before_ = $context["viewtopic_body_contact_fields_before"]; } else { $_viewtopic_body_contact_fields_before_ = null; }
            // line 165
            echo "\t\t";
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (((!$_S_IS_BOT_) && twig_length_filter($this->env, $this->getAttribute($_postrow_, "contact")))) {
                // line 166
                echo "\t\t\t<dd class=\"profile-contact\">
\t\t\t\t<strong>";
                // line 167
                echo $this->env->getExtension('phpbb')->lang("CONTACT");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</strong>
\t\t\t\t<div class=\"dropdown-container dropdown-left\">
\t\t\t\t\t<a href=\"#\" class=\"dropdown-trigger\"><span class=\"imageset icon_contact\" title=\"";
                // line 169
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "CONTACT_USER");
                echo "\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "CONTACT_USER");
                echo "</span></a>
\t\t\t\t\t<div class=\"dropdown hidden\">
\t\t\t\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t\t\t\t<div class=\"dropdown-contents contact-icons\">
\t\t\t\t\t\t\t";
                // line 173
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "contact"));
                foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
                    // line 174
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    $context["REMAINDER"] = ($this->getAttribute($_contact_, "S_ROW_COUNT") % 4);
                    // line 175
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["S_LAST_CELL"])) { $_S_LAST_CELL_ = $context["S_LAST_CELL"]; } else { $_S_LAST_CELL_ = null; }
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    $value = (($_REMAINDER_ == 3) || ($this->getAttribute($_contact_, "S_LAST_ROW") && ($this->getAttribute($_contact_, "S_NUM_ROWS") < 4)));
                    $context['definition']->set('S_LAST_CELL', $value);
                    // line 176
                    echo "\t\t\t\t\t\t\t\t";
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (($_REMAINDER_ == 0)) {
                        // line 177
                        echo "\t\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 179
                    echo "\t\t\t\t\t\t\t\t\t<a href=\"";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if ($this->getAttribute($_contact_, "U_CONTACT")) {
                        if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                        echo $this->getAttribute($_contact_, "U_CONTACT");
                    } else {
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_POST_AUTHOR");
                    }
                    echo "\" title=\"";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "NAME");
                    echo "\"";
                    if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                    if ($this->getAttribute($_definition_, "S_LAST_CELL")) {
                        echo " class=\"last-cell\"";
                    }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if (($this->getAttribute($_contact_, "ID") == "jabber")) {
                        echo " onclick=\"popup(this.href, 750, 320); return false;\"";
                    }
                    echo ">
\t\t\t\t\t\t\t\t\t\t<span class=\"contact-icon ";
                    // line 180
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "ID");
                    echo "-icon\">";
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    echo $this->getAttribute($_contact_, "NAME");
                    echo "</span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
                    // line 182
                    if (isset($context["REMAINDER"])) { $_REMAINDER_ = $context["REMAINDER"]; } else { $_REMAINDER_ = null; }
                    if (isset($context["contact"])) { $_contact_ = $context["contact"]; } else { $_contact_ = null; }
                    if ((($_REMAINDER_ == 3) || $this->getAttribute($_contact_, "S_LAST_ROW"))) {
                        // line 183
                        echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    // line 185
                    echo "\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 186
                echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</dd>
\t\t";
            }
            // line 191
            echo "\t\t";
            if (isset($context["viewtopic_body_contact_fields_after"])) { $_viewtopic_body_contact_fields_after_ = $context["viewtopic_body_contact_fields_after"]; } else { $_viewtopic_body_contact_fields_after_ = null; }
            // line 192
            echo "
\t\t</dl>

\t\t<div class=\"postbody\">
\t\t\t";
            // line 196
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN")) {
                // line 197
                echo "\t\t\t\t";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "S_POST_DELETED")) {
                    // line 198
                    echo "\t\t\t\t\t<div class=\"ignore\" id=\"post_hidden";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POST_ID");
                    echo "\">
\t\t\t\t\t\t";
                    // line 199
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DELETED_MESSAGE");
                    echo "<br />
\t\t\t\t\t\t";
                    // line 200
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DISPLAY");
                    echo "
\t\t\t\t\t</div>
\t\t\t\t";
                } elseif ($this->getAttribute($_postrow_, "S_IGNORE_POST")) {
                    // line 203
                    echo "\t\t\t\t\t<div class=\"ignore\" id=\"post_hidden";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "POST_ID");
                    echo "\">
\t\t\t\t\t\t";
                    // line 204
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_IGNORE_POST");
                    echo "<br />
\t\t\t\t\t\t";
                    // line 205
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "L_POST_DISPLAY");
                    echo "
\t\t\t\t\t</div>
\t\t\t\t";
                }
                // line 208
                echo "\t\t\t";
            }
            // line 209
            echo "\t\t\t<div id=\"post_content";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_HIDDEN")) {
                echo " style=\"display: none;\"";
            }
            echo ">

\t\t\t<h3 ";
            // line 211
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_FIRST_ROW")) {
                echo "class=\"first\"";
            }
            echo ">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "POST_ICON_IMG")) {
                echo "<img src=\"";
                if (isset($context["T_ICONS_PATH"])) { $_T_ICONS_PATH_ = $context["T_ICONS_PATH"]; } else { $_T_ICONS_PATH_ = null; }
                echo $_T_ICONS_PATH_;
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG");
                echo "\" width=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG_WIDTH");
                echo "\" height=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ICON_IMG_HEIGHT");
                echo "\" alt=\"\" /> ";
            }
            echo "<a href=\"#p";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_SUBJECT");
            echo "</a></h3>

\t\t";
            // line 213
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ((!$_S_IS_BOT_)) {
                // line 214
                echo "\t\t\t";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if (((((($this->getAttribute($_postrow_, "U_EDIT") || $this->getAttribute($_postrow_, "U_DELETE")) || $this->getAttribute($_postrow_, "U_REPORT")) || $this->getAttribute($_postrow_, "U_WARN")) || $this->getAttribute($_postrow_, "U_INFO")) || $this->getAttribute($_postrow_, "U_QUOTE"))) {
                    // line 215
                    echo "\t\t\t\t<ul class=\"post-buttons\">
\t\t\t\t\t";
                    // line 216
                    if (isset($context["viewtopic_body_post_buttons_before"])) { $_viewtopic_body_post_buttons_before_ = $context["viewtopic_body_post_buttons_before"]; } else { $_viewtopic_body_post_buttons_before_ = null; }
                    // line 217
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_EDIT")) {
                        // line 218
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 219
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_EDIT");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("EDIT_POST");
                        echo "\" class=\"button icon-button edit-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("BUTTON_EDIT");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 222
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_DELETE")) {
                        // line 223
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 224
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_DELETE");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("DELETE_POST");
                        echo "\" class=\"button icon-button delete-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("DELETE_POST");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 227
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_REPORT")) {
                        // line 228
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 229
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_REPORT");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("REPORT_POST");
                        echo "\" class=\"button icon-button report-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("REPORT_POST");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 232
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_WARN")) {
                        // line 233
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 234
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_WARN");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("WARN_USER");
                        echo "\" class=\"button icon-button warn-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("WARN_USER");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 237
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_INFO")) {
                        // line 238
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 239
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_INFO");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("INFORMATION");
                        echo "\" class=\"button icon-button info-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("INFORMATION");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 242
                    echo "\t\t\t\t\t";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    if ($this->getAttribute($_postrow_, "U_QUOTE")) {
                        // line 243
                        echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
                        // line 244
                        if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                        echo $this->getAttribute($_postrow_, "U_QUOTE");
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb')->lang("REPLY_WITH_QUOTE");
                        echo "\" class=\"button icon-button quote-icon\"><span>";
                        echo $this->env->getExtension('phpbb')->lang("QUOTE");
                        echo "</span></a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
                    }
                    // line 247
                    echo "\t\t\t\t\t";
                    if (isset($context["viewtopic_body_post_buttons_after"])) { $_viewtopic_body_post_buttons_after_ = $context["viewtopic_body_post_buttons_after"]; } else { $_viewtopic_body_post_buttons_after_ = null; }
                    // line 248
                    echo "\t\t\t\t</ul>
\t\t\t";
                }
                // line 250
                echo "\t\t";
            }
            // line 251
            echo "
\t\t\t";
            // line 252
            if (isset($context["viewtopic_body_postrow_post_details_before"])) { $_viewtopic_body_postrow_post_details_before_ = $context["viewtopic_body_postrow_post_details_before"]; } else { $_viewtopic_body_postrow_post_details_before_ = null; }
            // line 253
            echo "\t\t\t<p class=\"author\">";
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ($_S_IS_BOT_) {
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "MINI_POST_IMG");
            } else {
                echo "<a href=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MINI_POST");
                echo "\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "MINI_POST_IMG");
                echo "</a>";
            }
            echo "<span class=\"responsive-hide\">";
            echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
            echo " <strong>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL");
            echo "</strong> &raquo; </span>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_DATE");
            echo " </p>
\t\t\t";
            // line 254
            if (isset($context["viewtopic_body_postrow_post_details_after"])) { $_viewtopic_body_postrow_post_details_after_ = $context["viewtopic_body_postrow_post_details_after"]; } else { $_viewtopic_body_postrow_post_details_after_ = null; }
            // line 255
            echo "
\t\t\t";
            // line 256
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_UNAPPROVED")) {
                // line 257
                echo "\t\t\t<form method=\"post\" class=\"mcp_approve\" action=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_APPROVE_ACTION");
                echo "\">
\t\t\t\t<p class=\"post-notice unapproved\">
\t\t\t\t\t<strong>";
                // line 259
                echo $this->env->getExtension('phpbb')->lang("POST_UNAPPROVED_ACTION");
                echo "</strong>
\t\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                // line 260
                echo $this->env->getExtension('phpbb')->lang("DISAPPROVE");
                echo "\" name=\"action[disapprove]\" />
\t\t\t\t\t<input class=\"button1\" type=\"submit\" value=\"";
                // line 261
                echo $this->env->getExtension('phpbb')->lang("APPROVE");
                echo "\" name=\"action[approve]\" />
\t\t\t\t\t<input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 262
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID");
                echo "\" />
\t\t\t\t\t";
                // line 263
                if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
                echo $_S_FORM_TOKEN_;
                echo "
\t\t\t\t</p>
\t\t\t</form>
\t\t\t";
            } elseif ($this->getAttribute($_postrow_, "S_POST_DELETED")) {
                // line 267
                echo "\t\t\t<form method=\"post\" class=\"mcp_approve\" action=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_APPROVE_ACTION");
                echo "\">
\t\t\t\t<p class=\"post-notice deleted\">
\t\t\t\t\t<strong>";
                // line 269
                echo $this->env->getExtension('phpbb')->lang("POST_DELETED_ACTION");
                echo "</strong>
\t\t\t\t\t<input class=\"button2\" type=\"submit\" value=\"";
                // line 270
                echo $this->env->getExtension('phpbb')->lang("DELETE");
                echo "\" name=\"action[disapprove]\" />
\t\t\t\t\t<input class=\"button1\" type=\"submit\" value=\"";
                // line 271
                echo $this->env->getExtension('phpbb')->lang("RESTORE");
                echo "\" name=\"action[restore]\" />
\t\t\t\t\t<input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 272
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID");
                echo "\" />
\t\t\t\t\t";
                // line 273
                if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
                echo $_S_FORM_TOKEN_;
                echo "
\t\t\t\t</p>
\t\t\t</form>
\t\t\t";
            }
            // line 277
            echo "
\t\t\t";
            // line 278
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_REPORTED")) {
                // line 279
                echo "\t\t\t<p class=\"post-notice reported\">
\t\t\t\t<a href=\"";
                // line 280
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_REPORT");
                echo "\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POST_REPORTED");
                echo "</strong></a>
\t\t\t</p>
\t\t\t";
            }
            // line 283
            echo "
\t\t\t<div class=\"content\">";
            // line 284
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "MESSAGE");
            echo "</div>

\t\t\t";
            // line 286
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_HAS_ATTACHMENTS")) {
                // line 287
                echo "\t\t\t\t<dl class=\"attachbox\">
\t\t\t\t\t<dt>
\t\t\t\t\t\t";
                // line 289
                echo $this->env->getExtension('phpbb')->lang("ATTACHMENTS");
                echo "
\t\t\t\t\t</dt>
\t\t\t\t\t";
                // line 291
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "attachment"));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 292
                    echo "\t\t\t\t\t\t<dd>";
                    if (isset($context["attachment"])) { $_attachment_ = $context["attachment"]; } else { $_attachment_ = null; }
                    echo $this->getAttribute($_attachment_, "DISPLAY_ATTACHMENT");
                    echo "</dd>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 294
                echo "\t\t\t\t</dl>
\t\t\t";
            }
            // line 296
            echo "
\t\t\t";
            // line 297
            if (isset($context["viewtopic_body_postrow_post_notices_before"])) { $_viewtopic_body_postrow_post_notices_before_ = $context["viewtopic_body_postrow_post_notices_before"]; } else { $_viewtopic_body_postrow_post_notices_before_ = null; }
            // line 298
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_DISPLAY_NOTICE")) {
                echo "<div class=\"rules\">";
                echo $this->env->getExtension('phpbb')->lang("DOWNLOAD_NOTICE");
                echo "</div>";
            }
            // line 299
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "DELETED_MESSAGE") || $this->getAttribute($_postrow_, "DELETE_REASON"))) {
                // line 300
                echo "\t\t\t\t<div class=\"notice post_deleted_msg\">
\t\t\t\t\t";
                // line 301
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "DELETED_MESSAGE");
                echo "
\t\t\t\t\t";
                // line 302
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "DELETE_REASON")) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb')->lang("REASON");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> <em>";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "DELETE_REASON");
                    echo "</em>";
                }
                // line 303
                echo "\t\t\t\t</div>
\t\t\t";
            } elseif (($this->getAttribute($_postrow_, "EDITED_MESSAGE") || $this->getAttribute($_postrow_, "EDIT_REASON"))) {
                // line 305
                echo "\t\t\t\t<div class=\"notice\">
\t\t\t\t\t";
                // line 306
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "EDITED_MESSAGE");
                echo "
\t\t\t\t\t";
                // line 307
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                if ($this->getAttribute($_postrow_, "EDIT_REASON")) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb')->lang("REASON");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> <em>";
                    if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                    echo $this->getAttribute($_postrow_, "EDIT_REASON");
                    echo "</em>";
                }
                // line 308
                echo "\t\t\t\t</div>
\t\t\t";
            }
            // line 310
            echo "
\t\t\t";
            // line 311
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "BUMPED_MESSAGE")) {
                echo "<div class=\"notice\"><br /><br />";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "BUMPED_MESSAGE");
                echo "</div>";
            }
            // line 312
            echo "\t\t\t";
            if (isset($context["viewtopic_body_postrow_post_notices_after"])) { $_viewtopic_body_postrow_post_notices_after_ = $context["viewtopic_body_postrow_post_notices_after"]; } else { $_viewtopic_body_postrow_post_notices_after_ = null; }
            // line 313
            echo "\t\t\t";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "SIGNATURE")) {
                echo "<div id=\"sig";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "POST_ID");
                echo "\" class=\"signature\">";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "SIGNATURE");
                echo "</div>";
            }
            // line 314
            echo "
\t\t\t";
            // line 315
            if (isset($context["viewtopic_body_postrow_post_content_footer"])) { $_viewtopic_body_postrow_post_content_footer_ = $context["viewtopic_body_postrow_post_content_footer"]; } else { $_viewtopic_body_postrow_post_content_footer_ = null; }
            // line 316
            echo "\t\t\t</div>

\t\t</div>

\t\t<div class=\"back2top\"><a href=\"#top\" class=\"top\" title=\"";
            // line 320
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
            echo "</a></div>

\t\t</div>
\t</div>

\t<hr class=\"divider\" />
\t";
            // line 326
            if (isset($context["viewtopic_body_postrow_post_after"])) { $_viewtopic_body_postrow_post_after_ = $context["viewtopic_body_postrow_post_after"]; } else { $_viewtopic_body_postrow_post_after_ = null; }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['postrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 328
        echo "
";
        // line 329
        if (isset($context["S_QUICK_REPLY"])) { $_S_QUICK_REPLY_ = $context["S_QUICK_REPLY"]; } else { $_S_QUICK_REPLY_ = null; }
        if ($_S_QUICK_REPLY_) {
            // line 330
            echo "\t";
            $location = "quickreply_editor.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->env->loadTemplate("quickreply_editor.html")->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 332
        echo "
";
        // line 333
        if (isset($context["S_NUM_POSTS"])) { $_S_NUM_POSTS_ = $context["S_NUM_POSTS"]; } else { $_S_NUM_POSTS_ = null; }
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if ((($_S_NUM_POSTS_ > 1) || twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination")))) {
            // line 334
            echo "\t<form id=\"viewtopic\" method=\"post\" action=\"";
            if (isset($context["S_TOPIC_ACTION"])) { $_S_TOPIC_ACTION_ = $context["S_TOPIC_ACTION"]; } else { $_S_TOPIC_ACTION_ = null; }
            echo $_S_TOPIC_ACTION_;
            echo "\">
\t<fieldset class=\"display-options\" style=\"margin-top: 0; \">
\t\t";
            // line 336
            if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
            if ((!$_S_IS_BOT_)) {
                // line 337
                echo "\t\t<label>";
                echo $this->env->getExtension('phpbb')->lang("DISPLAY_POSTS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo " ";
                if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
                echo $_S_SELECT_SORT_DAYS_;
                echo "</label>
\t\t<label>";
                // line 338
                echo $this->env->getExtension('phpbb')->lang("SORT_BY");
                echo " ";
                if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
                echo $_S_SELECT_SORT_KEY_;
                echo "</label> <label>";
                if (isset($context["S_SELECT_SORT_DIR"])) { $_S_SELECT_SORT_DIR_ = $context["S_SELECT_SORT_DIR"]; } else { $_S_SELECT_SORT_DIR_ = null; }
                echo $_S_SELECT_SORT_DIR_;
                echo "</label>
\t\t<input type=\"submit\" name=\"sort\" value=\"";
                // line 339
                echo $this->env->getExtension('phpbb')->lang("GO");
                echo "\" class=\"button2\" />
\t\t";
            }
            // line 341
            echo "\t</fieldset>
\t</form>
\t<hr />
";
        }
        // line 345
        echo "
";
        // line 346
        if (isset($context["viewtopic_body_topic_actions_before"])) { $_viewtopic_body_topic_actions_before_ = $context["viewtopic_body_topic_actions_before"]; } else { $_viewtopic_body_topic_actions_before_ = null; }
        // line 347
        echo "<div class=\"action-bar bottom\">
\t<div class=\"buttons\">
\t\t";
        // line 349
        if (isset($context["viewtopic_buttons_bottom_before"])) { $_viewtopic_buttons_bottom_before_ = $context["viewtopic_buttons_bottom_before"]; } else { $_viewtopic_buttons_bottom_before_ = null; }
        // line 350
        echo "
\t";
        // line 351
        if (isset($context["S_IS_BOT"])) { $_S_IS_BOT_ = $context["S_IS_BOT"]; } else { $_S_IS_BOT_ = null; }
        if (isset($context["S_DISPLAY_REPLY_INFO"])) { $_S_DISPLAY_REPLY_INFO_ = $context["S_DISPLAY_REPLY_INFO"]; } else { $_S_DISPLAY_REPLY_INFO_ = null; }
        if (((!$_S_IS_BOT_) && $_S_DISPLAY_REPLY_INFO_)) {
            // line 352
            echo "\t\t<a href=\"";
            if (isset($context["U_POST_REPLY_TOPIC"])) { $_U_POST_REPLY_TOPIC_ = $context["U_POST_REPLY_TOPIC"]; } else { $_U_POST_REPLY_TOPIC_ = null; }
            echo $_U_POST_REPLY_TOPIC_;
            echo "\" class=\"button icon-button ";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo "locked-icon";
            } else {
                echo "reply-icon";
            }
            echo "\" title=\"";
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("POST_REPLY");
            }
            echo "\">
\t\t\t";
            // line 353
            if (isset($context["S_IS_LOCKED"])) { $_S_IS_LOCKED_ = $context["S_IS_LOCKED"]; } else { $_S_IS_LOCKED_ = null; }
            if ($_S_IS_LOCKED_) {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb')->lang("BUTTON_POST_REPLY");
            }
            // line 354
            echo "\t\t</a>
\t";
        }
        // line 356
        echo "
\t\t";
        // line 357
        if (isset($context["viewtopic_buttons_bottom_after"])) { $_viewtopic_buttons_bottom_after_ = $context["viewtopic_buttons_bottom_after"]; } else { $_viewtopic_buttons_bottom_after_ = null; }
        // line 358
        echo "\t</div>

\t";
        // line 360
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("viewtopic_topic_tools.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 361
        echo "
\t";
        // line 362
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "quickmod"))) {
            // line 363
            echo "\t\t<div class=\"dropdown-container dropdown-container-";
            if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
            echo $_S_CONTENT_FLOW_BEGIN_;
            echo " dropdown-up dropdown-";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo " dropdown-button-control\" id=\"quickmod\">
\t\t\t<span title=\"";
            // line 364
            echo $this->env->getExtension('phpbb')->lang("QUICK_MOD");
            echo "\" class=\"dropdown-trigger button icon-button modtools-icon dropdown-select\">";
            echo $this->env->getExtension('phpbb')->lang("QUICK_MOD");
            echo "</span>
\t\t\t<div class=\"dropdown hidden\">
\t\t\t\t<div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
\t\t\t\t<ul class=\"dropdown-contents\">
\t\t\t\t";
            // line 368
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "quickmod"));
            foreach ($context['_seq'] as $context["_key"] => $context["quickmod"]) {
                // line 369
                echo "\t\t\t\t\t";
                if (isset($context["QUICKMOD_AJAX"])) { $_QUICKMOD_AJAX_ = $context["QUICKMOD_AJAX"]; } else { $_QUICKMOD_AJAX_ = null; }
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                $value = twig_in_filter($this->getAttribute($_quickmod_, "VALUE"), array(0 => "lock", 1 => "unlock", 2 => "delete_topic", 3 => "restore_topic", 4 => "make_normal", 5 => "make_sticky", 6 => "make_announce", 7 => "make_global"));
                $context['definition']->set('QUICKMOD_AJAX', $value);
                // line 370
                echo "\t\t\t\t\t<li><a href=\"";
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                echo $this->getAttribute($_quickmod_, "LINK");
                echo "\"";
                if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
                if ($this->getAttribute($_definition_, "QUICKMOD_AJAX")) {
                    echo " data-ajax=\"true\" data-refresh=\"true\"";
                }
                echo ">";
                if (isset($context["quickmod"])) { $_quickmod_ = $context["quickmod"]; } else { $_quickmod_ = null; }
                echo $this->getAttribute($_quickmod_, "TITLE");
                echo "</a></li>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quickmod'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 372
            echo "\t\t\t\t</ul>
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 376
        echo "
\t";
        // line 377
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        if ((twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination")) || $_TOTAL_POSTS_)) {
            // line 378
            echo "\t\t<div class=\"pagination\">
\t\t\t";
            // line 379
            if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
            echo $_TOTAL_POSTS_;
            echo "
\t\t\t";
            // line 380
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
                // line 381
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
                // line 382
                echo "\t\t\t";
            } else {
                // line 383
                echo "\t\t\t\t&bull; ";
                if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
                echo $_PAGE_NUMBER_;
                echo "
\t\t\t";
            }
            // line 385
            echo "\t\t</div>
\t";
        }
        // line 387
        echo "\t<div class=\"clear\"></div>
</div>

";
        // line 390
        if (isset($context["viewtopic_body_footer_before"])) { $_viewtopic_body_footer_before_ = $context["viewtopic_body_footer_before"]; } else { $_viewtopic_body_footer_before_ = null; }
        // line 391
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
        // line 392
        echo "
";
        // line 393
        if (isset($context["S_DISPLAY_ONLINE_LIST"])) { $_S_DISPLAY_ONLINE_LIST_ = $context["S_DISPLAY_ONLINE_LIST"]; } else { $_S_DISPLAY_ONLINE_LIST_ = null; }
        if ($_S_DISPLAY_ONLINE_LIST_) {
            // line 394
            echo "\t<div class=\"stat-block online-list\">
\t\t<h3>";
            // line 395
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
            // line 396
            if (isset($context["LOGGED_IN_USER_LIST"])) { $_LOGGED_IN_USER_LIST_ = $context["LOGGED_IN_USER_LIST"]; } else { $_LOGGED_IN_USER_LIST_ = null; }
            echo $_LOGGED_IN_USER_LIST_;
            echo "</p>
\t</div>
";
        }
        // line 399
        echo "
";
        // line 400
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
        return "viewtopic_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1710 => 400,  1707 => 399,  1700 => 396,  1686 => 395,  1683 => 394,  1680 => 393,  1677 => 392,  1665 => 391,  1663 => 390,  1658 => 387,  1654 => 385,  1647 => 383,  1644 => 382,  1631 => 381,  1628 => 380,  1623 => 379,  1620 => 378,  1616 => 377,  1613 => 376,  1607 => 372,  1589 => 370,  1583 => 369,  1578 => 368,  1569 => 364,  1560 => 363,  1557 => 362,  1554 => 361,  1542 => 360,  1538 => 358,  1536 => 357,  1533 => 356,  1529 => 354,  1522 => 353,  1502 => 352,  1498 => 351,  1495 => 350,  1493 => 349,  1489 => 347,  1487 => 346,  1484 => 345,  1478 => 341,  1473 => 339,  1463 => 338,  1454 => 337,  1451 => 336,  1444 => 334,  1440 => 333,  1437 => 332,  1423 => 330,  1420 => 329,  1417 => 328,  1411 => 326,  1400 => 320,  1394 => 316,  1392 => 315,  1389 => 314,  1377 => 313,  1374 => 312,  1366 => 311,  1363 => 310,  1359 => 308,  1348 => 307,  1343 => 306,  1340 => 305,  1336 => 303,  1325 => 302,  1320 => 301,  1317 => 300,  1313 => 299,  1305 => 298,  1303 => 297,  1300 => 296,  1296 => 294,  1286 => 292,  1281 => 291,  1276 => 289,  1272 => 287,  1269 => 286,  1263 => 284,  1260 => 283,  1251 => 280,  1248 => 279,  1245 => 278,  1242 => 277,  1234 => 273,  1229 => 272,  1225 => 271,  1221 => 270,  1217 => 269,  1210 => 267,  1202 => 263,  1197 => 262,  1193 => 261,  1189 => 260,  1185 => 259,  1178 => 257,  1175 => 256,  1172 => 255,  1170 => 254,  1145 => 253,  1143 => 252,  1140 => 251,  1137 => 250,  1133 => 248,  1130 => 247,  1119 => 244,  1116 => 243,  1112 => 242,  1101 => 239,  1098 => 238,  1094 => 237,  1083 => 234,  1080 => 233,  1076 => 232,  1065 => 229,  1062 => 228,  1058 => 227,  1047 => 224,  1044 => 223,  1040 => 222,  1029 => 219,  1026 => 218,  1022 => 217,  1020 => 216,  1017 => 215,  1013 => 214,  1010 => 213,  980 => 211,  968 => 209,  965 => 208,  958 => 205,  953 => 204,  947 => 203,  940 => 200,  935 => 199,  929 => 198,  925 => 197,  922 => 196,  916 => 192,  913 => 191,  906 => 186,  900 => 185,  896 => 183,  892 => 182,  883 => 180,  859 => 179,  855 => 177,  851 => 176,  844 => 175,  840 => 174,  835 => 173,  824 => 169,  818 => 167,  815 => 166,  810 => 165,  808 => 164,  805 => 163,  802 => 162,  796 => 161,  782 => 159,  778 => 158,  772 => 157,  770 => 156,  767 => 155,  757 => 153,  754 => 152,  751 => 151,  748 => 150,  736 => 149,  724 => 148,  702 => 147,  699 => 146,  685 => 145,  681 => 143,  678 => 142,  666 => 141,  664 => 140,  661 => 139,  658 => 138,  655 => 137,  638 => 136,  634 => 135,  632 => 134,  615 => 132,  605 => 131,  570 => 128,  558 => 126,  554 => 125,  551 => 124,  546 => 123,  543 => 122,  533 => 116,  528 => 115,  521 => 111,  518 => 110,  509 => 107,  505 => 105,  502 => 104,  499 => 103,  493 => 100,  489 => 98,  486 => 97,  476 => 94,  468 => 92,  465 => 91,  459 => 90,  457 => 89,  441 => 87,  414 => 86,  380 => 85,  364 => 84,  342 => 83,  339 => 82,  334 => 81,  317 => 78,  310 => 77,  299 => 71,  296 => 70,  292 => 68,  289 => 67,  285 => 65,  278 => 63,  275 => 62,  262 => 61,  259 => 60,  244 => 59,  241 => 58,  237 => 57,  234 => 56,  225 => 51,  216 => 50,  210 => 49,  206 => 48,  200 => 46,  197 => 45,  194 => 44,  191 => 43,  179 => 42,  175 => 40,  173 => 39,  170 => 38,  166 => 36,  159 => 35,  139 => 34,  135 => 33,  132 => 32,  130 => 31,  124 => 27,  118 => 23,  112 => 21,  107 => 20,  98 => 18,  95 => 17,  85 => 14,  82 => 13,  79 => 12,  64 => 9,  61 => 8,  58 => 7,  55 => 6,  47 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }
}
