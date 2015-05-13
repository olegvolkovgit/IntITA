<?php

/* mcp_header.html */
class __TwigTemplate_648656514697c0b32c1933da37888487 extends Twig_Template
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
<h2>";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("MCP");
        echo "</h2>

";
        // line 5
        if (isset($context["U_MCP"])) { $_U_MCP_ = $context["U_MCP"]; } else { $_U_MCP_ = null; }
        if ($_U_MCP_) {
            // line 6
            echo "\t<p class=\"linkmcp responsive-center\">
\t\t[";
            // line 7
            if (isset($context["U_ACP"])) { $_U_ACP_ = $context["U_ACP"]; } else { $_U_ACP_ = null; }
            if ($_U_ACP_) {
                echo "&nbsp;<a href=\"";
                if (isset($context["U_ACP"])) { $_U_ACP_ = $context["U_ACP"]; } else { $_U_ACP_ = null; }
                echo $_U_ACP_;
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("ACP");
                echo "\" data-responsive-text=\"";
                echo $this->env->getExtension('phpbb')->lang("ACP_SHORT");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("ACP");
                echo "</a>&nbsp;|";
            }
            echo "&nbsp;<a href=\"";
            if (isset($context["U_MCP"])) { $_U_MCP_ = $context["U_MCP"]; } else { $_U_MCP_ = null; }
            echo $_U_MCP_;
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo "\" data-responsive-text=\"";
            echo $this->env->getExtension('phpbb')->lang("MCP_SHORT");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo "</a>";
            if (isset($context["U_MCP_FORUM"])) { $_U_MCP_FORUM_ = $context["U_MCP_FORUM"]; } else { $_U_MCP_FORUM_ = null; }
            if ($_U_MCP_FORUM_) {
                echo "&nbsp;|&nbsp;<a href=\"";
                if (isset($context["U_MCP_FORUM"])) { $_U_MCP_FORUM_ = $context["U_MCP_FORUM"]; } else { $_U_MCP_FORUM_ = null; }
                echo $_U_MCP_FORUM_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MODERATE_FORUM");
                echo "</a>";
            }
            if (isset($context["U_MCP_TOPIC"])) { $_U_MCP_TOPIC_ = $context["U_MCP_TOPIC"]; } else { $_U_MCP_TOPIC_ = null; }
            if ($_U_MCP_TOPIC_) {
                echo "&nbsp;|&nbsp;<a href=\"";
                if (isset($context["U_MCP_TOPIC"])) { $_U_MCP_TOPIC_ = $context["U_MCP_TOPIC"]; } else { $_U_MCP_TOPIC_ = null; }
                echo $_U_MCP_TOPIC_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MODERATE_TOPIC");
                echo "</a>";
            }
            if (isset($context["U_MCP_POST"])) { $_U_MCP_POST_ = $context["U_MCP_POST"]; } else { $_U_MCP_POST_ = null; }
            if ($_U_MCP_POST_) {
                echo "&nbsp;|&nbsp;<a href=\"";
                if (isset($context["U_MCP_POST"])) { $_U_MCP_POST_ = $context["U_MCP_POST"]; } else { $_U_MCP_POST_ = null; }
                echo $_U_MCP_POST_;
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MODERATE_POST");
                echo "</a>";
            }
            echo "&nbsp;]
\t</p>
";
        }
        // line 10
        echo "
<div id=\"tabs\">
\t<ul>
\t\t";
        // line 13
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "l_block1"));
        foreach ($context['_seq'] as $context["_key"] => $context["l_block1"]) {
            // line 14
            echo "\t\t<li class=\"tab";
            if (isset($context["l_block1"])) { $_l_block1_ = $context["l_block1"]; } else { $_l_block1_ = null; }
            if ($this->getAttribute($_l_block1_, "S_SELECTED")) {
                echo " activetab";
            }
            echo "\"><a href=\"";
            if (isset($context["l_block1"])) { $_l_block1_ = $context["l_block1"]; } else { $_l_block1_ = null; }
            echo $this->getAttribute($_l_block1_, "U_TITLE");
            echo "\">";
            if (isset($context["l_block1"])) { $_l_block1_ = $context["l_block1"]; } else { $_l_block1_ = null; }
            echo $this->getAttribute($_l_block1_, "L_TITLE");
            echo "</a></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "\t</ul>
</div>

<div class=\"panel bg3\">
\t<div class=\"inner\">

\t<div style=\"width: 100%;\">

\t<div id=\"cp-menu\">
\t\t<div id=\"navigation\" role=\"navigation\">
\t\t\t<ul>
\t\t\t";
        // line 27
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "l_block1"));
        foreach ($context['_seq'] as $context["_key"] => $context["l_block1"]) {
            // line 28
            echo "\t\t\t";
            if (isset($context["l_block1"])) { $_l_block1_ = $context["l_block1"]; } else { $_l_block1_ = null; }
            if ($this->getAttribute($_l_block1_, "S_SELECTED")) {
                // line 29
                echo "\t\t\t\t";
                if (isset($context["l_block1"])) { $_l_block1_ = $context["l_block1"]; } else { $_l_block1_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_l_block1_, "l_block2"));
                foreach ($context['_seq'] as $context["_key"] => $context["l_block2"]) {
                    // line 30
                    echo "\t\t\t\t";
                    if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                    if ($this->getAttribute($_l_block2_, "S_SELECTED")) {
                        // line 31
                        echo "\t\t\t\t<li id=\"active-subsection\"><a href=\"";
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        echo $this->getAttribute($_l_block2_, "U_TITLE");
                        echo "\"><span>";
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        echo $this->getAttribute($_l_block2_, "L_TITLE");
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        if ($this->getAttribute($_l_block2_, "ADD_ITEM")) {
                            echo " (";
                            if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                            echo $this->getAttribute($_l_block2_, "ADD_ITEM");
                            echo ")";
                        }
                        echo "</span></a></li>
\t\t\t\t";
                    } else {
                        // line 33
                        echo "\t\t\t\t<li><a href=\"";
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        echo $this->getAttribute($_l_block2_, "U_TITLE");
                        echo "\"><span>";
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        echo $this->getAttribute($_l_block2_, "L_TITLE");
                        if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                        if ($this->getAttribute($_l_block2_, "ADD_ITEM")) {
                            echo " (";
                            if (isset($context["l_block2"])) { $_l_block2_ = $context["l_block2"]; } else { $_l_block2_ = null; }
                            echo $this->getAttribute($_l_block2_, "ADD_ITEM");
                            echo ")";
                        }
                        echo "</span></a></li>
\t\t\t\t";
                    }
                    // line 35
                    echo "\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block2'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 36
                echo "\t\t\t";
            }
            // line 37
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l_block1'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "\t\t\t</ul>
\t\t</div>
\t</div>

\t<div id=\"cp-main\" class=\"mcp-main panel-container\">
\t\t";
        // line 43
        if (isset($context["MESSAGE"])) { $_MESSAGE_ = $context["MESSAGE"]; } else { $_MESSAGE_ = null; }
        if ($_MESSAGE_) {
            // line 44
            echo "\t\t<div class=\"content\">
\t\t\t<h2 class=\"message-title\">";
            // line 45
            echo $this->env->getExtension('phpbb')->lang("MESSAGE");
            echo "</h2>
\t\t\t<p class=\"error\">";
            // line 46
            if (isset($context["MESSAGE"])) { $_MESSAGE_ = $context["MESSAGE"]; } else { $_MESSAGE_ = null; }
            echo $_MESSAGE_;
            echo "</p>
\t\t\t<p>";
            // line 47
            if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "return_links"));
            foreach ($context['_seq'] as $context["_key"] => $context["return_links"]) {
                if (isset($context["return_links"])) { $_return_links_ = $context["return_links"]; } else { $_return_links_ = null; }
                echo $this->getAttribute($_return_links_, "MESSAGE_LINK");
                echo "<br /><br />";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['return_links'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</p>
\t\t</div>
\t\t";
        }
    }

    public function getTemplateName()
    {
        return "mcp_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 47,  226 => 46,  222 => 45,  219 => 44,  216 => 43,  209 => 38,  203 => 37,  200 => 36,  194 => 35,  156 => 30,  150 => 29,  146 => 28,  141 => 27,  128 => 16,  110 => 14,  105 => 13,  100 => 10,  45 => 7,  42 => 6,  39 => 5,  34 => 3,  687 => 186,  678 => 181,  673 => 180,  667 => 179,  663 => 178,  660 => 177,  652 => 176,  637 => 175,  624 => 174,  616 => 173,  608 => 172,  596 => 171,  589 => 170,  585 => 169,  575 => 161,  569 => 159,  564 => 158,  552 => 157,  547 => 156,  542 => 155,  534 => 149,  523 => 143,  519 => 141,  509 => 139,  504 => 138,  500 => 137,  497 => 136,  494 => 135,  485 => 133,  482 => 132,  473 => 129,  470 => 128,  467 => 127,  464 => 126,  455 => 123,  452 => 122,  449 => 121,  446 => 120,  437 => 117,  434 => 116,  431 => 115,  402 => 113,  394 => 112,  377 => 107,  369 => 106,  362 => 102,  355 => 101,  348 => 98,  336 => 95,  331 => 94,  320 => 90,  308 => 89,  298 => 81,  293 => 78,  285 => 77,  277 => 75,  272 => 74,  266 => 72,  261 => 70,  258 => 69,  255 => 68,  252 => 67,  244 => 63,  239 => 62,  230 => 59,  225 => 58,  221 => 56,  186 => 53,  182 => 52,  177 => 33,  174 => 50,  171 => 49,  166 => 47,  163 => 46,  160 => 31,  142 => 41,  137 => 40,  130 => 37,  123 => 36,  112 => 29,  103 => 23,  96 => 22,  91 => 20,  85 => 17,  78 => 16,  72 => 14,  69 => 13,  63 => 11,  57 => 9,  51 => 7,  47 => 6,  35 => 4,  31 => 2,  19 => 1,);
    }
}
