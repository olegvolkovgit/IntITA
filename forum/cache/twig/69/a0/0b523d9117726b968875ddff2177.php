<?php

/* acp_forums.html */
class __TwigTemplate_69a00b523d9117726b968875ddff2177 extends Twig_Template
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
        if (isset($context["S_EDIT_FORUM"])) { $_S_EDIT_FORUM_ = $context["S_EDIT_FORUM"]; } else { $_S_EDIT_FORUM_ = null; }
        if (isset($context["S_DELETE_FORUM"])) { $_S_DELETE_FORUM_ = $context["S_DELETE_FORUM"]; } else { $_S_DELETE_FORUM_ = null; }
        if (isset($context["S_CONTINUE_SYNC"])) { $_S_CONTINUE_SYNC_ = $context["S_CONTINUE_SYNC"]; } else { $_S_CONTINUE_SYNC_ = null; }
        if ($_S_EDIT_FORUM_) {
            // line 6
            echo "
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\t/**
\t\t* Handle displaying/hiding several options based on the forum type
\t\t*/
\t\tfunction display_options(value)
\t\t{
\t\t\t";
            // line 14
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_POST"])) { $_S_FORUM_ORIG_POST_ = $context["S_FORUM_ORIG_POST"]; } else { $_S_FORUM_ORIG_POST_ = null; }
            if (((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_POST_)) {
                // line 15
                echo "\t\t\t\tif (value == ";
                if (isset($context["FORUM_POST"])) { $_FORUM_POST_ = $context["FORUM_POST"]; } else { $_FORUM_POST_ = null; }
                echo $_FORUM_POST_;
                echo ")
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('type_actions', -1);
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('type_actions', 1);
\t\t\t\t}
\t\t\t";
            }
            // line 24
            echo "
\t\t\t";
            // line 25
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_CAT"])) { $_S_FORUM_ORIG_CAT_ = $context["S_FORUM_ORIG_CAT"]; } else { $_S_FORUM_ORIG_CAT_ = null; }
            if (isset($context["S_HAS_SUBFORUMS"])) { $_S_HAS_SUBFORUMS_ = $context["S_HAS_SUBFORUMS"]; } else { $_S_HAS_SUBFORUMS_ = null; }
            if ((((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_CAT_) && $_S_HAS_SUBFORUMS_)) {
                // line 26
                echo "\t\t\t\tif (value == ";
                if (isset($context["FORUM_LINK"])) { $_FORUM_LINK_ = $context["FORUM_LINK"]; } else { $_FORUM_LINK_ = null; }
                echo $_FORUM_LINK_;
                echo ")
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', 1);
\t\t\t\t}
\t\t\t\telse
\t\t\t\t{
\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', -1);
\t\t\t\t}
\t\t\t";
            }
            // line 35
            echo "
\t\t\tif (value == ";
            // line 36
            if (isset($context["FORUM_POST"])) { $_FORUM_POST_ = $context["FORUM_POST"]; } else { $_FORUM_POST_ = null; }
            echo $_FORUM_POST_;
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t}
\t\t\telse if (value == ";
            // line 43
            if (isset($context["FORUM_LINK"])) { $_FORUM_LINK_ = $context["FORUM_LINK"]; } else { $_FORUM_LINK_ = null; }
            echo $_FORUM_LINK_;
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t}
\t\t\telse if (value == ";
            // line 50
            if (isset($context["FORUM_CAT"])) { $_FORUM_CAT_ = $context["FORUM_CAT"]; } else { $_FORUM_CAT_ = null; }
            echo $_FORUM_CAT_;
            echo ")
\t\t\t{
\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t\tphpbb.toggleDisplay('forum_rules_options', 1);
\t\t\t\tphpbb.toggleDisplay('forum_cat_options', 1);
\t\t\t}
\t\t}

\t\t/**
\t\t* Init the wanted display functionality if javascript is enabled.
\t\t* If javascript is not available, the user is still able to properly administer.
\t\t*/
\t\tonload = function()
\t\t{
\t\t\t";
            // line 65
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_POST"])) { $_S_FORUM_ORIG_POST_ = $context["S_FORUM_ORIG_POST"]; } else { $_S_FORUM_ORIG_POST_ = null; }
            if (((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_POST_)) {
                // line 66
                echo "\t\t\t\t";
                if (isset($context["S_FORUM_POST"])) { $_S_FORUM_POST_ = $context["S_FORUM_POST"]; } else { $_S_FORUM_POST_ = null; }
                if ($_S_FORUM_POST_) {
                    // line 67
                    echo "\t\t\t\t\tphpbb.toggleDisplay('type_actions', -1);
\t\t\t\t";
                }
                // line 69
                echo "\t\t\t";
            }
            // line 70
            echo "
\t\t\t";
            // line 71
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_CAT"])) { $_S_FORUM_ORIG_CAT_ = $context["S_FORUM_ORIG_CAT"]; } else { $_S_FORUM_ORIG_CAT_ = null; }
            if (isset($context["S_HAS_SUBFORUMS"])) { $_S_HAS_SUBFORUMS_ = $context["S_HAS_SUBFORUMS"]; } else { $_S_HAS_SUBFORUMS_ = null; }
            if ((((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_CAT_) && $_S_HAS_SUBFORUMS_)) {
                // line 72
                echo "\t\t\t\t";
                if (isset($context["S_FORUM_CAT"])) { $_S_FORUM_CAT_ = $context["S_FORUM_CAT"]; } else { $_S_FORUM_CAT_ = null; }
                if ($_S_FORUM_CAT_) {
                    // line 73
                    echo "\t\t\t\t\tphpbb.toggleDisplay('cat_to_link_actions', -1);
\t\t\t\t";
                }
                // line 75
                echo "\t\t\t";
            }
            // line 76
            echo "
\t\t\t";
            // line 77
            if (isset($context["S_FORUM_POST"])) { $_S_FORUM_POST_ = $context["S_FORUM_POST"]; } else { $_S_FORUM_POST_ = null; }
            if ((!$_S_FORUM_POST_)) {
                // line 78
                echo "\t\t\t\tphpbb.toggleDisplay('forum_post_options', -1);
\t\t\t";
            }
            // line 80
            echo "
\t\t\t";
            // line 81
            if (isset($context["S_FORUM_CAT"])) { $_S_FORUM_CAT_ = $context["S_FORUM_CAT"]; } else { $_S_FORUM_CAT_ = null; }
            if ((!$_S_FORUM_CAT_)) {
                // line 82
                echo "\t\t\t\tphpbb.toggleDisplay('forum_cat_options', -1);
\t\t\t";
            }
            // line 84
            echo "
\t\t\t";
            // line 85
            if (isset($context["S_FORUM_LINK"])) { $_S_FORUM_LINK_ = $context["S_FORUM_LINK"]; } else { $_S_FORUM_LINK_ = null; }
            if ((!$_S_FORUM_LINK_)) {
                // line 86
                echo "\t\t\t\tphpbb.toggleDisplay('forum_link_options', -1);
\t\t\t";
            }
            // line 88
            echo "
\t\t\t";
            // line 89
            if (isset($context["S_FORUM_LINK"])) { $_S_FORUM_LINK_ = $context["S_FORUM_LINK"]; } else { $_S_FORUM_LINK_ = null; }
            if ($_S_FORUM_LINK_) {
                // line 90
                echo "\t\t\tphpbb.toggleDisplay('forum_rules_options', -1);
\t\t\t";
            }
            // line 92
            echo "\t\t}

\t// ]]>
\t</script>

\t<a href=\"";
            // line 97
            if (isset($context["U_BACK"])) { $_U_BACK_ = $context["U_BACK"]; } else { $_U_BACK_ = null; }
            echo $_U_BACK_;
            echo "\" style=\"float: ";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 99
            echo $this->env->getExtension('phpbb')->lang("TITLE");
            echo " ";
            if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
            if ($_FORUM_NAME_) {
                echo ":: ";
                if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
                echo $_FORUM_NAME_;
            }
            echo "</h1>

\t<p>";
            // line 101
            echo $this->env->getExtension('phpbb')->lang("FORUM_EDIT_EXPLAIN");
            echo "</p>

\t";
            // line 103
            if (isset($context["S_ERROR"])) { $_S_ERROR_ = $context["S_ERROR"]; } else { $_S_ERROR_ = null; }
            if ($_S_ERROR_) {
                // line 104
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 105
                echo $this->env->getExtension('phpbb')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 106
                if (isset($context["ERROR_MSG"])) { $_ERROR_MSG_ = $context["ERROR_MSG"]; } else { $_ERROR_MSG_ = null; }
                echo $_ERROR_MSG_;
                echo "</p>
\t\t</div>
\t";
            }
            // line 109
            echo "
\t<form id=\"forumedit\" method=\"post\" action=\"";
            // line 110
            if (isset($context["U_EDIT_ACTION"])) { $_U_EDIT_ACTION_ = $context["U_EDIT_ACTION"]; } else { $_U_EDIT_ACTION_ = null; }
            echo $_U_EDIT_ACTION_;
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 113
            echo $this->env->getExtension('phpbb')->lang("FORUM_SETTINGS");
            echo "</legend>
\t";
            // line 114
            if (isset($context["acp_forums_main_settings_prepend"])) { $_acp_forums_main_settings_prepend_ = $context["acp_forums_main_settings_prepend"]; } else { $_acp_forums_main_settings_prepend_ = null; }
            // line 115
            echo "\t<dl>
\t\t<dt><label for=\"forum_type\">";
            // line 116
            echo $this->env->getExtension('phpbb')->lang("FORUM_TYPE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"forum_type\" name=\"forum_type\" onchange=\"display_options(this.options[this.selectedIndex].value);\">";
            // line 117
            if (isset($context["S_FORUM_TYPE_OPTIONS"])) { $_S_FORUM_TYPE_OPTIONS_ = $context["S_FORUM_TYPE_OPTIONS"]; } else { $_S_FORUM_TYPE_OPTIONS_ = null; }
            echo $_S_FORUM_TYPE_OPTIONS_;
            echo "</select></dd>
\t</dl>
\t";
            // line 119
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_POST"])) { $_S_FORUM_ORIG_POST_ = $context["S_FORUM_ORIG_POST"]; } else { $_S_FORUM_ORIG_POST_ = null; }
            if (((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_POST_)) {
                // line 120
                echo "\t<div id=\"type_actions\">
\t\t<dl>
\t\t\t<dt><label for=\"type_action\">";
                // line 122
                echo $this->env->getExtension('phpbb')->lang("DECIDE_MOVE_DELETE_CONTENT");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"type_action\" value=\"delete\"";
                // line 123
                if (isset($context["S_MOVE_FORUM_OPTIONS"])) { $_S_MOVE_FORUM_OPTIONS_ = $context["S_MOVE_FORUM_OPTIONS"]; } else { $_S_MOVE_FORUM_OPTIONS_ = null; }
                if ((!$_S_MOVE_FORUM_OPTIONS_)) {
                    echo " checked=\"checked\" id=\"type_action\"";
                }
                echo " /> ";
                echo $this->env->getExtension('phpbb')->lang("DELETE_ALL_POSTS");
                echo "</label></dd>
\t\t\t";
                // line 124
                if (isset($context["S_MOVE_FORUM_OPTIONS"])) { $_S_MOVE_FORUM_OPTIONS_ = $context["S_MOVE_FORUM_OPTIONS"]; } else { $_S_MOVE_FORUM_OPTIONS_ = null; }
                if ($_S_MOVE_FORUM_OPTIONS_) {
                    echo "<dd><label><input type=\"radio\" class=\"radio\" name=\"type_action\" id=\"type_action\" value=\"move\" checked=\"checked\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("MOVE_POSTS_TO");
                    echo "</label> <select name=\"to_forum_id\">";
                    if (isset($context["S_MOVE_FORUM_OPTIONS"])) { $_S_MOVE_FORUM_OPTIONS_ = $context["S_MOVE_FORUM_OPTIONS"]; } else { $_S_MOVE_FORUM_OPTIONS_ = null; }
                    echo $_S_MOVE_FORUM_OPTIONS_;
                    echo "</select></dd>";
                }
                // line 125
                echo "\t\t</dl>
\t</div>
\t";
            }
            // line 128
            echo "\t";
            if (isset($context["S_ADD_ACTION"])) { $_S_ADD_ACTION_ = $context["S_ADD_ACTION"]; } else { $_S_ADD_ACTION_ = null; }
            if (isset($context["S_FORUM_ORIG_CAT"])) { $_S_FORUM_ORIG_CAT_ = $context["S_FORUM_ORIG_CAT"]; } else { $_S_FORUM_ORIG_CAT_ = null; }
            if (isset($context["S_HAS_SUBFORUMS"])) { $_S_HAS_SUBFORUMS_ = $context["S_HAS_SUBFORUMS"]; } else { $_S_HAS_SUBFORUMS_ = null; }
            if ((((!$_S_ADD_ACTION_) && $_S_FORUM_ORIG_CAT_) && $_S_HAS_SUBFORUMS_)) {
                // line 129
                echo "\t<div id=\"cat_to_link_actions\">
\t\t<dl>
\t\t\t<dt><label for=\"action_subforums\">";
                // line 131
                echo $this->env->getExtension('phpbb')->lang("DECIDE_MOVE_DELETE_SUBFORUMS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t";
                // line 132
                if (isset($context["S_FORUMS_LIST"])) { $_S_FORUMS_LIST_ = $context["S_FORUMS_LIST"]; } else { $_S_FORUMS_LIST_ = null; }
                if ($_S_FORUMS_LIST_) {
                    // line 133
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"action_subforums\" name=\"action_subforums\" value=\"move\" checked=\"checked\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("MOVE_SUBFORUMS_TO");
                    echo "</label> <select name=\"subforums_to_id\">";
                    if (isset($context["S_FORUMS_LIST"])) { $_S_FORUMS_LIST_ = $context["S_FORUMS_LIST"]; } else { $_S_FORUMS_LIST_ = null; }
                    echo $_S_FORUMS_LIST_;
                    echo "</select></dd>
\t\t\t";
                } else {
                    // line 135
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"action_subforums\" name=\"action_subforums\" value=\"delete\" checked=\"checked\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("DELETE_SUBFORUMS");
                    echo "</label></dd>
\t\t\t";
                }
                // line 137
                echo "\t\t</dl>
\t</div>
\t";
            }
            // line 140
            echo "\t<dl>
\t\t<dt><label for=\"parent\">";
            // line 141
            echo $this->env->getExtension('phpbb')->lang("FORUM_PARENT");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"parent\" name=\"forum_parent_id\"><option value=\"0\"";
            // line 142
            if (isset($context["S_FORUM_PARENT_ID"])) { $_S_FORUM_PARENT_ID_ = $context["S_FORUM_PARENT_ID"]; } else { $_S_FORUM_PARENT_ID_ = null; }
            if ((!$_S_FORUM_PARENT_ID_)) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo $this->env->getExtension('phpbb')->lang("NO_PARENT");
            echo "</option>";
            if (isset($context["S_PARENT_OPTIONS"])) { $_S_PARENT_OPTIONS_ = $context["S_PARENT_OPTIONS"]; } else { $_S_PARENT_OPTIONS_ = null; }
            echo $_S_PARENT_OPTIONS_;
            echo "</select></dd>
\t</dl>
\t";
            // line 144
            if (isset($context["S_CAN_COPY_PERMISSIONS"])) { $_S_CAN_COPY_PERMISSIONS_ = $context["S_CAN_COPY_PERMISSIONS"]; } else { $_S_CAN_COPY_PERMISSIONS_ = null; }
            if ($_S_CAN_COPY_PERMISSIONS_) {
                // line 145
                echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_perm_from\">";
                // line 146
                echo $this->env->getExtension('phpbb')->lang("COPY_PERMISSIONS");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("COPY_PERMISSIONS_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><select id=\"forum_perm_from\" name=\"forum_perm_from\"><option value=\"0\">";
                // line 147
                echo $this->env->getExtension('phpbb')->lang("NO_PERMISSIONS");
                echo "</option>";
                if (isset($context["S_FORUM_OPTIONS"])) { $_S_FORUM_OPTIONS_ = $context["S_FORUM_OPTIONS"]; } else { $_S_FORUM_OPTIONS_ = null; }
                echo $_S_FORUM_OPTIONS_;
                echo "</select></dd>
\t\t</dl>
\t";
            }
            // line 150
            echo "\t<dl>
\t\t<dt><label for=\"forum_name\">";
            // line 151
            echo $this->env->getExtension('phpbb')->lang("FORUM_NAME");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_name\" name=\"forum_name\" value=\"";
            // line 152
            if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
            echo $_FORUM_NAME_;
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_desc\">";
            // line 155
            echo $this->env->getExtension('phpbb')->lang("FORUM_DESC");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_DESC_EXPLAIN");
            echo "</span></dt>
\t\t<dd><textarea id=\"forum_desc\" name=\"forum_desc\" rows=\"5\" cols=\"45\" data-bbcode=\"true\">";
            // line 156
            if (isset($context["FORUM_DESC"])) { $_FORUM_DESC_ = $context["FORUM_DESC"]; } else { $_FORUM_DESC_ = null; }
            echo $_FORUM_DESC_;
            echo "</textarea></dd>
\t\t<dd><label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_bbcode\"";
            // line 157
            if (isset($context["S_DESC_BBCODE_CHECKED"])) { $_S_DESC_BBCODE_CHECKED_ = $context["S_DESC_BBCODE_CHECKED"]; } else { $_S_DESC_BBCODE_CHECKED_ = null; }
            if ($_S_DESC_BBCODE_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_BBCODE");
            echo "</label>
\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_smilies\"";
            // line 158
            if (isset($context["S_DESC_SMILIES_CHECKED"])) { $_S_DESC_SMILIES_CHECKED_ = $context["S_DESC_SMILIES_CHECKED"]; } else { $_S_DESC_SMILIES_CHECKED_ = null; }
            if ($_S_DESC_SMILIES_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_SMILIES");
            echo "</label>
\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"desc_parse_urls\"";
            // line 159
            if (isset($context["S_DESC_URLS_CHECKED"])) { $_S_DESC_URLS_CHECKED_ = $context["S_DESC_URLS_CHECKED"]; } else { $_S_DESC_URLS_CHECKED_ = null; }
            if ($_S_DESC_URLS_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_URLS");
            echo "</label></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_image\">";
            // line 162
            echo $this->env->getExtension('phpbb')->lang("FORUM_IMAGE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_IMAGE_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_image\" name=\"forum_image\" value=\"";
            // line 163
            if (isset($context["FORUM_IMAGE"])) { $_FORUM_IMAGE_ = $context["FORUM_IMAGE"]; } else { $_FORUM_IMAGE_ = null; }
            echo $_FORUM_IMAGE_;
            echo "\" maxlength=\"255\" /></dd>
\t\t";
            // line 164
            if (isset($context["FORUM_IMAGE_SRC"])) { $_FORUM_IMAGE_SRC_ = $context["FORUM_IMAGE_SRC"]; } else { $_FORUM_IMAGE_SRC_ = null; }
            if ($_FORUM_IMAGE_SRC_) {
                // line 165
                echo "\t\t\t<dd><img src=\"";
                if (isset($context["FORUM_IMAGE_SRC"])) { $_FORUM_IMAGE_SRC_ = $context["FORUM_IMAGE_SRC"]; } else { $_FORUM_IMAGE_SRC_ = null; }
                echo $_FORUM_IMAGE_SRC_;
                echo "\" alt=\"";
                echo $this->env->getExtension('phpbb')->lang("FORUM_IMAGE");
                echo "\" /></dd>
\t\t";
            }
            // line 167
            echo "\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_password\">";
            // line 169
            echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input type=\"password\" id=\"forum_password\" name=\"forum_password\" value=\"";
            // line 170
            if (isset($context["S_FORUM_PASSWORD_SET"])) { $_S_FORUM_PASSWORD_SET_ = $context["S_FORUM_PASSWORD_SET"]; } else { $_S_FORUM_PASSWORD_SET_ = null; }
            if ($_S_FORUM_PASSWORD_SET_) {
                echo "&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;";
            }
            echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"forum_password_confirm\">";
            // line 173
            echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD_CONFIRM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD_CONFIRM_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input type=\"password\" id=\"forum_password_confirm\" name=\"forum_password_confirm\" value=\"";
            // line 174
            if (isset($context["S_FORUM_PASSWORD_SET"])) { $_S_FORUM_PASSWORD_SET_ = $context["S_FORUM_PASSWORD_SET"]; } else { $_S_FORUM_PASSWORD_SET_ = null; }
            if ($_S_FORUM_PASSWORD_SET_) {
                echo "&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;";
            }
            echo "\" autocomplete=\"off\" /></dd>
\t</dl>
\t";
            // line 176
            if (isset($context["S_FORUM_PASSWORD_SET"])) { $_S_FORUM_PASSWORD_SET_ = $context["S_FORUM_PASSWORD_SET"]; } else { $_S_FORUM_PASSWORD_SET_ = null; }
            if ($_S_FORUM_PASSWORD_SET_) {
                // line 177
                echo "\t<dl>
\t\t<dt><label for=\"forum_password_unset\">";
                // line 178
                echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD_UNSET");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("FORUM_PASSWORD_UNSET_EXPLAIN");
                echo "</span></dt>
\t\t<dd><input id=\"forum_password_unset\" name=\"forum_password_unset\" type=\"checkbox\" /></dd>
\t</dl>
\t";
            }
            // line 182
            echo "\t<dl>
\t\t<dt><label for=\"forum_style\">";
            // line 183
            echo $this->env->getExtension('phpbb')->lang("FORUM_STYLE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><select id=\"forum_style\" name=\"forum_style\"><option value=\"0\">";
            // line 184
            echo $this->env->getExtension('phpbb')->lang("DEFAULT_STYLE");
            echo "</option>";
            if (isset($context["S_STYLES_OPTIONS"])) { $_S_STYLES_OPTIONS_ = $context["S_STYLES_OPTIONS"]; } else { $_S_STYLES_OPTIONS_ = null; }
            echo $_S_STYLES_OPTIONS_;
            echo "</select></dd>
\t</dl>
\t";
            // line 186
            if (isset($context["acp_forums_main_settings_append"])) { $_acp_forums_main_settings_append_ = $context["acp_forums_main_settings_append"]; } else { $_acp_forums_main_settings_append_ = null; }
            // line 187
            echo "\t</fieldset>

\t<div id=\"forum_cat_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 191
            echo $this->env->getExtension('phpbb')->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"display_active\">";
            // line 193
            echo $this->env->getExtension('phpbb')->lang("DISPLAY_ACTIVE_TOPICS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("DISPLAY_ACTIVE_TOPICS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_active\" value=\"1\"";
            // line 194
            if (isset($context["S_ENABLE_ACTIVE_TOPICS"])) { $_S_ENABLE_ACTIVE_TOPICS_ = $context["S_ENABLE_ACTIVE_TOPICS"]; } else { $_S_ENABLE_ACTIVE_TOPICS_ = null; }
            if ($_S_ENABLE_ACTIVE_TOPICS_) {
                echo " id=\"display_active\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_active\" value=\"0\"";
            // line 195
            if (isset($context["S_ENABLE_ACTIVE_TOPICS"])) { $_S_ENABLE_ACTIVE_TOPICS_ = $context["S_ENABLE_ACTIVE_TOPICS"]; } else { $_S_ENABLE_ACTIVE_TOPICS_ = null; }
            if ((!$_S_ENABLE_ACTIVE_TOPICS_)) {
                echo " id=\"display_active\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t<div id=\"forum_post_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 202
            echo $this->env->getExtension('phpbb')->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t";
            // line 203
            if (isset($context["acp_forums_normal_settings_prepend"])) { $_acp_forums_normal_settings_prepend_ = $context["acp_forums_normal_settings_prepend"]; } else { $_acp_forums_normal_settings_prepend_ = null; }
            // line 204
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_status\">";
            // line 205
            echo $this->env->getExtension('phpbb')->lang("FORUM_STATUS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><select id=\"forum_status\" name=\"forum_status\">";
            // line 206
            if (isset($context["S_STATUS_OPTIONS"])) { $_S_STATUS_OPTIONS_ = $context["S_STATUS_OPTIONS"]; } else { $_S_STATUS_OPTIONS_ = null; }
            echo $_S_STATUS_OPTIONS_;
            echo "</select></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_subforum_list\">";
            // line 209
            echo $this->env->getExtension('phpbb')->lang("LIST_SUBFORUMS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("LIST_SUBFORUMS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_subforum_list\" value=\"1\"";
            // line 210
            if (isset($context["S_DISPLAY_SUBFORUM_LIST"])) { $_S_DISPLAY_SUBFORUM_LIST_ = $context["S_DISPLAY_SUBFORUM_LIST"]; } else { $_S_DISPLAY_SUBFORUM_LIST_ = null; }
            if ($_S_DISPLAY_SUBFORUM_LIST_) {
                echo " id=\"display_subforum_list\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_subforum_list\" value=\"0\"";
            // line 211
            if (isset($context["S_DISPLAY_SUBFORUM_LIST"])) { $_S_DISPLAY_SUBFORUM_LIST_ = $context["S_DISPLAY_SUBFORUM_LIST"]; } else { $_S_DISPLAY_SUBFORUM_LIST_ = null; }
            if ((!$_S_DISPLAY_SUBFORUM_LIST_)) {
                echo " id=\"display_subforum_list\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_on_index\">";
            // line 214
            echo $this->env->getExtension('phpbb')->lang("LIST_INDEX");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("LIST_INDEX_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_on_index\" value=\"1\"";
            // line 215
            if (isset($context["S_DISPLAY_ON_INDEX"])) { $_S_DISPLAY_ON_INDEX_ = $context["S_DISPLAY_ON_INDEX"]; } else { $_S_DISPLAY_ON_INDEX_ = null; }
            if ($_S_DISPLAY_ON_INDEX_) {
                echo " id=\"display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_on_index\" value=\"0\"";
            // line 216
            if (isset($context["S_DISPLAY_ON_INDEX"])) { $_S_DISPLAY_ON_INDEX_ = $context["S_DISPLAY_ON_INDEX"]; } else { $_S_DISPLAY_ON_INDEX_ = null; }
            if ((!$_S_DISPLAY_ON_INDEX_)) {
                echo " id=\"display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_post_review\">";
            // line 219
            echo $this->env->getExtension('phpbb')->lang("ENABLE_POST_REVIEW");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("ENABLE_POST_REVIEW_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_post_review\" value=\"1\"";
            // line 220
            if (isset($context["S_ENABLE_POST_REVIEW"])) { $_S_ENABLE_POST_REVIEW_ = $context["S_ENABLE_POST_REVIEW"]; } else { $_S_ENABLE_POST_REVIEW_ = null; }
            if ($_S_ENABLE_POST_REVIEW_) {
                echo " id=\"enable_post_review\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_post_review\" value=\"0\"";
            // line 221
            if (isset($context["S_ENABLE_POST_REVIEW"])) { $_S_ENABLE_POST_REVIEW_ = $context["S_ENABLE_POST_REVIEW"]; } else { $_S_ENABLE_POST_REVIEW_ = null; }
            if ((!$_S_ENABLE_POST_REVIEW_)) {
                echo " id=\"enable_post_review\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_quick_reply\">";
            // line 224
            echo $this->env->getExtension('phpbb')->lang("ENABLE_QUICK_REPLY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("ENABLE_QUICK_REPLY_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_quick_reply\" value=\"1\"";
            // line 225
            if (isset($context["S_ENABLE_QUICK_REPLY"])) { $_S_ENABLE_QUICK_REPLY_ = $context["S_ENABLE_QUICK_REPLY"]; } else { $_S_ENABLE_QUICK_REPLY_ = null; }
            if ($_S_ENABLE_QUICK_REPLY_) {
                echo " id=\"enable_quick_reply\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_quick_reply\" value=\"0\"";
            // line 226
            if (isset($context["S_ENABLE_QUICK_REPLY"])) { $_S_ENABLE_QUICK_REPLY_ = $context["S_ENABLE_QUICK_REPLY"]; } else { $_S_ENABLE_QUICK_REPLY_ = null; }
            if ((!$_S_ENABLE_QUICK_REPLY_)) {
                echo " id=\"enable_quick_reply\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_indexing\">";
            // line 229
            echo $this->env->getExtension('phpbb')->lang("ENABLE_INDEXING");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("ENABLE_INDEXING_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_indexing\" value=\"1\"";
            // line 230
            if (isset($context["S_ENABLE_INDEXING"])) { $_S_ENABLE_INDEXING_ = $context["S_ENABLE_INDEXING"]; } else { $_S_ENABLE_INDEXING_ = null; }
            if ($_S_ENABLE_INDEXING_) {
                echo " id=\"enable_indexing\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_indexing\" value=\"0\"";
            // line 231
            if (isset($context["S_ENABLE_INDEXING"])) { $_S_ENABLE_INDEXING_ = $context["S_ENABLE_INDEXING"]; } else { $_S_ENABLE_INDEXING_ = null; }
            if ((!$_S_ENABLE_INDEXING_)) {
                echo " id=\"enable_indexing\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_icons\">";
            // line 234
            echo $this->env->getExtension('phpbb')->lang("ENABLE_TOPIC_ICONS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_icons\" value=\"1\"";
            // line 235
            if (isset($context["S_TOPIC_ICONS"])) { $_S_TOPIC_ICONS_ = $context["S_TOPIC_ICONS"]; } else { $_S_TOPIC_ICONS_ = null; }
            if ($_S_TOPIC_ICONS_) {
                echo " id=\"enable_icons\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_icons\" value=\"0\"";
            // line 236
            if (isset($context["S_TOPIC_ICONS"])) { $_S_TOPIC_ICONS_ = $context["S_TOPIC_ICONS"]; } else { $_S_TOPIC_ICONS_ = null; }
            if ((!$_S_TOPIC_ICONS_)) {
                echo " id=\"enable_icons\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"display_recent\">";
            // line 239
            echo $this->env->getExtension('phpbb')->lang("ENABLE_RECENT");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("ENABLE_RECENT_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"display_recent\" value=\"1\"";
            // line 240
            if (isset($context["S_DISPLAY_ACTIVE_TOPICS"])) { $_S_DISPLAY_ACTIVE_TOPICS_ = $context["S_DISPLAY_ACTIVE_TOPICS"]; } else { $_S_DISPLAY_ACTIVE_TOPICS_ = null; }
            if ($_S_DISPLAY_ACTIVE_TOPICS_) {
                echo " id=\"display_recent\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"display_recent\" value=\"0\"";
            // line 241
            if (isset($context["S_DISPLAY_ACTIVE_TOPICS"])) { $_S_DISPLAY_ACTIVE_TOPICS_ = $context["S_DISPLAY_ACTIVE_TOPICS"]; } else { $_S_DISPLAY_ACTIVE_TOPICS_ = null; }
            if ((!$_S_DISPLAY_ACTIVE_TOPICS_)) {
                echo " id=\"display_recent\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"topics_per_page\">";
            // line 244
            echo $this->env->getExtension('phpbb')->lang("FORUM_TOPICS_PAGE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_TOPICS_PAGE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"topics_per_page\" name=\"topics_per_page\" value=\"";
            // line 245
            if (isset($context["TOPICS_PER_PAGE"])) { $_TOPICS_PER_PAGE_ = $context["TOPICS_PER_PAGE"]; } else { $_TOPICS_PER_PAGE_ = null; }
            echo $_TOPICS_PER_PAGE_;
            echo "\" size=\"4\" maxlength=\"4\" min=\"0\" max=\"9999\" /></dd>
\t\t</dl>
\t\t";
            // line 247
            if (isset($context["acp_forums_normal_settings_append"])) { $_acp_forums_normal_settings_append_ = $context["acp_forums_normal_settings_append"]; } else { $_acp_forums_normal_settings_append_ = null; }
            // line 248
            echo "\t\t</fieldset>

\t\t<fieldset>
\t\t\t<legend>";
            // line 251
            echo $this->env->getExtension('phpbb')->lang("FORUM_PRUNE_SETTINGS");
            echo "</legend>
\t\t";
            // line 252
            if (isset($context["acp_forums_prune_settings_prepend"])) { $_acp_forums_prune_settings_prepend_ = $context["acp_forums_prune_settings_prepend"]; } else { $_acp_forums_prune_settings_prepend_ = null; }
            // line 253
            echo "\t\t<dl>
\t\t\t<dt><label for=\"enable_prune\">";
            // line 254
            echo $this->env->getExtension('phpbb')->lang("FORUM_AUTO_PRUNE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_AUTO_PRUNE_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_prune\" value=\"1\"";
            // line 255
            if (isset($context["S_PRUNE_ENABLE"])) { $_S_PRUNE_ENABLE_ = $context["S_PRUNE_ENABLE"]; } else { $_S_PRUNE_ENABLE_ = null; }
            if ($_S_PRUNE_ENABLE_) {
                echo " id=\"enable_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_prune\" value=\"0\"";
            // line 256
            if (isset($context["S_PRUNE_ENABLE"])) { $_S_PRUNE_ENABLE_ = $context["S_PRUNE_ENABLE"]; } else { $_S_PRUNE_ENABLE_ = null; }
            if ((!$_S_PRUNE_ENABLE_)) {
                echo " id=\"enable_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_freq\">";
            // line 259
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_FREQ");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_FREQ_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_freq\" name=\"prune_freq\" value=\"";
            // line 260
            if (isset($context["PRUNE_FREQ"])) { $_PRUNE_FREQ_ = $context["PRUNE_FREQ"]; } else { $_PRUNE_FREQ_ = null; }
            echo $_PRUNE_FREQ_;
            echo "\" maxlength=\"4\" size=\"4\" min=\"0\" max=\"9999\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_days\">";
            // line 263
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_DAYS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_DAYS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_days\" name=\"prune_days\" value=\"";
            // line 264
            if (isset($context["PRUNE_DAYS"])) { $_PRUNE_DAYS_ = $context["PRUNE_DAYS"]; } else { $_PRUNE_DAYS_ = null; }
            echo $_PRUNE_DAYS_;
            echo "\" maxlength=\"4\" size=\"4\" min=\"0\" max=\"9999\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_viewed\">";
            // line 267
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_VIEWED");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_VIEWED_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_viewed\" name=\"prune_viewed\" value=\"";
            // line 268
            if (isset($context["PRUNE_VIEWED"])) { $_PRUNE_VIEWED_ = $context["PRUNE_VIEWED"]; } else { $_PRUNE_VIEWED_ = null; }
            echo $_PRUNE_VIEWED_;
            echo "\" maxlength=\"4\" size=\"4\" min=\"0\" max=\"9999\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_old_polls\">";
            // line 271
            echo $this->env->getExtension('phpbb')->lang("PRUNE_OLD_POLLS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("PRUNE_OLD_POLLS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_old_polls\" value=\"1\"";
            // line 272
            if (isset($context["S_PRUNE_OLD_POLLS"])) { $_S_PRUNE_OLD_POLLS_ = $context["S_PRUNE_OLD_POLLS"]; } else { $_S_PRUNE_OLD_POLLS_ = null; }
            if ($_S_PRUNE_OLD_POLLS_) {
                echo " id=\"prune_old_polls\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_old_polls\" value=\"0\"";
            // line 273
            if (isset($context["S_PRUNE_OLD_POLLS"])) { $_S_PRUNE_OLD_POLLS_ = $context["S_PRUNE_OLD_POLLS"]; } else { $_S_PRUNE_OLD_POLLS_ = null; }
            if ((!$_S_PRUNE_OLD_POLLS_)) {
                echo " id=\"prune_old_polls\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_announce\">";
            // line 276
            echo $this->env->getExtension('phpbb')->lang("PRUNE_ANNOUNCEMENTS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_announce\" value=\"1\"";
            // line 277
            if (isset($context["S_PRUNE_ANNOUNCE"])) { $_S_PRUNE_ANNOUNCE_ = $context["S_PRUNE_ANNOUNCE"]; } else { $_S_PRUNE_ANNOUNCE_ = null; }
            if ($_S_PRUNE_ANNOUNCE_) {
                echo " id=\"prune_announce\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_announce\" value=\"0\"";
            // line 278
            if (isset($context["S_PRUNE_ANNOUNCE"])) { $_S_PRUNE_ANNOUNCE_ = $context["S_PRUNE_ANNOUNCE"]; } else { $_S_PRUNE_ANNOUNCE_ = null; }
            if ((!$_S_PRUNE_ANNOUNCE_)) {
                echo " id=\"prune_announce\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_sticky\">";
            // line 281
            echo $this->env->getExtension('phpbb')->lang("PRUNE_STICKY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"prune_sticky\" value=\"1\"";
            // line 282
            if (isset($context["S_PRUNE_STICKY"])) { $_S_PRUNE_STICKY_ = $context["S_PRUNE_STICKY"]; } else { $_S_PRUNE_STICKY_ = null; }
            if ($_S_PRUNE_STICKY_) {
                echo " id=\"prune_sticky\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"prune_sticky\" value=\"0\"";
            // line 283
            if (isset($context["S_PRUNE_STICKY"])) { $_S_PRUNE_STICKY_ = $context["S_PRUNE_STICKY"]; } else { $_S_PRUNE_STICKY_ = null; }
            if ((!$_S_PRUNE_STICKY_)) {
                echo " id=\"prune_sticky\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"enable_shadow_prune\">";
            // line 286
            echo $this->env->getExtension('phpbb')->lang("FORUM_PRUNE_SHADOW");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_PRUNE_SHADOW_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"enable_shadow_prune\" value=\"1\"";
            // line 287
            if (isset($context["S_PRUNE_SHADOW_ENABLE"])) { $_S_PRUNE_SHADOW_ENABLE_ = $context["S_PRUNE_SHADOW_ENABLE"]; } else { $_S_PRUNE_SHADOW_ENABLE_ = null; }
            if ($_S_PRUNE_SHADOW_ENABLE_) {
                echo " id=\"enable_shadow_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_shadow_prune\" value=\"0\"";
            // line 288
            if (isset($context["S_PRUNE_SHADOW_ENABLE"])) { $_S_PRUNE_SHADOW_ENABLE_ = $context["S_PRUNE_SHADOW_ENABLE"]; } else { $_S_PRUNE_SHADOW_ENABLE_ = null; }
            if ((!$_S_PRUNE_SHADOW_ENABLE_)) {
                echo " id=\"enable_shadow_prune\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_shadow_freq\">";
            // line 291
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_SHADOW_FREQ");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_SHADOW_FREQ_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_shadow_freq\" name=\"prune_shadow_freq\" value=\"";
            // line 292
            if (isset($context["PRUNE_SHADOW_FREQ"])) { $_PRUNE_SHADOW_FREQ_ = $context["PRUNE_SHADOW_FREQ"]; } else { $_PRUNE_SHADOW_FREQ_ = null; }
            echo $_PRUNE_SHADOW_FREQ_;
            echo "\" maxlength=\"4\" size=\"4\" min=\"0\" max=\"9999\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"prune_shadow_days\">";
            // line 295
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_SHADOW_DAYS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("AUTO_PRUNE_SHADOW_DAYS_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input type=\"number\" id=\"prune_shadow_days\" name=\"prune_shadow_days\" value=\"";
            // line 296
            if (isset($context["PRUNE_SHADOW_DAYS"])) { $_PRUNE_SHADOW_DAYS_ = $context["PRUNE_SHADOW_DAYS"]; } else { $_PRUNE_SHADOW_DAYS_ = null; }
            echo $_PRUNE_SHADOW_DAYS_;
            echo "\" maxlength=\"4\" size=\"4\" min=\"0\" max=\"9999\" /> ";
            echo $this->env->getExtension('phpbb')->lang("DAYS");
            echo "</dd>
\t\t</dl>
\t\t";
            // line 298
            if (isset($context["acp_forums_prune_settings_append"])) { $_acp_forums_prune_settings_append_ = $context["acp_forums_prune_settings_append"]; } else { $_acp_forums_prune_settings_append_ = null; }
            // line 299
            echo "\t\t</fieldset>
\t</div>

\t<div id=\"forum_link_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 304
            echo $this->env->getExtension('phpbb')->lang("GENERAL_FORUM_SETTINGS");
            echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"link_display_on_index\">";
            // line 306
            echo $this->env->getExtension('phpbb')->lang("LIST_INDEX");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("LIST_INDEX_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"link_display_on_index\" value=\"1\"";
            // line 307
            if (isset($context["S_DISPLAY_ON_INDEX"])) { $_S_DISPLAY_ON_INDEX_ = $context["S_DISPLAY_ON_INDEX"]; } else { $_S_DISPLAY_ON_INDEX_ = null; }
            if ($_S_DISPLAY_ON_INDEX_) {
                echo " id=\"link_display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"link_display_on_index\" value=\"0\"";
            // line 308
            if (isset($context["S_DISPLAY_ON_INDEX"])) { $_S_DISPLAY_ON_INDEX_ = $context["S_DISPLAY_ON_INDEX"]; } else { $_S_DISPLAY_ON_INDEX_ = null; }
            if ((!$_S_DISPLAY_ON_INDEX_)) {
                echo " id=\"link_display_on_index\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"forum_link\">";
            // line 311
            echo $this->env->getExtension('phpbb')->lang("FORUM_LINK");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_LINK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_link\" name=\"forum_link\" value=\"";
            // line 312
            if (isset($context["FORUM_DATA_LINK"])) { $_FORUM_DATA_LINK_ = $context["FORUM_DATA_LINK"]; } else { $_FORUM_DATA_LINK_ = null; }
            echo $_FORUM_DATA_LINK_;
            echo "\" maxlength=\"255\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"forum_link_track\">";
            // line 315
            echo $this->env->getExtension('phpbb')->lang("FORUM_LINK_TRACK");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_LINK_TRACK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"forum_link_track\" value=\"1\"";
            // line 316
            if (isset($context["S_FORUM_LINK_TRACK"])) { $_S_FORUM_LINK_TRACK_ = $context["S_FORUM_LINK_TRACK"]; } else { $_S_FORUM_LINK_TRACK_ = null; }
            if ($_S_FORUM_LINK_TRACK_) {
                echo " id=\"forum_link_track\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("YES");
            echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"forum_link_track\" value=\"0\"";
            // line 317
            if (isset($context["S_FORUM_LINK_TRACK"])) { $_S_FORUM_LINK_TRACK_ = $context["S_FORUM_LINK_TRACK"]; } else { $_S_FORUM_LINK_TRACK_ = null; }
            if ((!$_S_FORUM_LINK_TRACK_)) {
                echo " id=\"forum_link_track\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "</label></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t<div id=\"forum_rules_options\">
\t\t<fieldset>
\t\t\t<legend>";
            // line 324
            echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
            echo "</legend>
\t\t";
            // line 325
            if (isset($context["acp_forums_rules_settings_prepend"])) { $_acp_forums_rules_settings_prepend_ = $context["acp_forums_rules_settings_prepend"]; } else { $_acp_forums_rules_settings_prepend_ = null; }
            // line 326
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_rules_link\">";
            // line 327
            echo $this->env->getExtension('phpbb')->lang("FORUM_RULES_LINK");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_RULES_LINK_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"forum_rules_link\" name=\"forum_rules_link\" value=\"";
            // line 328
            if (isset($context["FORUM_RULES_LINK"])) { $_FORUM_RULES_LINK_ = $context["FORUM_RULES_LINK"]; } else { $_FORUM_RULES_LINK_ = null; }
            echo $_FORUM_RULES_LINK_;
            echo "\" maxlength=\"255\" /></dd>
\t\t</dl>
\t";
            // line 330
            if (isset($context["FORUM_RULES_PREVIEW"])) { $_FORUM_RULES_PREVIEW_ = $context["FORUM_RULES_PREVIEW"]; } else { $_FORUM_RULES_PREVIEW_ = null; }
            if ($_FORUM_RULES_PREVIEW_) {
                // line 331
                echo "\t\t<dl>
\t\t\t<dt><label>";
                // line 332
                echo $this->env->getExtension('phpbb')->lang("FORUM_RULES_PREVIEW");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd>";
                // line 333
                if (isset($context["FORUM_RULES_PREVIEW"])) { $_FORUM_RULES_PREVIEW_ = $context["FORUM_RULES_PREVIEW"]; } else { $_FORUM_RULES_PREVIEW_ = null; }
                echo $_FORUM_RULES_PREVIEW_;
                echo "</dd>
\t\t</dl>
\t";
            }
            // line 336
            echo "\t\t<dl>
\t\t\t<dt><label for=\"forum_rules\">";
            // line 337
            echo $this->env->getExtension('phpbb')->lang("FORUM_RULES");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("FORUM_RULES_EXPLAIN");
            echo "</span></dt>
\t\t\t<dd><textarea id=\"forum_rules\" name=\"forum_rules\" rows=\"4\" cols=\"70\" data-bbcode=\"true\">";
            // line 338
            if (isset($context["FORUM_RULES_PLAIN"])) { $_FORUM_RULES_PLAIN_ = $context["FORUM_RULES_PLAIN"]; } else { $_FORUM_RULES_PLAIN_ = null; }
            echo $_FORUM_RULES_PLAIN_;
            echo "</textarea></dd>
\t\t\t<dd><label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_bbcode\"";
            // line 339
            if (isset($context["S_BBCODE_CHECKED"])) { $_S_BBCODE_CHECKED_ = $context["S_BBCODE_CHECKED"]; } else { $_S_BBCODE_CHECKED_ = null; }
            if ($_S_BBCODE_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_BBCODE");
            echo "</label>
\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_smilies\"";
            // line 340
            if (isset($context["S_SMILIES_CHECKED"])) { $_S_SMILIES_CHECKED_ = $context["S_SMILIES_CHECKED"]; } else { $_S_SMILIES_CHECKED_ = null; }
            if ($_S_SMILIES_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_SMILIES");
            echo "</label>
\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"rules_parse_urls\"";
            // line 341
            if (isset($context["S_URLS_CHECKED"])) { $_S_URLS_CHECKED_ = $context["S_URLS_CHECKED"]; } else { $_S_URLS_CHECKED_ = null; }
            if ($_S_URLS_CHECKED_) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("PARSE_URLS");
            echo "</label></dd>
\t\t</dl>
\t\t";
            // line 343
            if (isset($context["acp_forums_rules_settings_append"])) { $_acp_forums_rules_settings_append_ = $context["acp_forums_rules_settings_append"]; } else { $_acp_forums_rules_settings_append_ = null; }
            // line 344
            echo "\t\t</fieldset>
\t</div>

\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
            // line 348
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"update\" value=\"";
            // line 349
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 350
            echo $this->env->getExtension('phpbb')->lang("RESET");
            echo "\" />
\t\t";
            // line 351
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>
\t</form>

";
        } elseif ($_S_DELETE_FORUM_) {
            // line 356
            echo "
\t<a href=\"";
            // line 357
            if (isset($context["U_BACK"])) { $_U_BACK_ = $context["U_BACK"]; } else { $_U_BACK_ = null; }
            echo $_U_BACK_;
            echo "\" style=\"float: ";
            if (isset($context["S_CONTENT_FLOW_END"])) { $_S_CONTENT_FLOW_END_ = $context["S_CONTENT_FLOW_END"]; } else { $_S_CONTENT_FLOW_END_ = null; }
            echo $_S_CONTENT_FLOW_END_;
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 359
            echo $this->env->getExtension('phpbb')->lang("FORUM_DELETE");
            echo "</h1>

\t<p>";
            // line 361
            echo $this->env->getExtension('phpbb')->lang("FORUM_DELETE_EXPLAIN");
            echo "</p>

\t";
            // line 363
            if (isset($context["S_ERROR"])) { $_S_ERROR_ = $context["S_ERROR"]; } else { $_S_ERROR_ = null; }
            if ($_S_ERROR_) {
                // line 364
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 365
                echo $this->env->getExtension('phpbb')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 366
                if (isset($context["ERROR_MSG"])) { $_ERROR_MSG_ = $context["ERROR_MSG"]; } else { $_ERROR_MSG_ = null; }
                echo $_ERROR_MSG_;
                echo "</p>
\t\t</div>
\t";
            }
            // line 369
            echo "
\t<form id=\"acp_forum\" method=\"post\" action=\"";
            // line 370
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 373
            echo $this->env->getExtension('phpbb')->lang("FORUM_DELETE");
            echo "</legend>
\t<dl>
\t\t<dt><label>";
            // line 375
            echo $this->env->getExtension('phpbb')->lang("FORUM_NAME");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 376
            if (isset($context["FORUM_NAME"])) { $_FORUM_NAME_ = $context["FORUM_NAME"]; } else { $_FORUM_NAME_ = null; }
            echo $_FORUM_NAME_;
            echo "</strong></dd>
\t</dl>
\t";
            // line 378
            if (isset($context["S_FORUM_POST"])) { $_S_FORUM_POST_ = $context["S_FORUM_POST"]; } else { $_S_FORUM_POST_ = null; }
            if ($_S_FORUM_POST_) {
                // line 379
                echo "\t\t<dl>
\t\t\t<dt><label for=\"delete_action\">";
                // line 380
                echo $this->env->getExtension('phpbb')->lang("ACTION");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"delete_action\" name=\"action_posts\" value=\"delete\" checked=\"checked\" /> ";
                // line 381
                echo $this->env->getExtension('phpbb')->lang("DELETE_ALL_POSTS");
                echo "</label></dd>
\t\t\t";
                // line 382
                if (isset($context["S_MOVE_FORUM_OPTIONS"])) { $_S_MOVE_FORUM_OPTIONS_ = $context["S_MOVE_FORUM_OPTIONS"]; } else { $_S_MOVE_FORUM_OPTIONS_ = null; }
                if ($_S_MOVE_FORUM_OPTIONS_) {
                    // line 383
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"action_posts\" value=\"move\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("MOVE_POSTS_TO");
                    echo "</label> <select name=\"posts_to_id\">";
                    if (isset($context["S_MOVE_FORUM_OPTIONS"])) { $_S_MOVE_FORUM_OPTIONS_ = $context["S_MOVE_FORUM_OPTIONS"]; } else { $_S_MOVE_FORUM_OPTIONS_ = null; }
                    echo $_S_MOVE_FORUM_OPTIONS_;
                    echo "</select></dd>
\t\t\t";
                }
                // line 385
                echo "\t\t</dl>
\t";
            }
            // line 387
            echo "\t";
            if (isset($context["S_HAS_SUBFORUMS"])) { $_S_HAS_SUBFORUMS_ = $context["S_HAS_SUBFORUMS"]; } else { $_S_HAS_SUBFORUMS_ = null; }
            if ($_S_HAS_SUBFORUMS_) {
                // line 388
                echo "\t\t<dl>
\t\t\t<dt><label for=\"sub_delete_action\">";
                // line 389
                echo $this->env->getExtension('phpbb')->lang("ACTION");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"sub_delete_action\" name=\"action_subforums\" value=\"delete\" checked=\"checked\" /> ";
                // line 390
                echo $this->env->getExtension('phpbb')->lang("DELETE_SUBFORUMS");
                echo "</label></dd>
\t\t\t";
                // line 391
                if (isset($context["S_FORUMS_LIST"])) { $_S_FORUMS_LIST_ = $context["S_FORUMS_LIST"]; } else { $_S_FORUMS_LIST_ = null; }
                if ($_S_FORUMS_LIST_) {
                    // line 392
                    echo "\t\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"action_subforums\" value=\"move\" /> ";
                    echo $this->env->getExtension('phpbb')->lang("MOVE_SUBFORUMS_TO");
                    echo "</label> <select name=\"subforums_to_id\">";
                    if (isset($context["S_FORUMS_LIST"])) { $_S_FORUMS_LIST_ = $context["S_FORUMS_LIST"]; } else { $_S_FORUMS_LIST_ = null; }
                    echo $_S_FORUMS_LIST_;
                    echo "</select></dd>
\t\t\t";
                }
                // line 394
                echo "\t\t</dl>
\t";
            }
            // line 396
            echo "
\t<p class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
            // line 398
            echo $this->env->getExtension('phpbb')->lang("SUBMIT");
            echo "\" />
\t</p>
\t";
            // line 400
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>
\t</form>

";
        } elseif ($_S_CONTINUE_SYNC_) {
            // line 405
            echo "
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\tvar close_waitscreen = 0;
\t\t// no scrollbars...
\t\tpopup('";
            // line 410
            if (isset($context["UA_PROGRESS_BAR"])) { $_UA_PROGRESS_BAR_ = $context["UA_PROGRESS_BAR"]; } else { $_UA_PROGRESS_BAR_ = null; }
            echo $_UA_PROGRESS_BAR_;
            echo "', 400, 240, '_sync');
\t// ]]>
\t</script>

\t<h1>";
            // line 414
            echo $this->env->getExtension('phpbb')->lang("FORUM_ADMIN");
            echo "</h1>

\t<p>";
            // line 416
            echo $this->env->getExtension('phpbb')->lang("FORUM_ADMIN_EXPLAIN");
            echo "</p>

\t<p>";
            // line 418
            echo $this->env->getExtension('phpbb')->lang("PROGRESS_EXPLAIN");
            echo "</p>

";
        } else {
            // line 421
            echo "
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\t/**
\t\t* Popup search progress bar
\t\t*/
\t\tfunction popup_progress_bar()
\t\t{
\t\t\tvar close_waitscreen = 0;
\t\t\t// no scrollbars...
\t\t\tpopup('";
            // line 431
            if (isset($context["UA_PROGRESS_BAR"])) { $_UA_PROGRESS_BAR_ = $context["UA_PROGRESS_BAR"]; } else { $_UA_PROGRESS_BAR_ = null; }
            echo $_UA_PROGRESS_BAR_;
            echo "', 400, 240, '_sync');
\t\t}
\t// ]]>
\t</script>

\t<h1>";
            // line 436
            echo $this->env->getExtension('phpbb')->lang("FORUM_ADMIN");
            echo "</h1>

\t<p>";
            // line 438
            echo $this->env->getExtension('phpbb')->lang("FORUM_ADMIN_EXPLAIN");
            echo "</p>

\t";
            // line 440
            if (isset($context["ERROR_MSG"])) { $_ERROR_MSG_ = $context["ERROR_MSG"]; } else { $_ERROR_MSG_ = null; }
            if ($_ERROR_MSG_) {
                // line 441
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 442
                echo $this->env->getExtension('phpbb')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 443
                if (isset($context["ERROR_MSG"])) { $_ERROR_MSG_ = $context["ERROR_MSG"]; } else { $_ERROR_MSG_ = null; }
                echo $_ERROR_MSG_;
                echo "</p>
\t\t</div>
\t";
            }
            // line 446
            echo "
\t";
            // line 447
            if (isset($context["S_RESYNCED"])) { $_S_RESYNCED_ = $context["S_RESYNCED"]; } else { $_S_RESYNCED_ = null; }
            if ($_S_RESYNCED_) {
                // line 448
                echo "\t\t<script type=\"text/javascript\">
\t\t// <![CDATA[
\t\t\tvar close_waitscreen = 1;
\t\t// ]]>
\t\t</script>

\t\t<div class=\"successbox\">
\t\t\t<h3>";
                // line 455
                echo $this->env->getExtension('phpbb')->lang("NOTIFY");
                echo "</h3>
\t\t\t<p>";
                // line 456
                echo $this->env->getExtension('phpbb')->lang("FORUM_RESYNCED");
                echo "</p>
\t\t</div>
\t";
            }
            // line 459
            echo "
\t<p><strong>";
            // line 460
            if (isset($context["NAVIGATION"])) { $_NAVIGATION_ = $context["NAVIGATION"]; } else { $_NAVIGATION_ = null; }
            echo $_NAVIGATION_;
            if (isset($context["S_NO_FORUMS"])) { $_S_NO_FORUMS_ = $context["S_NO_FORUMS"]; } else { $_S_NO_FORUMS_ = null; }
            if ($_S_NO_FORUMS_) {
                echo " [<a href=\"";
                if (isset($context["U_EDIT"])) { $_U_EDIT_ = $context["U_EDIT"]; } else { $_U_EDIT_ = null; }
                echo $_U_EDIT_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("EDIT");
                echo "</a> | <a href=\"";
                if (isset($context["U_DELETE"])) { $_U_DELETE_ = $context["U_DELETE"]; } else { $_U_DELETE_ = null; }
                echo $_U_DELETE_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("DELETE");
                echo "</a>";
                if (isset($context["S_LINK"])) { $_S_LINK_ = $context["S_LINK"]; } else { $_S_LINK_ = null; }
                if ((!$_S_LINK_)) {
                    echo " | <a href=\"";
                    if (isset($context["U_SYNC"])) { $_U_SYNC_ = $context["U_SYNC"]; } else { $_U_SYNC_ = null; }
                    echo $_U_SYNC_;
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("RESYNC");
                    echo "</a>";
                }
                echo "]";
            }
            echo "</strong></p>

\t";
            // line 462
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "forums"))) {
                // line 463
                echo "\t\t<table class=\"table1 forums\">
\t\t\t<col class=\"row1\" /><col class=\"row1\" /><col class=\"row2\" />
\t\t<tbody>
\t\t";
                // line 466
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "forums"));
                foreach ($context['_seq'] as $context["_key"] => $context["forums"]) {
                    // line 467
                    echo "\t\t\t<tr>
\t\t\t\t<td class=\"folder\">";
                    // line 468
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    echo $this->getAttribute($_forums_, "FOLDER_IMAGE");
                    echo "</td>
\t\t\t\t<td class=\"forum-desc\">
\t\t\t\t\t";
                    // line 470
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    if ($this->getAttribute($_forums_, "FORUM_IMAGE")) {
                        echo "<div style=\"float: ";
                        if (isset($context["S_CONTENT_FLOW_BEGIN"])) { $_S_CONTENT_FLOW_BEGIN_ = $context["S_CONTENT_FLOW_BEGIN"]; } else { $_S_CONTENT_FLOW_BEGIN_ = null; }
                        echo $_S_CONTENT_FLOW_BEGIN_;
                        echo "; margin-right: 5px;\">";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_IMAGE");
                        echo "</div>";
                    }
                    // line 471
                    echo "\t\t\t\t\t<strong>";
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    if ($this->getAttribute($_forums_, "S_FORUM_LINK")) {
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_NAME");
                    } else {
                        echo "<a href=\"";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "U_FORUM");
                        echo "\">";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_NAME");
                        echo "</a>";
                    }
                    echo "</strong>
\t\t\t\t\t";
                    // line 472
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    if ($this->getAttribute($_forums_, "FORUM_DESCRIPTION")) {
                        echo "<br /><span>";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_DESCRIPTION");
                        echo "</span>";
                    }
                    // line 473
                    echo "\t\t\t\t\t";
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    if ($this->getAttribute($_forums_, "S_FORUM_POST")) {
                        echo "<br /><br /><span>";
                        echo $this->env->getExtension('phpbb')->lang("TOPICS");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " <strong>";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_TOPICS");
                        echo "</strong> / ";
                        echo $this->env->getExtension('phpbb')->lang("POSTS");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " <strong>";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "FORUM_POSTS");
                        echo "</strong></span>";
                    }
                    // line 474
                    echo "\t\t\t\t</td>
\t\t\t\t<td class=\"actions\">
\t\t\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                    // line 476
                    if (isset($context["ICON_MOVE_UP_DISABLED"])) { $_ICON_MOVE_UP_DISABLED_ = $context["ICON_MOVE_UP_DISABLED"]; } else { $_ICON_MOVE_UP_DISABLED_ = null; }
                    echo $_ICON_MOVE_UP_DISABLED_;
                    echo "</span>
\t\t\t\t\t<span class=\"up\"><a href=\"";
                    // line 477
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    echo $this->getAttribute($_forums_, "U_MOVE_UP");
                    echo "\" data-ajax=\"row_up\">";
                    if (isset($context["ICON_MOVE_UP"])) { $_ICON_MOVE_UP_ = $context["ICON_MOVE_UP"]; } else { $_ICON_MOVE_UP_ = null; }
                    echo $_ICON_MOVE_UP_;
                    echo "</a></span>
\t\t\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                    // line 478
                    if (isset($context["ICON_MOVE_DOWN_DISABLED"])) { $_ICON_MOVE_DOWN_DISABLED_ = $context["ICON_MOVE_DOWN_DISABLED"]; } else { $_ICON_MOVE_DOWN_DISABLED_ = null; }
                    echo $_ICON_MOVE_DOWN_DISABLED_;
                    echo "</span>
\t\t\t\t\t<span class=\"down\"><a href=\"";
                    // line 479
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    echo $this->getAttribute($_forums_, "U_MOVE_DOWN");
                    echo "\" data-ajax=\"row_down\">";
                    if (isset($context["ICON_MOVE_DOWN"])) { $_ICON_MOVE_DOWN_ = $context["ICON_MOVE_DOWN"]; } else { $_ICON_MOVE_DOWN_ = null; }
                    echo $_ICON_MOVE_DOWN_;
                    echo "</a></span>
\t\t\t\t\t<a href=\"";
                    // line 480
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    echo $this->getAttribute($_forums_, "U_EDIT");
                    echo "\">";
                    if (isset($context["ICON_EDIT"])) { $_ICON_EDIT_ = $context["ICON_EDIT"]; } else { $_ICON_EDIT_ = null; }
                    echo $_ICON_EDIT_;
                    echo "</a>
\t\t\t\t\t";
                    // line 481
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    if ((!$this->getAttribute($_forums_, "S_FORUM_LINK"))) {
                        // line 482
                        echo "\t\t\t\t\t\t<a href=\"";
                        if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                        echo $this->getAttribute($_forums_, "U_SYNC");
                        echo "\" onclick=\"popup_progress_bar();\">";
                        if (isset($context["ICON_SYNC"])) { $_ICON_SYNC_ = $context["ICON_SYNC"]; } else { $_ICON_SYNC_ = null; }
                        echo $_ICON_SYNC_;
                        echo "</a>
\t\t\t\t\t";
                    } else {
                        // line 484
                        echo "\t\t\t\t\t\t";
                        if (isset($context["ICON_SYNC_DISABLED"])) { $_ICON_SYNC_DISABLED_ = $context["ICON_SYNC_DISABLED"]; } else { $_ICON_SYNC_DISABLED_ = null; }
                        echo $_ICON_SYNC_DISABLED_;
                        echo "
\t\t\t\t\t";
                    }
                    // line 486
                    echo "\t\t\t\t\t<a href=\"";
                    if (isset($context["forums"])) { $_forums_ = $context["forums"]; } else { $_forums_ = null; }
                    echo $this->getAttribute($_forums_, "U_DELETE");
                    echo "\">";
                    if (isset($context["ICON_DELETE"])) { $_ICON_DELETE_ = $context["ICON_DELETE"]; } else { $_ICON_DELETE_ = null; }
                    echo $_ICON_DELETE_;
                    echo "</a>
\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forums'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 490
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 493
            echo "
\t<form id=\"fselect\" method=\"post\" action=\"";
            // line 494
            if (isset($context["U_SEL_ACTION"])) { $_U_SEL_ACTION_ = $context["U_SEL_ACTION"]; } else { $_U_SEL_ACTION_ = null; }
            echo $_U_SEL_ACTION_;
            echo "\">

\t<fieldset class=\"quick\">
\t\t";
            // line 497
            echo $this->env->getExtension('phpbb')->lang("SELECT_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <select name=\"parent_id\" onchange=\"if(this.options[this.selectedIndex].value != -1){ this.form.submit(); }\">";
            if (isset($context["FORUM_BOX"])) { $_FORUM_BOX_ = $context["FORUM_BOX"]; } else { $_FORUM_BOX_ = null; }
            echo $_FORUM_BOX_;
            echo "</select>

\t\t<input class=\"button2\" type=\"submit\" value=\"";
            // line 499
            echo $this->env->getExtension('phpbb')->lang("GO");
            echo "\" />
\t\t";
            // line 500
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>
\t</form>

\t<form id=\"forums\" method=\"post\" action=\"";
            // line 504
            if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
            echo $_U_ACTION_;
            echo "\">

\t<fieldset class=\"quick\">
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />

\t\t<input type=\"text\" name=\"forum_name\" value=\"\" maxlength=\"255\" />
\t\t<input class=\"button2\" name=\"addforum\" type=\"submit\" value=\"";
            // line 510
            echo $this->env->getExtension('phpbb')->lang("CREATE_FORUM");
            echo "\" />
\t\t";
            // line 511
            if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
            echo $_S_FORM_TOKEN_;
            echo "
\t</fieldset>
\t</form>

";
        }
        // line 516
        echo "
";
        // line 517
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
        return "acp_forums.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1741 => 517,  1738 => 516,  1729 => 511,  1725 => 510,  1715 => 504,  1707 => 500,  1703 => 499,  1694 => 497,  1687 => 494,  1684 => 493,  1679 => 490,  1664 => 486,  1657 => 484,  1647 => 482,  1644 => 481,  1636 => 480,  1628 => 479,  1623 => 478,  1615 => 477,  1610 => 476,  1606 => 474,  1588 => 473,  1580 => 472,  1563 => 471,  1552 => 470,  1546 => 468,  1543 => 467,  1538 => 466,  1533 => 463,  1530 => 462,  1500 => 460,  1497 => 459,  1491 => 456,  1487 => 455,  1478 => 448,  1475 => 447,  1472 => 446,  1465 => 443,  1461 => 442,  1458 => 441,  1455 => 440,  1450 => 438,  1445 => 436,  1436 => 431,  1424 => 421,  1418 => 418,  1413 => 416,  1408 => 414,  1400 => 410,  1393 => 405,  1384 => 400,  1379 => 398,  1375 => 396,  1371 => 394,  1362 => 392,  1359 => 391,  1355 => 390,  1350 => 389,  1347 => 388,  1343 => 387,  1339 => 385,  1330 => 383,  1327 => 382,  1323 => 381,  1318 => 380,  1315 => 379,  1312 => 378,  1306 => 376,  1301 => 375,  1296 => 373,  1289 => 370,  1286 => 369,  1279 => 366,  1275 => 365,  1272 => 364,  1269 => 363,  1264 => 361,  1259 => 359,  1248 => 357,  1245 => 356,  1236 => 351,  1232 => 350,  1228 => 349,  1224 => 348,  1218 => 344,  1216 => 343,  1206 => 341,  1197 => 340,  1188 => 339,  1183 => 338,  1176 => 337,  1173 => 336,  1166 => 333,  1161 => 332,  1158 => 331,  1155 => 330,  1149 => 328,  1142 => 327,  1139 => 326,  1137 => 325,  1133 => 324,  1118 => 317,  1109 => 316,  1102 => 315,  1095 => 312,  1088 => 311,  1077 => 308,  1068 => 307,  1061 => 306,  1056 => 304,  1049 => 299,  1047 => 298,  1039 => 296,  1032 => 295,  1023 => 292,  1016 => 291,  1005 => 288,  996 => 287,  989 => 286,  978 => 283,  969 => 282,  964 => 281,  953 => 278,  944 => 277,  939 => 276,  928 => 273,  919 => 272,  912 => 271,  903 => 268,  896 => 267,  887 => 264,  880 => 263,  871 => 260,  864 => 259,  853 => 256,  844 => 255,  837 => 254,  834 => 253,  832 => 252,  828 => 251,  823 => 248,  821 => 247,  815 => 245,  808 => 244,  797 => 241,  788 => 240,  781 => 239,  770 => 236,  761 => 235,  756 => 234,  745 => 231,  736 => 230,  729 => 229,  718 => 226,  709 => 225,  702 => 224,  691 => 221,  682 => 220,  675 => 219,  664 => 216,  655 => 215,  648 => 214,  637 => 211,  628 => 210,  621 => 209,  614 => 206,  609 => 205,  606 => 204,  604 => 203,  600 => 202,  585 => 195,  576 => 194,  569 => 193,  564 => 191,  558 => 187,  556 => 186,  548 => 184,  543 => 183,  540 => 182,  530 => 178,  527 => 177,  524 => 176,  516 => 174,  509 => 173,  500 => 170,  493 => 169,  489 => 167,  480 => 165,  477 => 164,  472 => 163,  465 => 162,  454 => 159,  445 => 158,  436 => 157,  431 => 156,  424 => 155,  417 => 152,  412 => 151,  409 => 150,  400 => 147,  393 => 146,  390 => 145,  387 => 144,  374 => 142,  369 => 141,  366 => 140,  361 => 137,  355 => 135,  346 => 133,  343 => 132,  338 => 131,  334 => 129,  328 => 128,  323 => 125,  313 => 124,  304 => 123,  299 => 122,  295 => 120,  291 => 119,  285 => 117,  280 => 116,  277 => 115,  275 => 114,  271 => 113,  264 => 110,  261 => 109,  254 => 106,  250 => 105,  247 => 104,  244 => 103,  239 => 101,  227 => 99,  216 => 97,  209 => 92,  205 => 90,  202 => 89,  199 => 88,  195 => 86,  192 => 85,  189 => 84,  185 => 82,  182 => 81,  179 => 80,  175 => 78,  172 => 77,  169 => 76,  166 => 75,  162 => 73,  158 => 72,  153 => 71,  150 => 70,  147 => 69,  143 => 67,  139 => 66,  135 => 65,  116 => 50,  105 => 43,  94 => 36,  91 => 35,  77 => 26,  72 => 25,  69 => 24,  55 => 15,  51 => 14,  41 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }
}
