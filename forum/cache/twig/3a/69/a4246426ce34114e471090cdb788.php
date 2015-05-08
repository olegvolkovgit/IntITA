<?php

/* login_body.html */
class __TwigTemplate_3a69a4246426ce34114e471090cdb788 extends Twig_Template
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
<form action=\"";
        // line 3
        if (isset($context["S_LOGIN_ACTION"])) { $_S_LOGIN_ACTION_ = $context["S_LOGIN_ACTION"]; } else { $_S_LOGIN_ACTION_ = null; }
        echo $_S_LOGIN_ACTION_;
        echo "\" method=\"post\" id=\"login\" data-focus=\"";
        if (isset($context["S_ADMIN_AUTH"])) { $_S_ADMIN_AUTH_ = $context["S_ADMIN_AUTH"]; } else { $_S_ADMIN_AUTH_ = null; }
        if ($_S_ADMIN_AUTH_) {
            if (isset($context["PASSWORD_CREDENTIAL"])) { $_PASSWORD_CREDENTIAL_ = $context["PASSWORD_CREDENTIAL"]; } else { $_PASSWORD_CREDENTIAL_ = null; }
            echo $_PASSWORD_CREDENTIAL_;
        } else {
            if (isset($context["USERNAME_CREDENTIAL"])) { $_USERNAME_CREDENTIAL_ = $context["USERNAME_CREDENTIAL"]; } else { $_USERNAME_CREDENTIAL_ = null; }
            echo $_USERNAME_CREDENTIAL_;
        }
        echo "\">
<div class=\"panel\">
\t<div class=\"inner\">

\t<div class=\"content\">
\t\t<h2 class=\"login-title\">";
        // line 8
        if (isset($context["LOGIN_EXPLAIN"])) { $_LOGIN_EXPLAIN_ = $context["LOGIN_EXPLAIN"]; } else { $_LOGIN_EXPLAIN_ = null; }
        if ($_LOGIN_EXPLAIN_) {
            if (isset($context["LOGIN_EXPLAIN"])) { $_LOGIN_EXPLAIN_ = $context["LOGIN_EXPLAIN"]; } else { $_LOGIN_EXPLAIN_ = null; }
            echo $_LOGIN_EXPLAIN_;
        } else {
            echo $this->env->getExtension('phpbb')->lang("LOGIN");
        }
        echo "</h2>

\t\t<fieldset ";
        // line 10
        if (isset($context["S_CONFIRM_CODE"])) { $_S_CONFIRM_CODE_ = $context["S_CONFIRM_CODE"]; } else { $_S_CONFIRM_CODE_ = null; }
        if ((!$_S_CONFIRM_CODE_)) {
            echo "class=\"fields1\"";
        } else {
            echo "class=\"fields2\"";
        }
        echo ">
