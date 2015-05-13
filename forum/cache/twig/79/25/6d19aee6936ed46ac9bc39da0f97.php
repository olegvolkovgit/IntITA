<?php

/* mcp_topic.html */
class __TwigTemplate_79256d19aee6936ed46ac9bc39da0f97 extends Twig_Template
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
        $location = "mcp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("mcp_header.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<div class=\"tabs-container\">
<h2><a href=\"";
        // line 4
        if (isset($context["U_VIEW_TOPIC"])) { $_U_VIEW_TOPIC_ = $context["U_VIEW_TOPIC"]; } else { $_U_VIEW_TOPIC_ = null; }
        echo $_U_VIEW_TOPIC_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("TOPIC");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " ";
        if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
        echo $_TOPIC_TITLE_;
        echo "</a></h2>

";
        // line 6
        if (isset($context["S_MERGE_VIEW"])) { $_S_MERGE_VIEW_ = $context["S_MERGE_VIEW"]; } else { $_S_MERGE_VIEW_ = null; }
        if (isset($context["S_SPLIT_VIEW"])) { $_S_SPLIT_VIEW_ = $context["S_SPLIT_VIEW"]; } else { $_S_SPLIT_VIEW_ = null; }
        if ($_S_MERGE_VIEW_) {
            // line 7
            echo "\t";
            if (isset($context["SHOW_PANEL"])) { $_SHOW_PANEL_ = $context["SHOW_PANEL"]; } else { $_SHOW_PANEL_ = null; }
            $value = "merge-panel";
            $context['definition']->set('SHOW_PANEL', $value);
        } elseif ($_S_SPLIT_VIEW_) {
            // line 9
            echo "\t";
            if (isset($context["SHOW_PANEL"])) { $_SHOW_PANEL_ = $context["SHOW_PANEL"]; } else { $_SHOW_PANEL_ = null; }
            $value = "split-panel";
            $context['definition']->set('SHOW_PANEL', $value);
        } else {
            // line 11
            echo "\t";
            if (isset($context["SHOW_PANEL"])) { $_SHOW_PANEL_ = $context["SHOW_PANEL"]; } else { $_SHOW_PANEL_ = null; }
            $value = "display-panel";
            $context['definition']->set('SHOW_PANEL', $value);
        }
        // line 13
        echo "
<div id=\"minitabs\" class=\"sub-panels\" data-show-panel=\"";
        // line 14
        if (isset($context["definition"])) { $_definition_ = $context["definition"]; } else { $_definition_ = null; }
        echo $this->getAttribute($_definition_, "SHOW_PANEL");
        echo "\" role=\"tablist\">
\t<ul>
\t\t<li id=\"display-panel-tab\" class=\"tab";
        // line 16
        if (isset($context["S_MERGE_VIEW"])) { $_S_MERGE_VIEW_ = $context["S_MERGE_VIEW"]; } else { $_S_MERGE_VIEW_ = null; }
        if ((!$_S_MERGE_VIEW_)) {
            echo " activetab";
        }
        echo "\">
\t\t\t<a href=\"#minitabs\" data-subpanel=\"display-panel\" role=\"tab\" aria-controls=\"display-panel\">";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("DISPLAY_OPTIONS");
        echo "</a>
\t\t</li>
\t\t<li id=\"split-panel-tab\" class=\"tab\">
\t\t\t<a href=\"#minitabs\" data-subpanel=\"split-panel\" role=\"tab\" aria-controls=\"split-panel\">";
        // line 20
        echo $this->env->getExtension('phpbb')->lang("SPLIT_TOPIC");
        echo "</a>
\t\t</li>
\t\t<li id=\"merge-panel-tab\" class=\"tab";
        // line 22
        if (isset($context["S_MERGE_VIEW"])) { $_S_MERGE_VIEW_ = $context["S_MERGE_VIEW"]; } else { $_S_MERGE_VIEW_ = null; }
        if ($_S_MERGE_VIEW_) {
            echo " activetab";
        }
        echo "\">
\t\t\t<a href=\"#minitabs\" data-subpanel=\"merge-panel\" role=\"tab\" aria-controls=\"merge-panel\">";
        // line 23
        echo $this->env->getExtension('phpbb')->lang("MERGE_POSTS");
        echo "</a>
\t\t</li>
\t</ul>
</div>
</div>

