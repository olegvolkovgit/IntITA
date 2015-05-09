<?php

/* acp_inactive.html */
class __TwigTemplate_9852f102c47ac772b27923f1d45d2535 extends Twig_Template
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

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("INACTIVE_USERS");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("INACTIVE_USERS_EXPLAIN");
        echo "</p>

<form id=\"inactive\" method=\"post\" action=\"";
        // line 9
        if (isset($context["U_ACTION"])) { $_U_ACTION_ = $context["U_ACTION"]; } else { $_U_ACTION_ = null; }
        echo $_U_ACTION_;
        echo "\">

";
        // line 11
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
            // line 12
            echo "<div class=\"pagination\">
\t";
            // line 13
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
            // line 14
            echo "</div>
";
        }
        // line 16
        echo "
<table class=\"table1 zebra-table\">
<thead>
<tr>
\t<th>";
        // line 20
        echo $this->env->getExtension('phpbb')->lang("USERNAME");
        echo "</th>
\t<th>";
        // line 21
        echo $this->env->getExtension('phpbb')->lang("JOINED");
        echo "</th>
\t<th>";
        // line 22
        echo $this->env->getExtension('phpbb')->lang("INACTIVE_DATE");
        echo "</th>
\t<th>";
        // line 23
        echo $this->env->getExtension('phpbb')->lang("LAST_VISIT");
        echo "</th>
\t<th>";
        // line 24
        echo $this->env->getExtension('phpbb')->lang("INACTIVE_REASON");
        echo "</th>
\t<th>";
        // line 25
        echo $this->env->getExtension('phpbb')->lang("MARK");
        echo "</th>
</tr>
</thead>
<tbody>
";
        // line 29
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "inactive"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["inactive"]) {
            // line 30
            echo "\t<tr>
\t\t<td style=\"vertical-align: top;\">
\t\t\t";
            // line 32
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "USERNAME_FULL");
            echo "
\t\t\t";
            // line 33
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
            // line 34
            echo "\t\t</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 35
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "JOINED");
            echo "</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 36
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "INACTIVE_DATE");
            echo "</td>
\t\t<td style=\"vertical-align: top;\">";
            // line 37
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "LAST_VISIT");
            echo "</td>
\t\t<td style=\"vertical-align: top;\">
\t\t\t";
            // line 39
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "REASON");
            echo "
\t\t\t";
            // line 40
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            if ($this->getAttribute($_inactive_, "REMINDED")) {
                echo "<br />";
                if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
                echo $this->getAttribute($_inactive_, "REMINDED_EXPLAIN");
            }
            // line 41
            echo "\t\t</td>
\t\t<td>&nbsp;<input type=\"checkbox\" class=\"radio\" name=\"mark[]\" value=\"";
            // line 42
            if (isset($context["inactive"])) { $_inactive_ = $context["inactive"]; } else { $_inactive_ = null; }
            echo $this->getAttribute($_inactive_, "USER_ID");
            echo "\" />&nbsp;</td>
\t</tr>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 45
            echo "\t<tr>
\t\t<td colspan=\"6\" style=\"text-align: center;\">";
            // line 46
            echo $this->env->getExtension('phpbb')->lang("NO_INACTIVE_USERS");
            echo "</td>
\t</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['inactive'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "</tbody>
</table>

<fieldset class=\"display-options\">
\t";
        // line 53
        echo $this->env->getExtension('phpbb')->lang("DISPLAY_LOG");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " &nbsp;";
        if (isset($context["S_LIMIT_DAYS"])) { $_S_LIMIT_DAYS_ = $context["S_LIMIT_DAYS"]; } else { $_S_LIMIT_DAYS_ = null; }
        echo $_S_LIMIT_DAYS_;
        echo "&nbsp;";
        echo $this->env->getExtension('phpbb')->lang("SORT_BY");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " ";
        if (isset($context["S_SORT_KEY"])) { $_S_SORT_KEY_ = $context["S_SORT_KEY"]; } else { $_S_SORT_KEY_ = null; }
        echo $_S_SORT_KEY_;
        echo " ";
        if (isset($context["S_SORT_DIR"])) { $_S_SORT_DIR_ = $context["S_SORT_DIR"]; } else { $_S_SORT_DIR_ = null; }
        echo $_S_SORT_DIR_;
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
            echo "&nbsp;";
            echo $this->env->getExtension('phpbb')->lang("USERS_PER_PAGE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <input class=\"inputbox autowidth\" type=\"number\" name=\"users_per_page\" id=\"users_per_page\" size=\"3\" value=\"";
            if (isset($context["USERS_PER_PAGE"])) { $_USERS_PER_PAGE_ = $context["USERS_PER_PAGE"]; } else { $_USERS_PER_PAGE_ = null; }
            echo $_USERS_PER_PAGE_;
            echo "\" />";
        }
        // line 54
        echo "\t<input class=\"button2\" type=\"submit\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("GO");
        echo "\" name=\"sort\" />
</fieldset>

<hr />

";
        // line 59
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_loops_, "pagination"))) {
            // line 60
            echo "\t<div class=\"pagination\">
\t\t";
            // line 61
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
            echo "\t</div>
";
        }
        // line 64
        echo "
<fieldset class=\"quick\">
\t<select name=\"action\">";
        // line 66
        if (isset($context["S_INACTIVE_OPTIONS"])) { $_S_INACTIVE_OPTIONS_ = $context["S_INACTIVE_OPTIONS"]; } else { $_S_INACTIVE_OPTIONS_ = null; }
        echo $_S_INACTIVE_OPTIONS_;
        echo "</select>
\t<input class=\"button2\" type=\"submit\" name=\"submit\" value=\"";
        // line 67
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" />
\t<p class=\"small\"><a href=\"#\" onclick=\"marklist('inactive', 'mark', true); return false;\">";
        // line 68
        echo $this->env->getExtension('phpbb')->lang("MARK_ALL");
        echo "</a> &bull; <a href=\"#\" onclick=\"marklist('inactive', 'mark', false); return false;\">";
        echo $this->env->getExtension('phpbb')->lang("UNMARK_ALL");
        echo "</a></p>
\t";
        // line 69
        if (isset($context["S_FORM_TOKEN"])) { $_S_FORM_TOKEN_ = $context["S_FORM_TOKEN"]; } else { $_S_FORM_TOKEN_ = null; }
        echo $_S_FORM_TOKEN_;
        echo "
</fieldset>

</form>

";
        // line 74
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
        return "acp_inactive.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  283 => 74,  274 => 69,  268 => 68,  264 => 67,  259 => 66,  255 => 64,  251 => 62,  239 => 61,  236 => 60,  233 => 59,  224 => 54,  199 => 53,  193 => 49,  184 => 46,  181 => 45,  172 => 42,  169 => 41,  162 => 40,  157 => 39,  151 => 37,  146 => 36,  141 => 35,  138 => 34,  122 => 33,  117 => 32,  113 => 30,  107 => 29,  100 => 25,  96 => 24,  92 => 23,  88 => 22,  84 => 21,  80 => 20,  74 => 16,  70 => 14,  58 => 13,  55 => 12,  52 => 11,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
