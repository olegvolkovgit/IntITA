<?php

/* acp_main.html */
class __TwigTemplate_31662a28c44e70d60d0f11b524681065 extends Twig_Template
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
        if (isset($context["S_RESTORE_PERMISSIONS"])) { $_S_RESTORE_PERMISSIONS_ = $context["S_RESTORE_PERMISSIONS"]; } else { $_S_RESTORE_PERMISSIONS_ = null; }
        if ($_S_RESTORE_PERMISSIONS_) {
            // line 6
            echo "
\t<h1>";
            // line 7
            echo $this->env->getExtension('phpbb')->lang("PERMISSIONS_TRANSFERRED");
            echo "</h1>

\t<p>";
            // line 9
            echo $this->env->getExtension('phpbb')->lang("PERMISSIONS_TRANSFERRED_EXPLAIN");
            echo "</p>

";
        } else {
            // line 12
            echo "
\t<h1>";
            // line 13
            echo $this->env->getExtension('phpbb')->lang("WELCOME_PHPBB");
            echo "</h1>

\t<p>";
            // line 15
            echo $this->env->getExtension('phpbb')->lang("ADMIN_INTRO");
            echo "</p>

\t";
            // line 17
            if (isset($context["S_VERSIONCHECK_FAIL"])) { $_S_VERSIONCHECK_FAIL_ = $context["S_VERSIONCHECK_FAIL"]; } else { $_S_VERSIONCHECK_FAIL_ = null; }
            if (isset($context["S_VERSION_UP_TO_DATE"])) { $_S_VERSION_UP_TO_DATE_ = $context["S_VERSION_UP_TO_DATE"]; } else { $_S_VERSION_UP_TO_DATE_ = null; }
            if ($_S_VERSIONCHECK_FAIL_) {
                // line 18
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 19
                echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FAIL");
                echo "</p>
\t\t\t<p>";
                // line 20
                if (isset($context["VERSIONCHECK_FAIL_REASON"])) { $_VERSIONCHECK_FAIL_REASON_ = $context["VERSIONCHECK_FAIL_REASON"]; } else { $_VERSIONCHECK_FAIL_REASON_ = null; }
                echo $_VERSIONCHECK_FAIL_REASON_;
                echo "</p>
\t\t\t<p><a href=\"";
                // line 21
                if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
                echo $_U_VERSIONCHECK_FORCE_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE");
                echo "</a> &middot; <a href=\"";
                if (isset($context["U_VERSIONCHECK"])) { $_U_VERSIONCHECK_ = $context["U_VERSIONCHECK"]; } else { $_U_VERSIONCHECK_ = null; }
                echo $_U_VERSIONCHECK_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MORE_INFORMATION");
                echo "</a></p>
\t\t</div>
\t";
            } elseif ((!$_S_VERSION_UP_TO_DATE_)) {
                // line 24
                echo "\t\t<div class=\"errorbox\">
\t\t\t<p>";
                // line 25
                echo $this->env->getExtension('phpbb')->lang("VERSION_NOT_UP_TO_DATE_TITLE");
                echo "</p>
\t\t\t<p><a href=\"";
                // line 26
                if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
                echo $_U_VERSIONCHECK_FORCE_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE");
                echo "</a> &middot; <a href=\"";
                if (isset($context["U_VERSIONCHECK"])) { $_U_VERSIONCHECK_ = $context["U_VERSIONCHECK"]; } else { $_U_VERSIONCHECK_ = null; }
                echo $_U_VERSIONCHECK_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MORE_INFORMATION");
                echo "</a></p>
\t\t</div>
\t";
            }
            // line 29
            echo "
\t";
            // line 30
            if (isset($context["S_SEARCH_INDEX_MISSING"])) { $_S_SEARCH_INDEX_MISSING_ = $context["S_SEARCH_INDEX_MISSING"]; } else { $_S_SEARCH_INDEX_MISSING_ = null; }
            if ($_S_SEARCH_INDEX_MISSING_) {
                // line 31
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 32
                echo $this->env->getExtension('phpbb')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 33
                echo $this->env->getExtension('phpbb')->lang("NO_SEARCH_INDEX");
                echo "</p>
\t\t</div>
\t";
            }
            // line 36
            echo "
\t";
            // line 37
            if (isset($context["S_REMOVE_INSTALL"])) { $_S_REMOVE_INSTALL_ = $context["S_REMOVE_INSTALL"]; } else { $_S_REMOVE_INSTALL_ = null; }
            if ($_S_REMOVE_INSTALL_) {
                // line 38
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 39
                echo $this->env->getExtension('phpbb')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 40
                echo $this->env->getExtension('phpbb')->lang("REMOVE_INSTALL");
                echo "</p>
\t\t</div>
\t";
            }
            // line 43
            echo "
\t";
            // line 44
            if (isset($context["S_MBSTRING_LOADED"])) { $_S_MBSTRING_LOADED_ = $context["S_MBSTRING_LOADED"]; } else { $_S_MBSTRING_LOADED_ = null; }
            if ($_S_MBSTRING_LOADED_) {
                // line 45
                echo "\t\t";
                if (isset($context["S_MBSTRING_FUNC_OVERLOAD_FAIL"])) { $_S_MBSTRING_FUNC_OVERLOAD_FAIL_ = $context["S_MBSTRING_FUNC_OVERLOAD_FAIL"]; } else { $_S_MBSTRING_FUNC_OVERLOAD_FAIL_ = null; }
                if ($_S_MBSTRING_FUNC_OVERLOAD_FAIL_) {
                    // line 46
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 47
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_FUNC_OVERLOAD");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 48
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_FUNC_OVERLOAD_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 51
                echo "
\t\t";
                // line 52
                if (isset($context["S_MBSTRING_ENCODING_TRANSLATION_FAIL"])) { $_S_MBSTRING_ENCODING_TRANSLATION_FAIL_ = $context["S_MBSTRING_ENCODING_TRANSLATION_FAIL"]; } else { $_S_MBSTRING_ENCODING_TRANSLATION_FAIL_ = null; }
                if ($_S_MBSTRING_ENCODING_TRANSLATION_FAIL_) {
                    // line 53
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 54
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_ENCODING_TRANSLATION");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 55
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_ENCODING_TRANSLATION_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 58
                echo "
\t\t";
                // line 59
                if (isset($context["S_MBSTRING_HTTP_INPUT_FAIL"])) { $_S_MBSTRING_HTTP_INPUT_FAIL_ = $context["S_MBSTRING_HTTP_INPUT_FAIL"]; } else { $_S_MBSTRING_HTTP_INPUT_FAIL_ = null; }
                if ($_S_MBSTRING_HTTP_INPUT_FAIL_) {
                    // line 60
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 61
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_HTTP_INPUT");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 62
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_HTTP_INPUT_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 65
                echo "
\t\t";
                // line 66
                if (isset($context["S_MBSTRING_HTTP_OUTPUT_FAIL"])) { $_S_MBSTRING_HTTP_OUTPUT_FAIL_ = $context["S_MBSTRING_HTTP_OUTPUT_FAIL"]; } else { $_S_MBSTRING_HTTP_OUTPUT_FAIL_ = null; }
                if ($_S_MBSTRING_HTTP_OUTPUT_FAIL_) {
                    // line 67
                    echo "\t\t\t<div class=\"errorbox\">
\t\t\t\t<h3>";
                    // line 68
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_HTTP_OUTPUT");
                    echo "</h3>
\t\t\t\t<p>";
                    // line 69
                    echo $this->env->getExtension('phpbb')->lang("ERROR_MBSTRING_HTTP_OUTPUT_EXPLAIN");
                    echo "</p>
\t\t\t</div>
\t\t";
                }
                // line 72
                echo "\t";
            }
            // line 73
            echo "
\t";
            // line 74
            if (isset($context["S_WRITABLE_CONFIG"])) { $_S_WRITABLE_CONFIG_ = $context["S_WRITABLE_CONFIG"]; } else { $_S_WRITABLE_CONFIG_ = null; }
            if ($_S_WRITABLE_CONFIG_) {
                // line 75
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 76
                echo $this->env->getExtension('phpbb')->lang("WRITABLE_CONFIG");
                echo "</p>
\t\t</div>
\t";
            }
            // line 79
            echo "
\t";
            // line 80
            if (isset($context["S_PHP_VERSION_OLD"])) { $_S_PHP_VERSION_OLD_ = $context["S_PHP_VERSION_OLD"]; } else { $_S_PHP_VERSION_OLD_ = null; }
            if ($_S_PHP_VERSION_OLD_) {
                // line 81
                echo "\t\t<div class=\"errorbox notice\">
\t\t\t<p>";
                // line 82
                echo $this->env->getExtension('phpbb')->lang("PHP_VERSION_OLD");
                echo "</p>
\t\t</div>
\t";
            }
            // line 85
            echo "
\t";
            // line 86
            if (isset($context["acp_main_notice_after"])) { $_acp_main_notice_after_ = $context["acp_main_notice_after"]; } else { $_acp_main_notice_after_ = null; }
            // line 87
            echo "
\t<table class=\"table1 two-columns no-header\" data-no-responsive-header=\"true\">
\t\t<caption>";
            // line 89
            echo $this->env->getExtension('phpbb')->lang("FORUM_STATS");
            echo "</caption>
\t\t<col class=\"col1\" /><col class=\"col2\" /><col class=\"col1\" /><col class=\"col2\" />
\t<thead>
\t<tr>
\t\t<th>";
            // line 93
            echo $this->env->getExtension('phpbb')->lang("STATISTIC");
            echo "</th>
\t\t<th>";
            // line 94
            echo $this->env->getExtension('phpbb')->lang("VALUE");
            echo "</th>
\t\t<th>";
            // line 95
            echo $this->env->getExtension('phpbb')->lang("STATISTIC");
            echo "</th>
\t\t<th>";
            // line 96
            echo $this->env->getExtension('phpbb')->lang("VALUE");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t<tr>
\t\t<td>";
            // line 101
            echo $this->env->getExtension('phpbb')->lang("NUMBER_POSTS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 102
            if (isset($context["TOTAL_POSTS"])) { $_TOTAL_POSTS_ = $context["TOTAL_POSTS"]; } else { $_TOTAL_POSTS_ = null; }
            echo $_TOTAL_POSTS_;
            echo "</strong></td>
\t\t<td>";
            // line 103
            echo $this->env->getExtension('phpbb')->lang("POSTS_PER_DAY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 104
            if (isset($context["POSTS_PER_DAY"])) { $_POSTS_PER_DAY_ = $context["POSTS_PER_DAY"]; } else { $_POSTS_PER_DAY_ = null; }
            echo $_POSTS_PER_DAY_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 107
            echo $this->env->getExtension('phpbb')->lang("NUMBER_TOPICS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 108
            if (isset($context["TOTAL_TOPICS"])) { $_TOTAL_TOPICS_ = $context["TOTAL_TOPICS"]; } else { $_TOTAL_TOPICS_ = null; }
            echo $_TOTAL_TOPICS_;
            echo "</strong></td>
\t\t<td>";
            // line 109
            echo $this->env->getExtension('phpbb')->lang("TOPICS_PER_DAY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 110
            if (isset($context["TOPICS_PER_DAY"])) { $_TOPICS_PER_DAY_ = $context["TOPICS_PER_DAY"]; } else { $_TOPICS_PER_DAY_ = null; }
            echo $_TOPICS_PER_DAY_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 113
            echo $this->env->getExtension('phpbb')->lang("NUMBER_USERS");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 114
            if (isset($context["TOTAL_USERS"])) { $_TOTAL_USERS_ = $context["TOTAL_USERS"]; } else { $_TOTAL_USERS_ = null; }
            echo $_TOTAL_USERS_;
            echo "</strong></td>
\t\t<td>";
            // line 115
            echo $this->env->getExtension('phpbb')->lang("USERS_PER_DAY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 116
            if (isset($context["USERS_PER_DAY"])) { $_USERS_PER_DAY_ = $context["USERS_PER_DAY"]; } else { $_USERS_PER_DAY_ = null; }
            echo $_USERS_PER_DAY_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 119
            echo $this->env->getExtension('phpbb')->lang("NUMBER_FILES");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 120
            if (isset($context["TOTAL_FILES"])) { $_TOTAL_FILES_ = $context["TOTAL_FILES"]; } else { $_TOTAL_FILES_ = null; }
            echo $_TOTAL_FILES_;
            echo "</strong></td>
\t\t<td>";
            // line 121
            echo $this->env->getExtension('phpbb')->lang("FILES_PER_DAY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 122
            if (isset($context["FILES_PER_DAY"])) { $_FILES_PER_DAY_ = $context["FILES_PER_DAY"]; } else { $_FILES_PER_DAY_ = null; }
            echo $_FILES_PER_DAY_;
            echo "</strong></td>
\t</tr>


\t<tr>
\t\t<td>";
            // line 127
            echo $this->env->getExtension('phpbb')->lang("BOARD_STARTED");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 128
            if (isset($context["START_DATE"])) { $_START_DATE_ = $context["START_DATE"]; } else { $_START_DATE_ = null; }
            echo $_START_DATE_;
            echo "</strong></td>
\t\t<td>";
            // line 129
            echo $this->env->getExtension('phpbb')->lang("AVATAR_DIR_SIZE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 130
            if (isset($context["AVATAR_DIR_SIZE"])) { $_AVATAR_DIR_SIZE_ = $context["AVATAR_DIR_SIZE"]; } else { $_AVATAR_DIR_SIZE_ = null; }
            echo $_AVATAR_DIR_SIZE_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 133
            echo $this->env->getExtension('phpbb')->lang("DATABASE_SIZE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 134
            if (isset($context["DBSIZE"])) { $_DBSIZE_ = $context["DBSIZE"]; } else { $_DBSIZE_ = null; }
            echo $_DBSIZE_;
            echo "</strong></td>
\t\t<td>";
            // line 135
            echo $this->env->getExtension('phpbb')->lang("UPLOAD_DIR_SIZE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 136
            if (isset($context["UPLOAD_DIR_SIZE"])) { $_UPLOAD_DIR_SIZE_ = $context["UPLOAD_DIR_SIZE"]; } else { $_UPLOAD_DIR_SIZE_ = null; }
            echo $_UPLOAD_DIR_SIZE_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 139
            echo $this->env->getExtension('phpbb')->lang("DATABASE_SERVER_INFO");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 140
            if (isset($context["DATABASE_INFO"])) { $_DATABASE_INFO_ = $context["DATABASE_INFO"]; } else { $_DATABASE_INFO_ = null; }
            echo $_DATABASE_INFO_;
            echo "</strong></td>
\t\t<td>";
            // line 141
            echo $this->env->getExtension('phpbb')->lang("GZIP_COMPRESSION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td><strong>";
            // line 142
            if (isset($context["GZIP_COMPRESSION"])) { $_GZIP_COMPRESSION_ = $context["GZIP_COMPRESSION"]; } else { $_GZIP_COMPRESSION_ = null; }
            echo $_GZIP_COMPRESSION_;
            echo "</strong></td>
\t</tr>
\t<tr>
\t\t<td>";
            // line 145
            echo $this->env->getExtension('phpbb')->lang("BOARD_VERSION");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " </td>
\t\t<td>
\t\t\t<strong><a href=\"";
            // line 147
            if (isset($context["U_VERSIONCHECK"])) { $_U_VERSIONCHECK_ = $context["U_VERSIONCHECK"]; } else { $_U_VERSIONCHECK_ = null; }
            echo $_U_VERSIONCHECK_;
            echo "\" ";
            if (isset($context["S_VERSION_UP_TO_DATE"])) { $_S_VERSION_UP_TO_DATE_ = $context["S_VERSION_UP_TO_DATE"]; } else { $_S_VERSION_UP_TO_DATE_ = null; }
            if ($_S_VERSION_UP_TO_DATE_) {
                echo "style=\"color: #228822;\"";
            } else {
                echo "style=\"color: #BC2A4D;\"";
            }
            echo " title=\"";
            echo $this->env->getExtension('phpbb')->lang("MORE_INFORMATION");
            echo "\">";
            if (isset($context["BOARD_VERSION"])) { $_BOARD_VERSION_ = $context["BOARD_VERSION"]; } else { $_BOARD_VERSION_ = null; }
            echo $_BOARD_VERSION_;
            echo "</a></strong> [&nbsp;<a href=\"";
            if (isset($context["U_VERSIONCHECK_FORCE"])) { $_U_VERSIONCHECK_FORCE_ = $context["U_VERSIONCHECK_FORCE"]; } else { $_U_VERSIONCHECK_FORCE_ = null; }
            echo $_U_VERSIONCHECK_FORCE_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("VERSIONCHECK_FORCE_UPDATE");
            echo "</a>&nbsp;]
\t\t</td>
\t";
            // line 149
            if (isset($context["S_TOTAL_ORPHAN"])) { $_S_TOTAL_ORPHAN_ = $context["S_TOTAL_ORPHAN"]; } else { $_S_TOTAL_ORPHAN_ = null; }
            if ($_S_TOTAL_ORPHAN_) {
                // line 150
                echo "\t\t<td>";
                echo $this->env->getExtension('phpbb')->lang("NUMBER_ORPHAN");
                echo $this->env->getExtension('phpbb')->lang("COLON");
                echo " </td>
\t\t<td><strong>";
                // line 151
                if (isset($context["TOTAL_ORPHAN"])) { $_TOTAL_ORPHAN_ = $context["TOTAL_ORPHAN"]; } else { $_TOTAL_ORPHAN_ = null; }
                echo $_TOTAL_ORPHAN_;
                echo "</strong></td>
\t";
            } else {
                // line 153
                echo "\t\t<td>&nbsp;</td>
\t\t<td>&nbsp;</td>
\t";
            }
            // line 156
            echo "\t</tr>
\t</tbody>
\t</table>

\t";
            // line 160
            if (isset($context["S_ACTION_OPTIONS"])) { $_S_ACTION_OPTIONS_ = $context["S_ACTION_OPTIONS"]; } else { $_S_ACTION_OPTIONS_ = null; }
            if ($_S_ACTION_OPTIONS_) {
                // line 161
                echo "\t\t<fieldset>
\t\t\t<legend>";
                // line 162
                echo $this->env->getExtension('phpbb')->lang("STATISTIC_RESYNC_OPTIONS");
                echo "</legend>

\t\t\t<form id=\"action_online_form\" method=\"post\" action=\"";
                // line 164
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_online\">";
                // line 166
                echo $this->env->getExtension('phpbb')->lang("RESET_ONLINE");
                echo "</label><br /><span>&nbsp;</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"online\" /><input class=\"button2\" type=\"submit\" id=\"action_online\" name=\"action_online\" value=\"";
                // line 167
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_date_form\" method=\"post\" action=\"";
                // line 171
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_date\">";
                // line 173
                echo $this->env->getExtension('phpbb')->lang("RESET_DATE");
                echo "</label><br /><span>&nbsp;</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"date\" /><input class=\"button2\" type=\"submit\" id=\"action_date\" name=\"action_date\" value=\"";
                // line 174
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_stats_form\" method=\"post\" action=\"";
                // line 178
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_stats\">";
                // line 180
                echo $this->env->getExtension('phpbb')->lang("RESYNC_STATS");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("RESYNC_STATS_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"stats\" /><input class=\"button2\" type=\"submit\" id=\"action_stats\" name=\"action_stats\" value=\"";
                // line 181
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_user_form\" method=\"post\" action=\"";
                // line 185
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_user\">";
                // line 187
                echo $this->env->getExtension('phpbb')->lang("RESYNC_POSTCOUNTS");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("RESYNC_POSTCOUNTS_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"user\" /><input class=\"button2\" type=\"submit\" id=\"action_user\" name=\"action_user\" value=\"";
                // line 188
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t<form id=\"action_db_track_form\" method=\"post\" action=\"";
                // line 192
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_db_track\">";
                // line 194
                echo $this->env->getExtension('phpbb')->lang("RESYNC_POST_MARKING");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("RESYNC_POST_MARKING_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"db_track\" /><input class=\"button2\" type=\"submit\" id=\"action_db_track\" name=\"action_db_track\" value=\"";
                // line 195
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t";
                // line 199
                if (isset($context["S_FOUNDER"])) { $_S_FOUNDER_ = $context["S_FOUNDER"]; } else { $_S_FOUNDER_ = null; }
                if ($_S_FOUNDER_) {
                    // line 200
                    echo "\t\t\t<form id=\"action_purge_sessions_form\" method=\"post\" action=\"";
                    if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                    echo $_U_ACTION_;
                    echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_purge_sessions\">";
                    // line 202
                    echo $this->env->getExtension('phpbb')->lang("PURGE_SESSIONS");
                    echo "</label><br /><span>";
                    echo $this->env->getExtension('phpbb')->lang("PURGE_SESSIONS_EXPLAIN");
                    echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"purge_sessions\" /><input class=\"button2\" type=\"submit\" id=\"action_purge_sessions\" name=\"action_purge_sessions\" value=\"";
                    // line 203
                    echo $this->env->getExtension('phpbb')->lang("RUN");
                    echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>
\t\t\t";
                }
                // line 207
                echo "
\t\t\t<form id=\"action_purge_cache_form\" method=\"post\" action=\"";
                // line 208
                if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
                echo $_U_ACTION_;
                echo "\" data-ajax=\"true\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"action_purge_cache\">";
                // line 210
                echo $this->env->getExtension('phpbb')->lang("PURGE_CACHE");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb')->lang("PURGE_CACHE_EXPLAIN");
                echo "</span></dt>
\t\t\t\t\t<dd><input type=\"hidden\" name=\"action\" value=\"purge_cache\" /><input class=\"button2\" type=\"submit\" id=\"action_purge_cache\" name=\"action_purge_cache\" value=\"";
                // line 211
                echo $this->env->getExtension('phpbb')->lang("RUN");
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</form>

\t\t\t";
                // line 215
                if (isset($context["acp_main_actions_append"])) { $_acp_main_actions_append_ = $context["acp_main_actions_append"]; } else { $_acp_main_actions_append_ = null; }
                // line 216
                echo "  \t\t</fieldset>
\t";
            }
            // line 218
            echo "
\t";
            // line 219
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            if (twig_length_filter($this->env, $this->getAttribute($_loops_, "log"))) {
                // line 220
                echo "\t\t<h2>";
                echo $this->env->getExtension('phpbb')->lang("ADMIN_LOG");
                echo "</h2>

\t\t<p>";
                // line 222
                echo $this->env->getExtension('phpbb')->lang("ADMIN_LOG_INDEX_EXPLAIN");
                echo "</p>

\t\t<div style=\"text-align: right;\"><a href=\"";
                // line 224
                if (isset($context["U_ADMIN_LOG"])) { $_U_ADMIN_LOG_ = $context["U_ADMIN_LOG"]; } else { $_U_ADMIN_LOG_ = null; }
                echo $_U_ADMIN_LOG_;
                echo "\">&raquo; ";
                echo $this->env->getExtension('phpbb')->lang("VIEW_ADMIN_LOG");
                echo "</a></div>

\t\t<table class=\"table1 zebra-table\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 229
                echo $this->env->getExtension('phpbb')->lang("USERNAME");
                echo "</th>
\t\t\t<th>";
                // line 230
                echo $this->env->getExtension('phpbb')->lang("IP");
                echo "</th>
\t\t\t<th>";
                // line 231
                echo $this->env->getExtension('phpbb')->lang("TIME");
                echo "</th>
\t\t\t<th>";
                // line 232
                echo $this->env->getExtension('phpbb')->lang("ACTION");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 236
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "log"));
                foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                    // line 237
                    echo "\t\t\t<tr>
\t\t\t\t<td>";
                    // line 238
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "USERNAME");
                    echo "</td>
\t\t\t\t<td style=\"text-align: center;\">";
                    // line 239
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "IP");
                    echo "</td>
\t\t\t\t<td style=\"text-align: center;\">";
                    // line 240
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "DATE");
                    echo "</td>
\t\t\t\t<td>";
                    // line 241
                    if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
                    echo $this->getAttribute($_log_, "ACTION");
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 244
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 247
            echo "
\t";
            // line 248
            if (isset($context["S_INACTIVE_USERS"])) { $_S_INACTIVE_USERS_ = $context["S_INACTIVE_USERS"]; } else { $_S_INACTIVE_USERS_ = null; }
            if ($_S_INACTIVE_USERS_) {
                // line 249
                echo "\t\t<h2>";
                echo $this->env->getExtension('phpbb')->lang("INACTIVE_USERS");
                echo "</h2>

\t\t<p>";
                // line 251
                echo $this->env->getExtension('phpbb')->lang("INACTIVE_USERS_EXPLAIN_INDEX");
                echo "</p>

\t\t<div style=\"text-align: right;\"><a href=\"";
                // line 253
                if (isset($context["U_INACTIVE_USERS"])) { $_U_INACTIVE_USERS_ = $context["U_INACTIVE_USERS"]; } else { $_U_INACTIVE_USERS_ = null; }
                echo $_U_INACTIVE_USERS_;
                echo "\">&raquo; ";
                echo $this->env->getExtension('phpbb')->lang("VIEW_INACTIVE_USERS");
                echo "</a></div>

\t\t<table class=\"table1 zebra-table\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
                // line 258
                echo $this->env->getExtension('phpbb')->lang("USERNAME");
                echo "</th>
\t\t\t<th>";
                // line 259
                echo $this->env->getExtension('phpbb')->lang("JOINED");
                echo "</th>
\t\t\t<th>";
                // line 260
                echo $this->env->getExtension('phpbb')->lang("INACTIVE_DATE");
                echo "</th>
\t\t\t<th>";
                // line 261
                echo $this->env->getExtension('phpbb')->lang("LAST_VISIT");
                echo "</th>
\t\t\t<th>";
                // line 262
                echo $this->env->getExtension('phpbb')->lang("INACTIVE_REASON");
                echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 266
                if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "inactive"));
                $context['_iterated'] = false;
                foreach ($context['_seq'] as $context["_key"] => $context["inactive"]) {
                    // line 267
                    echo "\t\t\t<tr>
\t\t\t\t<td style=\"vertical-align: top;\">
\t\t\t\t\t";
                    // line 269
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    echo $this->getAttribute($_inactive_, "USERNAME_FULL");
                    echo "
\t\t\t\t\t";
                    // line 270
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    if ($this->getAttribute($_inactive_, "POSTS")) {
                        echo "<br />";
                        echo $this->env->getExtension('phpbb')->lang("POSTS");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " <strong>";
                        if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                        echo $this->getAttribute($_inactive_, "POSTS");
                        echo "</strong> [<a href=\"";
                        if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                        echo $this->getAttribute($_inactive_, "U_SEARCH_USER");
                        echo "\">";
                        echo $this->env->getExtension('phpbb')->lang("SEARCH_USER_POSTS");
                        echo "</a>]";
                    }
                    // line 271
                    echo "\t\t\t\t</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 272
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    echo $this->getAttribute($_inactive_, "JOINED");
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 273
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    echo $this->getAttribute($_inactive_, "INACTIVE_DATE");
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">";
                    // line 274
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    echo $this->getAttribute($_inactive_, "LAST_VISIT");
                    echo "</td>
\t\t\t\t<td style=\"vertical-align: top;\">
\t\t\t\t\t";
                    // line 276
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    echo $this->getAttribute($_inactive_, "REASON");
                    echo "
\t\t\t\t\t";
                    // line 277
                    if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                    if ($this->getAttribute($_inactive_, "REMINDED")) {
                        echo "<br />";
                        if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                        echo $this->getAttribute($_inactive_, "REMINDED_EXPLAIN");
                    }
                    // line 278
                    echo "\t\t\t\t</td>
\t\t\t</tr>
\t\t";
                    $context['_iterated'] = true;
                }
                if (!$context['_iterated']) {
                    // line 281
                    echo "\t\t\t<tr>
\t\t\t\t<td colspan=\"5\" style=\"text-align: center;\">";
                    // line 282
                    echo $this->env->getExtension('phpbb')->lang("NO_INACTIVE_USERS");
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['inactive'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 285
                echo "\t\t</tbody>
\t\t</table>
\t";
            }
            // line 288
            echo "
";
        }
        // line 290
        echo "
";
        // line 291
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
        return "acp_main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  897 => 291,  894 => 290,  890 => 288,  885 => 285,  876 => 282,  873 => 281,  866 => 278,  859 => 277,  854 => 276,  848 => 274,  843 => 273,  838 => 272,  835 => 271,  819 => 270,  814 => 269,  810 => 267,  804 => 266,  797 => 262,  793 => 261,  789 => 260,  785 => 259,  781 => 258,  770 => 253,  765 => 251,  759 => 249,  756 => 248,  753 => 247,  748 => 244,  738 => 241,  733 => 240,  728 => 239,  723 => 238,  720 => 237,  715 => 236,  708 => 232,  704 => 231,  700 => 230,  696 => 229,  685 => 224,  680 => 222,  674 => 220,  671 => 219,  668 => 218,  664 => 216,  662 => 215,  655 => 211,  649 => 210,  643 => 208,  640 => 207,  633 => 203,  627 => 202,  620 => 200,  617 => 199,  610 => 195,  604 => 194,  598 => 192,  591 => 188,  585 => 187,  579 => 185,  572 => 181,  566 => 180,  560 => 178,  553 => 174,  549 => 173,  543 => 171,  536 => 167,  532 => 166,  526 => 164,  521 => 162,  518 => 161,  515 => 160,  509 => 156,  504 => 153,  498 => 151,  492 => 150,  489 => 149,  466 => 147,  460 => 145,  453 => 142,  448 => 141,  443 => 140,  438 => 139,  431 => 136,  426 => 135,  421 => 134,  416 => 133,  409 => 130,  404 => 129,  399 => 128,  394 => 127,  385 => 122,  380 => 121,  375 => 120,  370 => 119,  363 => 116,  358 => 115,  353 => 114,  348 => 113,  341 => 110,  336 => 109,  331 => 108,  326 => 107,  319 => 104,  314 => 103,  309 => 102,  304 => 101,  296 => 96,  292 => 95,  288 => 94,  284 => 93,  277 => 89,  273 => 87,  271 => 86,  268 => 85,  262 => 82,  259 => 81,  256 => 80,  253 => 79,  247 => 76,  244 => 75,  241 => 74,  238 => 73,  235 => 72,  229 => 69,  225 => 68,  222 => 67,  219 => 66,  216 => 65,  210 => 62,  206 => 61,  203 => 60,  200 => 59,  197 => 58,  191 => 55,  187 => 54,  184 => 53,  181 => 52,  178 => 51,  172 => 48,  168 => 47,  165 => 46,  161 => 45,  158 => 44,  155 => 43,  149 => 40,  145 => 39,  142 => 38,  139 => 37,  136 => 36,  130 => 33,  126 => 32,  123 => 31,  120 => 30,  117 => 29,  103 => 26,  99 => 25,  96 => 24,  82 => 21,  77 => 20,  73 => 19,  70 => 18,  66 => 17,  61 => 15,  56 => 13,  53 => 12,  47 => 9,  42 => 7,  39 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }
}