<form id=\"mcp\" method=\"post\" action=\"";
        // line 29
        if (isset($context["S_MCP_ACTION"])) { $_S_MCP_ACTION_ = $context["S_MCP_ACTION"]; } else { $_S_MCP_ACTION_ = null; }
        echo $_S_MCP_ACTION_;
        echo "\">

<div class=\"panel\">
\t<div class=\"inner\">

\t<fieldset id=\"display-panel\" class=\"fields2\" role=\"tabpanel\">
\t<dl>
\t\t<dt><label for=\"posts_per_page\">";
        // line 36
        echo $this->env->getExtension('phpbb')->lang("POSTS_PER_PAGE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("POSTS_PER_PAGE_EXPLAIN");
        echo "</span></dt>
\t\t<dd><input class=\"inputbox autowidth\" type=\"number\" min=\"0\" name=\"posts_per_page\" id=\"posts_per_page\" size=\"6\" value=\"";
        // line 37
        if (isset($context["POSTS_PER_PAGE"])) { $_POSTS_PER_PAGE_ = $context["POSTS_PER_PAGE"]; } else { $_POSTS_PER_PAGE_ = null; }
        echo $_POSTS_PER_PAGE_;
        echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
        // line 40
        echo $this->env->getExtension('phpbb')->lang("DISPLAY_POSTS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t<dd>";
        // line 41
        if (isset($context["S_SELECT_SORT_DAYS"])) { $_S_SELECT_SORT_DAYS_ = $context["S_SELECT_SORT_DAYS"]; } else { $_S_SELECT_SORT_DAYS_ = null; }
        echo $_S_SELECT_SORT_DAYS_;
        echo "&nbsp;&nbsp;<label>";
        echo $this->env->getExtension('phpbb')->lang("SORT_BY");
        echo " ";
        if (isset($context["S_SELECT_SORT_KEY"])) { $_S_SELECT_SORT_KEY_ = $context["S_SELECT_SORT_KEY"]; } else { $_S_SELECT_SORT_KEY_ = null; }
        echo $_S_SELECT_SORT_KEY_;
        echo "</label><label>";
        if (isset($context["S_SELECT_SORT_DIR"])) { $_S_SELECT_SORT_DIR_ = $context["S_SELECT_SORT_DIR"]; } else { $_S_SELECT_SORT_DIR_ = null; }
        echo $_S_SELECT_SORT_DIR_;
        echo "</label> <input type=\"submit\" name=\"sort\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("GO");
        echo "\" class=\"button2\" /></dd>
\t</dl>
\t</fieldset>

";
        // line 45
        if (isset($context["S_CAN_SPLIT"])) { $_S_CAN_SPLIT_ = $context["S_CAN_SPLIT"]; } else { $_S_CAN_SPLIT_ = null; }
        if ($_S_CAN_SPLIT_) {
            // line 46
            echo "\t<fieldset id=\"split-panel\" class=\"fields2\" role=\"tabpanel\">
\t\t<p>";
            // line 47
            echo $this->env->getExtension('phpbb')->lang("SPLIT_TOPIC_EXPLAIN");
            echo "</p>

\t";
            // line 49
            if (isset($context["S_SHOW_TOPIC_ICONS"])) { $_S_SHOW_TOPIC_ICONS_ = $context["S_SHOW_TOPIC_ICONS"]; } else { $_S_SHOW_TOPIC_ICONS_ = null; }
            if ($_S_SHOW_TOPIC_ICONS_) {
                // line 50
                echo "\t\t<dl>
\t\t\t<dt><label for=\"icon\">";
                // line 51
                echo $this->env->getExtension('phpbb')->lang("TOPIC_ICON");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label for=\"icon\"><input type=\"radio\" name=\"icon\" id=\"icon\" value=\"0\" checked=\"checked\" /> ";
                // line 52
                echo $this->env->getExtension('phpbb')->lang("NO_TOPIC_ICON");
                echo "</label>
\t\t\t";
                // line 53
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "topic_icon"));
                foreach ($context['_seq'] as $context["_key"] => $context["topic_icon"]) {
                    echo "<label for=\"icon-";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_ID");
                    echo "\"><input type=\"radio\" name=\"icon\" id=\"icon-";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_ID");
                    echo "\" value=\"";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_ID");
                    echo "\" ";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "S_ICON_CHECKED");
                    echo " /><img src=\"";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_IMG");
                    echo "\" width=\"";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_WIDTH");
                    echo "\" height=\"";
                    if (isset($context["topic_icon"])) { $_topic_icon_ = $context["topic_icon"]; } else { $_topic_icon_ = null; }
                    echo $this->getAttribute($_topic_icon_, "ICON_HEIGHT");
                    echo "\" alt=\"\" title=\"\" /></label> ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topic_icon'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "</dd>
\t\t</dl>
\t";
            }
            // line 56
            echo "
\t<dl>
\t\t<dt><label for=\"subject\">";
            // line 58
            echo $this->env->getExtension('phpbb')->lang("SPLIT_SUBJECT");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" name=\"subject\" id=\"subject\" size=\"45\" maxlength=\"124\" tabindex=\"2\" value=\"";
            // line 59
            if (isset($context["SPLIT_SUBJECT"])) { $_SPLIT_SUBJECT_ = $context["SPLIT_SUBJECT"]; } else { $_SPLIT_SUBJECT_ = null; }
            echo $_SPLIT_SUBJECT_;
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SPLIT_SUBJECT");
            echo "\" class=\"inputbox\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
            // line 62
            echo $this->env->getExtension('phpbb')->lang("SPLIT_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><select name=\"to_forum_id\">";
            // line 63
            if (isset($context["S_FORUM_SELECT"])) { $_S_FORUM_SELECT_ = $context["S_FORUM_SELECT"]; } else { $_S_FORUM_SELECT_ = null; }
            echo $_S_FORUM_SELECT_;
            echo "</select></dd>
\t</dl>
\t</fieldset>
";
        }
        // line 67
        echo "
";
        // line 68
        if (isset($context["S_CAN_MERGE"])) { $_S_CAN_MERGE_ = $context["S_CAN_MERGE"]; } else { $_S_CAN_MERGE_ = null; }
        if ($_S_CAN_MERGE_) {
            // line 69
            echo "\t<fieldset id=\"merge-panel\" class=\"fields2\" role=\"tabpanel\">
\t\t<p>";
            // line 70
            echo $this->env->getExtension('phpbb')->lang("MERGE_TOPIC_EXPLAIN");
            echo "</p>
\t<dl>
\t\t<dt><label for=\"to_topic_id\">";
            // line 72
            echo $this->env->getExtension('phpbb')->lang("MERGE_TOPIC_ID");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd>
\t\t\t<input class=\"inputbox autowidth\" type=\"number\" min=\"0\" size=\"6\" name=\"to_topic_id\" id=\"to_topic_id\" value=\"";
            // line 74
            if (isset($context["TO_TOPIC_ID"])) { $_TO_TOPIC_ID_ = $context["TO_TOPIC_ID"]; } else { $_TO_TOPIC_ID_ = null; }
            echo $_TO_TOPIC_ID_;
            echo "\" />
\t\t\t<a href=\"";
            // line 75
            if (isset($context["U_SELECT_TOPIC"])) { $_U_SELECT_TOPIC_ = $context["U_SELECT_TOPIC"]; } else { $_U_SELECT_TOPIC_ = null; }
            echo $_U_SELECT_TOPIC_;
            echo "\" >";
            echo $this->env->getExtension('phpbb')->lang("SELECT_TOPIC");
            echo "</a>
\t\t</dd>
\t\t";
            // line 77
            if (isset($context["TO_TOPIC_INFO"])) { $_TO_TOPIC_INFO_ = $context["TO_TOPIC_INFO"]; } else { $_TO_TOPIC_INFO_ = null; }
            if ($_TO_TOPIC_INFO_) {
                echo "<dd>";
                if (isset($context["TO_TOPIC_INFO"])) { $_TO_TOPIC_INFO_ = $context["TO_TOPIC_INFO"]; } else { $_TO_TOPIC_INFO_ = null; }
                echo $_TO_TOPIC_INFO_;
                echo "</dd>";
            }
            // line 78
            echo "\t</dl>
\t</fieldset>
";
        }
        // line 81
        echo "
\t</div>
</div>

<div class=\"panel\">
\t<div class=\"inner\">

\t<h3 id=\"review\">
\t\t<span class=\"right-box\"><a href=\"#review\" onclick=\"viewableArea(getElementById('topicreview'), true); var rev_text = getElementById('review').getElementsByTagName('a').item(0).firstChild; if (rev_text.data == '";
        // line 89
        echo addslashes($this->env->getExtension('phpbb')->lang("EXPAND_VIEW"));
        echo "'){rev_text.data = '";
        echo addslashes($this->env->getExtension('phpbb')->lang("COLLAPSE_VIEW"));
        echo "'; } else if (rev_text.data == '";
        echo addslashes($this->env->getExtension('phpbb')->lang("COLLAPSE_VIEW"));
        echo "'){rev_text.data = '";
        echo addslashes($this->env->getExtension('phpbb')->lang("EXPAND_VIEW"));
        echo "'};\">";
        echo $this->env->getExtension('phpbb')->lang("EXPAND_VIEW");
        echo "</a></span>
\t\t";
        // line 90
        echo $this->env->getExtension('phpbb')->lang("TOPIC_REVIEW");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " ";
        if (isset($context["TOPIC_TITLE"])) { $_TOPIC_TITLE_ = $context["TOPIC_TITLE"]; } else { $_TOPIC_TITLE_ = null; }
        echo $_TOPIC_TITLE_;
        echo "
\t</h3>

\t<div id=\"topicreview\">
\t\t";
        // line 94
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "postrow"));
        foreach ($context['_seq'] as $context["_key"] => $context["postrow"]) {
            // line 95
            echo "\t\t<div class=\"post ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if (($this->getAttribute($_postrow_, "S_ROW_COUNT") % 2 == 1)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            echo "\">
\t\t\t<div class=\"inner\">

\t\t\t<div class=\"postbody\" id=\"pr";
            // line 98
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\">
\t\t\t\t<ul class=\"post-buttons\">
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 101
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "U_POST_DETAILS");
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("POST_DETAILS");
            echo "\" class=\"button icon-button info-icon\">