\t\t";
        // line 11
        if (isset($context["LOGIN_ERROR"])) { $_LOGIN_ERROR_ = $context["LOGIN_ERROR"]; } else { $_LOGIN_ERROR_ = null; }
        if ($_LOGIN_ERROR_) {
            echo "<div class=\"error\">";
            if (isset($context["LOGIN_ERROR"])) { $_LOGIN_ERROR_ = $context["LOGIN_ERROR"]; } else { $_LOGIN_ERROR_ = null; }
            echo $_LOGIN_ERROR_;
            echo "</div>";
        }
        // line 12
        echo "\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 13
        if (isset($context["USERNAME_CREDENTIAL"])) { $_USERNAME_CREDENTIAL_ = $context["USERNAME_CREDENTIAL"]; } else { $_USERNAME_CREDENTIAL_ = null; }
        echo $_USERNAME_CREDENTIAL_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("USERNAME");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t\t<dd><input type=\"text\" tabindex=\"1\" name=\"";
        // line 14
        if (isset($context["USERNAME_CREDENTIAL"])) { $_USERNAME_CREDENTIAL_ = $context["USERNAME_CREDENTIAL"]; } else { $_USERNAME_CREDENTIAL_ = null; }
        echo $_USERNAME_CREDENTIAL_;
        echo "\" id=\"";
        if (isset($context["USERNAME_CREDENTIAL"])) { $_USERNAME_CREDENTIAL_ = $context["USERNAME_CREDENTIAL"]; } else { $_USERNAME_CREDENTIAL_ = null; }
        echo $_USERNAME_CREDENTIAL_;
        echo "\" size=\"25\" value=\"";
        if (isset($context["USERNAME"])) { $_USERNAME_ = $context["USERNAME"]; } else { $_USERNAME_ = null; }
        echo $_USERNAME_;
        echo "\" class=\"inputbox autowidth\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 17
        if (isset($context["PASSWORD_CREDENTIAL"])) { $_PASSWORD_CREDENTIAL_ = $context["PASSWORD_CREDENTIAL"]; } else { $_PASSWORD_CREDENTIAL_ = null; }
        echo $_PASSWORD_CREDENTIAL_;
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("PASSWORD");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label></dt>
\t\t\t<dd><input type=\"password\" tabindex=\"2\" id=\"";
        // line 18
        if (isset($context["PASSWORD_CREDENTIAL"])) { $_PASSWORD_CREDENTIAL_ = $context["PASSWORD_CREDENTIAL"]; } else { $_PASSWORD_CREDENTIAL_ = null; }
        echo $_PASSWORD_CREDENTIAL_;
        echo "\" name=\"";
        if (isset($context["PASSWORD_CREDENTIAL"])) { $_PASSWORD_CREDENTIAL_ = $context["PASSWORD_CREDENTIAL"]; } else { $_PASSWORD_CREDENTIAL_ = null; }
        echo $_PASSWORD_CREDENTIAL_;
        echo "\" size=\"25\" class=\"inputbox autowidth\" /></dd>
\t\t\t";
        // line 19
        if (isset($context["S_DISPLAY_FULL_LOGIN"])) { $_S_DISPLAY_FULL_LOGIN_ = $context["S_DISPLAY_FULL_LOGIN"]; } else { $_S_DISPLAY_FULL_LOGIN_ = null; }
        if (isset($context["U_SEND_PASSWORD"])) { $_U_SEND_PASSWORD_ = $context["U_SEND_PASSWORD"]; } else { $_U_SEND_PASSWORD_ = null; }
        if (isset($context["U_RESEND_ACTIVATION"])) { $_U_RESEND_ACTIVATION_ = $context["U_RESEND_ACTIVATION"]; } else { $_U_RESEND_ACTIVATION_ = null; }
        if (($_S_DISPLAY_FULL_LOGIN_ && ($_U_SEND_PASSWORD_ || $_U_RESEND_ACTIVATION_))) {
            // line 20
            echo "\t\t\t\t";
            if (isset($context["U_SEND_PASSWORD"])) { $_U_SEND_PASSWORD_ = $context["U_SEND_PASSWORD"]; } else { $_U_SEND_PASSWORD_ = null; }
            if ($_U_SEND_PASSWORD_) {
                echo "<dd><a href=\"";
                if (isset($context["U_SEND_PASSWORD"])) { $_U_SEND_PASSWORD_ = $context["U_SEND_PASSWORD"]; } else { $_U_SEND_PASSWORD_ = null; }
                echo $_U_SEND_PASSWORD_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("FORGOT_PASS");
                echo "</a></dd>";
            }
            // line 21
            echo "\t\t\t\t";
            if (isset($context["U_RESEND_ACTIVATION"])) { $_U_RESEND_ACTIVATION_ = $context["U_RESEND_ACTIVATION"]; } else { $_U_RESEND_ACTIVATION_ = null; }
            if ($_U_RESEND_ACTIVATION_) {
                echo "<dd><a href=\"";
                if (isset($context["U_RESEND_ACTIVATION"])) { $_U_RESEND_ACTIVATION_ = $context["U_RESEND_ACTIVATION"]; } else { $_U_RESEND_ACTIVATION_ = null; }
                echo $_U_RESEND_ACTIVATION_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("RESEND_ACTIVATION");
                echo "</a></dd>";
            }
            // line 22
            echo "\t\t\t";
        }
        // line 23
        echo "\t\t</dl>