\t\t\t\t\t\t\t<span>";
            // line 102
            echo $this->env->getExtension('phpbb')->lang("POST_DETAILS");
            echo "</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<label for=\"post_id_list_select_";
            // line 106
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SELECT");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "
\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"post_id_list_select_";
            // line 107
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\" name=\"post_id_list[]\" value=\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\"";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_CHECKED")) {
                echo " checked=\"checked\"";
            }
            echo " />
\t\t\t\t\t\t</label>
\t\t\t\t\t</li>
\t\t\t\t</ul>

\t\t\t\t<h3><a href=\"";
            // line 112
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "U_POST_DETAILS");
            echo "\">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_SUBJECT");
            echo "</a></h3>
\t\t\t\t<p class=\"author\"><a href=\"#pr";
            // line 113
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "MINI_POST_IMG");
            echo "</a> ";
            echo $this->env->getExtension('phpbb')->lang("POSTED");
            echo " ";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_DATE");
            echo " ";
            echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
            echo " <strong>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_AUTHOR_FULL");
            echo "</strong>";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "U_MCP_DETAILS")) {
                echo " [ <a href=\"";
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_DETAILS");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("POST_DETAILS");
                echo "</a> ]";
            }
            echo "</p>

\t\t\t\t";
            // line 115
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_UNAPPROVED")) {
                // line 116
                echo "\t\t\t\t<p class=\"post-notice unapproved\">
\t\t\t\t\t<a href=\"";
                // line 117
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_APPROVE");
                echo "\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POST_UNAPPROVED");
                echo "</strong></a>
\t\t\t\t</p>
\t\t\t\t";
            }
            // line 120
            echo "
\t\t\t\t";
            // line 121
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_DELETED")) {
                // line 122
                echo "\t\t\t\t<p class=\"post-notice deleted\">
\t\t\t\t\t<a href=\"";
                // line 123
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_APPROVE");
                echo "\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POST_DELETED");
                echo "</strong></a>
\t\t\t\t</p>
\t\t\t\t";
            }
            // line 126
            echo "
\t\t\t\t";
            // line 127
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_POST_REPORTED")) {
                // line 128
                echo "\t\t\t\t<p class=\"post-notice reported\">
\t\t\t\t\t<a href=\"";
                // line 129
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                echo $this->getAttribute($_postrow_, "U_MCP_REPORT");
                echo "\"><strong>";
                echo $this->env->getExtension('phpbb')->lang("POST_REPORTED");
                echo "</strong></a>
\t\t\t\t</p>
\t\t\t\t";
            }
            // line 132
            echo "
\t\t\t\t<div class=\"content\" id=\"message_";
            // line 133
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "POST_ID");
            echo "\">";
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            echo $this->getAttribute($_postrow_, "MESSAGE");
            echo "</div>