\t\t";
        // line 24
        if (isset($context["CAPTCHA_TEMPLATE"])) { $_CAPTCHA_TEMPLATE_ = $context["CAPTCHA_TEMPLATE"]; } else { $_CAPTCHA_TEMPLATE_ = null; }
        if (isset($context["S_CONFIRM_CODE"])) { $_S_CONFIRM_CODE_ = $context["S_CONFIRM_CODE"]; } else { $_S_CONFIRM_CODE_ = null; }
        if (($_CAPTCHA_TEMPLATE_ && $_S_CONFIRM_CODE_)) {
            // line 25
            echo "\t\t\t";
            if (isset($context["CAPTCHA_TAB_INDEX"])) { $_CAPTCHA_TAB_INDEX_ = $context["CAPTCHA_TAB_INDEX"]; } else { $_CAPTCHA_TAB_INDEX_ = null; }
            $value = 3;
            $context['definition']->set('CAPTCHA_TAB_INDEX', $value);
            // line 26
            echo "\t\t\t";
            if (isset($context["CAPTCHA_TEMPLATE"])) { $_CAPTCHA_TEMPLATE_ = $context["CAPTCHA_TEMPLATE"]; } else { $_CAPTCHA_TEMPLATE_ = null; }
            $location = (("" . $_CAPTCHA_TEMPLATE_) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $template = $this->env->resolveTemplate((("" . $_CAPTCHA_TEMPLATE_) . ""));
            $template->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 27
            echo "\t\t";
        }
        // line 28
        echo "\t\t";
        if (isset($context["S_DISPLAY_FULL_LOGIN"])) { $_S_DISPLAY_FULL_LOGIN_ = $context["S_DISPLAY_FULL_LOGIN"]; } else { $_S_DISPLAY_FULL_LOGIN_ = null; }
        if ($_S_DISPLAY_FULL_LOGIN_) {
            // line 29
            echo "\t\t<dl>
\t\t\t";
            // line 30
            if (isset($context["S_AUTOLOGIN_ENABLED"])) { $_S_AUTOLOGIN_ENABLED_ = $context["S_AUTOLOGIN_ENABLED"]; } else { $_S_AUTOLOGIN_ENABLED_ = null; }
            if ($_S_AUTOLOGIN_ENABLED_) {
                echo "<dd><label for=\"autologin\"><input type=\"checkbox\" name=\"autologin\" id=\"autologin\" tabindex=\"4\" /> ";
                echo $this->env->getExtension('phpbb')->lang("LOG_ME_IN");
                echo "</label></dd>";
            }
            // line 31
            echo "\t\t\t<dd><label for=\"viewonline\"><input type=\"checkbox\" name=\"viewonline\" id=\"viewonline\" tabindex=\"5\" /> ";
            echo $this->env->getExtension('phpbb')->lang("HIDE_ME");
            echo "</label></dd>
\t\t</dl>
\t\t";
        }
        // line 34
        echo "
\t\t";
        // line 35
        if (isset($context["S_LOGIN_REDIRECT"])) { $_S_LOGIN_REDIRECT_ = $context["S_LOGIN_REDIRECT"]; } else { $_S_LOGIN_REDIRECT_ = null; }
        echo $_S_LOGIN_REDIRECT_;
        echo "
\t\t<dl>
\t\t\t<dt>&nbsp;</dt>
\t\t\t<dd>";
        // line 38
        if (isset($context["S_HIDDEN_FIELDS"])) { $_S_HIDDEN_FIELDS_ = $context["S_HIDDEN_FIELDS"]; } else { $_S_HIDDEN_FIELDS_ = null; }
        echo $_S_HIDDEN_FIELDS_;
        echo "<input type=\"submit\" name=\"login\" tabindex=\"6\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("LOGIN");
        echo "\" class=\"button1\" /></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>

\t";
        // line 43
        if (isset($context["S_ADMIN_AUTH"])) { $_S_ADMIN_AUTH_ = $context["S_ADMIN_AUTH"]; } else { $_S_ADMIN_AUTH_ = null; }
        if (isset($context["PROVIDER_TEMPLATE_FILE"])) { $_PROVIDER_TEMPLATE_FILE_ = $context["PROVIDER_TEMPLATE_FILE"]; } else { $_PROVIDER_TEMPLATE_FILE_ = null; }
        if (((!$_S_ADMIN_AUTH_) && $_PROVIDER_TEMPLATE_FILE_)) {
            // line 44
            echo "\t\t";
            if (isset($context["PROVIDER_TEMPLATE_FILE"])) { $_PROVIDER_TEMPLATE_FILE_ = $context["PROVIDER_TEMPLATE_FILE"]; } else { $_PROVIDER_TEMPLATE_FILE_ = null; }
            $location = (("" . $_PROVIDER_TEMPLATE_FILE_) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $template = $this->env->resolveTemplate((("" . $_PROVIDER_TEMPLATE_FILE_) . ""));
            $template->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 45
            echo "\t";
        }
        // line 46
        echo "\t</div>
</div>


";
        // line 50
        if (isset($context["S_ADMIN_AUTH"])) { $_S_ADMIN_AUTH_ = $context["S_ADMIN_AUTH"]; } else { $_S_ADMIN_AUTH_ = null; }
        if (isset($context["S_REGISTER_ENABLED"])) { $_S_REGISTER_ENABLED_ = $context["S_REGISTER_ENABLED"]; } else { $_S_REGISTER_ENABLED_ = null; }
        if (((!$_S_ADMIN_AUTH_) && $_S_REGISTER_ENABLED_)) {
            // line 51
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h3>";
            // line 55
            echo $this->env->getExtension('phpbb')->lang("REGISTER");
            echo "</h3>
\t\t\t<p>";
            // line 56
            echo $this->env->getExtension('phpbb')->lang("LOGIN_INFO");
            echo "</p>
\t\t\t<p><strong><a href=\"";
            // line 57
            if (isset($context["U_TERMS_USE"])) { $_U_TERMS_USE_ = $context["U_TERMS_USE"]; } else { $_U_TERMS_USE_ = null; }
            echo $_U_TERMS_USE_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("TERMS_USE");
            echo "</a> | <a href=\"";
            if (isset($context["U_PRIVACY"])) { $_U_PRIVACY_ = $context["U_PRIVACY"]; } else { $_U_PRIVACY_ = null; }
            echo $_U_PRIVACY_;
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("PRIVACY");
            echo "</a></strong></p>
\t\t\t<hr class=\"dashed\" />
\t\t\t<p><a href=\"";
            // line 59
            if (isset($context["U_REGISTER"])) { $_U_REGISTER_ = $context["U_REGISTER"]; } else { $_U_REGISTER_ = null; }
            echo $_U_REGISTER_;
            echo "\" class=\"button2\">";
            echo $this->env->getExtension('phpbb')->lang("REGISTER");
            echo "</a></p>
\t\t</div>

\t\t</div>
\t</div>
";
        }
        // line 65
        echo "
</form>

";
        // line 68
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
        return "login_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  298 => 68,  293 => 65,  281 => 59,  268 => 57,  264 => 56,  260 => 55,  254 => 51,  250 => 50,  244 => 46,  241 => 45,  226 => 44,  222 => 43,  211 => 38,  204 => 35,  201 => 34,  194 => 31,  187 => 30,  184 => 29,  180 => 28,  177 => 27,  162 => 26,  157 => 25,  153 => 24,  150 => 23,  147 => 22,  136 => 21,  125 => 20,  120 => 19,  112 => 18,  104 => 17,  91 => 14,  83 => 13,  80 => 12,  72 => 11,  63 => 10,  52 => 8,  34 => 3,  31 => 2,  19 => 1,);
    }
}