\t\t\t\t";
            // line 135
            if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
            if ($this->getAttribute($_postrow_, "S_HAS_ATTACHMENTS")) {
                // line 136
                echo "\t\t\t\t\t<dl class=\"attachbox\">
\t\t\t\t\t\t<dt>";
                // line 137
                echo $this->env->getExtension('phpbb')->lang("ATTACHMENTS");
                echo "</dt>
\t\t\t\t\t\t";
                // line 138
                if (isset($context["postrow"])) { $_postrow_ = $context["postrow"]; } else { $_postrow_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_postrow_, "attachment"));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 139
                    echo "\t\t\t\t\t\t\t<dd>";
                    if (isset($context["attachment"])) { $_attachment_ = $context["attachment"]; } else { $_attachment_ = null; }
                    echo $this->getAttribute($_attachment_, "DISPLAY_ATTACHMENT");
                    echo "</dd>
\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 141
                echo "\t\t\t\t\t</dl>
\t\t\t\t";
            }
            // line 143
            echo "
\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['postrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 149
        echo "\t</div>

\t<hr />

\t<div class=\"action-bar bottom\">
\t\t<div class=\"pagination\">
\t\t\t";
        // line 155
        if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
        echo $_TOTAL_POSTS_;
        echo "
\t\t\t";
        // line 156
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
            echo " 
\t\t\t\t";
            // line 157
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
            // line 158
            echo "\t\t\t";
        } else {
            echo " 
\t\t\t\t &bull; ";
            // line 159
            if (isset($context["PAGE_NUMBER"])) { $_PAGE_NUMBER_ = $context["PAGE_NUMBER"]; } else { $_PAGE_NUMBER_ = null; }
            echo $_PAGE_NUMBER_;
            echo "
\t\t\t";
        }
        // line 161
        echo "\t\t</div>
\t</div>

\t</div>
</div>

<fieldset class=\"display-actions\">
\t<select name=\"action\">
\t\t<option value=\"\" selected=\"selected\">";
        // line 169
        echo $this->env->getExtension('phpbb')->lang("SELECT_ACTION");
        echo "</option>
\t\t";
        // line 170
        if (isset($context["S_CAN_APPROVE"])) { $_S_CAN_APPROVE_ = $context["S_CAN_APPROVE"]; } else { $_S_CAN_APPROVE_ = null; }
        if ($_S_CAN_APPROVE_) {
            echo "<option value=\"approve\">";
            echo $this->env->getExtension('phpbb')->lang("APPROVE_POSTS");
            echo "</option>";
        }
        // line 171
        echo "\t\t";
        if (isset($context["S_CAN_LOCK"])) { $_S_CAN_LOCK_ = $context["S_CAN_LOCK"]; } else { $_S_CAN_LOCK_ = null; }
        if ($_S_CAN_LOCK_) {
            echo "<option value=\"lock_post\">";
            echo $this->env->getExtension('phpbb')->lang("LOCK_POST_POSTS");
            echo " [ ";
            echo $this->env->getExtension('phpbb')->lang("LOCK_POST_EXPLAIN");
            echo " ]</option><option value=\"unlock_post\">";
            echo $this->env->getExtension('phpbb')->lang("UNLOCK_POST_POSTS");
            echo "</option>";
        }
        // line 172
        echo "\t\t";
        if (isset($context["S_CAN_DELETE"])) { $_S_CAN_DELETE_ = $context["S_CAN_DELETE"]; } else { $_S_CAN_DELETE_ = null; }
        if ($_S_CAN_DELETE_) {
            echo "<option value=\"delete_post\">";
            echo $this->env->getExtension('phpbb')->lang("DELETE_POSTS");
            echo "</option>";
        }
        // line 173
        echo "\t\t";
        if (isset($context["S_CAN_RESTORE"])) { $_S_CAN_RESTORE_ = $context["S_CAN_RESTORE"]; } else { $_S_CAN_RESTORE_ = null; }
        if ($_S_CAN_RESTORE_) {
            echo "<option value=\"restore\">";
            echo $this->env->getExtension('phpbb')->lang("RESTORE_POSTS");
            echo "</option>";
        }
        // line 174
        echo "\t\t";
        if (isset($context["S_CAN_MERGE"])) { $_S_CAN_MERGE_ = $context["S_CAN_MERGE"]; } else { $_S_CAN_MERGE_ = null; }
        if ($_S_CAN_MERGE_) {
            echo "<option value=\"merge_posts\"";
            if (isset($context["S_MERGE_VIEW"])) { $_S_MERGE_VIEW_ = $context["S_MERGE_VIEW"]; } else { $_S_MERGE_VIEW_ = null; }
            if ($_S_MERGE_VIEW_) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->env->getExtension('phpbb')->lang("MERGE_POSTS");
            echo "</option>";
        }
        // line 175
        echo "\t\t";
        if (isset($context["S_CAN_SPLIT"])) { $_S_CAN_SPLIT_ = $context["S_CAN_SPLIT"]; } else { $_S_CAN_SPLIT_ = null; }
        if ($_S_CAN_SPLIT_) {
            echo "<option value=\"split_all\"";
            if (isset($context["S_SPLIT_VIEW"])) { $_S_SPLIT_VIEW_ = $context["S_SPLIT_VIEW"]; } else { $_S_SPLIT_VIEW_ = null; }
            if ($_S_SPLIT_VIEW_) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->env->getExtension('phpbb')->lang("SPLIT_POSTS");
            echo "</option><option value=\"split_beyond\">";
            echo $this->env->getExtension('phpbb')->lang("SPLIT_AFTER");
            echo "</option>";
        }
        // line 176
        echo "\t\t";
        if (isset($context["S_CAN_SYNC"])) { $_S_CAN_SYNC_ = $context["S_CAN_SYNC"]; } else { $_S_CAN_SYNC_ = null; }
        if ($_S_CAN_SYNC_) {
            echo "<option value=\"resync\">";
            echo $this->env->getExtension('phpbb')->lang("RESYNC");
            echo "</option>";
        }
        // line 177
        echo "\t</select>&nbsp;
\t<input class=\"button1\" type=\"submit\" name=\"mcp_topic_submit\" value=\"";
        // line 178
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" />
\t<div><a href=\"#\" onclick=\"marklist('mcp', 'post', true); return false;\">";
        // line 179
        echo $this->env->getExtension('phpbb')->lang("MARK_ALL");
        echo "</a> :: <a href=\"#\" onclick=\"marklist('mcp', 'post', false); return false;\">";
        echo $this->env->getExtension('phpbb')->lang("UNMARK_ALL");
        echo "</a></div>
";
        // line 180
        if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
        echo $_S_HIDDEN_FIELDS_;
        echo "
";
        // line 181
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
</fieldset>

</form>

";
        // line 186
        $location = "mcp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("mcp_footer.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "mcp_topic.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  687 => 186,  678 => 181,  673 => 180,  667 => 179,  663 => 178,  660 => 177,  652 => 176,  637 => 175,  624 => 174,  616 => 173,  608 => 172,  596 => 171,  589 => 170,  585 => 169,  575 => 161,  569 => 159,  564 => 158,  552 => 157,  547 => 156,  542 => 155,  534 => 149,  523 => 143,  519 => 141,  509 => 139,  504 => 138,  500 => 137,  497 => 136,  494 => 135,  485 => 133,  482 => 132,  473 => 129,  470 => 128,  467 => 127,  464 => 126,  455 => 123,  452 => 122,  449 => 121,  446 => 120,  437 => 117,  434 => 116,  431 => 115,  402 => 113,  394 => 112,  377 => 107,  369 => 106,  362 => 102,  355 => 101,  348 => 98,  336 => 95,  331 => 94,  320 => 90,  308 => 89,  298 => 81,  293 => 78,  285 => 77,  277 => 75,  272 => 74,  266 => 72,  261 => 70,  258 => 69,  255 => 68,  252 => 67,  244 => 63,  239 => 62,  230 => 59,  225 => 58,  221 => 56,  186 => 53,  182 => 52,  177 => 51,  174 => 50,  171 => 49,  166 => 47,  163 => 46,  160 => 45,  142 => 41,  137 => 40,  130 => 37,  123 => 36,  112 => 29,  103 => 23,  96 => 22,  91 => 20,  85 => 17,  78 => 16,  72 => 14,  69 => 13,  63 => 11,  57 => 9,  51 => 7,  47 => 6,  35 => 4,  31 => 2,  19 => 1,);
    }
}
