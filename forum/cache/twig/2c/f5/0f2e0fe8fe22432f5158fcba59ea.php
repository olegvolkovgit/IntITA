<?php

/* faq_body.html */
class __TwigTemplate_2cf50f2e0fe8fe22432f5158fcba59ea extends Twig_Template
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
<h2 class=\"faq-title\">";
        // line 3
        echo $this->env->getExtension('phpbb')->lang("FAQ_TITLE");
        echo "</h2>


<div class=\"panel bg1\" id=\"faqlinks\">
\t<div class=\"inner\">
\t\t<div class=\"column1\">
\t\t";
        // line 9
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "faq_block"));
        foreach ($context['_seq'] as $context["_key"] => $context["faq_block"]) {
            // line 10
            echo "\t\t\t";
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            if (isset($context["SWITCH_COLUMN_MANUALLY"])) { $_SWITCH_COLUMN_MANUALLY_ = $context["SWITCH_COLUMN_MANUALLY"]; } else { $_SWITCH_COLUMN_MANUALLY_ = null; }
            if (($this->getAttribute($_faq_block_, "SWITCH_COLUMN") || ($_SWITCH_COLUMN_MANUALLY_ && ($this->getAttribute($_faq_block_, "S_ROW_COUNT") == 4)))) {
                // line 11
                echo "\t\t\t\t</div>

\t\t\t\t<div class=\"column2\">
\t\t\t";
            }
            // line 15
            echo "
\t\t\t<dl class=\"faq\">
\t\t\t\t<dt><strong>";
            // line 17
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            echo $this->getAttribute($_faq_block_, "BLOCK_TITLE");
            echo "</strong></dt>
\t\t\t\t";
            // line 18
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_faq_block_, "faq_row"));
            foreach ($context['_seq'] as $context["_key"] => $context["faq_row"]) {
                // line 19
                echo "\t\t\t\t\t<dd><a href=\"#f";
                if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
                echo $this->getAttribute($_faq_block_, "S_ROW_COUNT");
                echo "r";
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                echo $this->getAttribute($_faq_row_, "S_ROW_COUNT");
                echo "\">";
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                echo $this->getAttribute($_faq_row_, "FAQ_QUESTION");
                echo "</a></dd>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "\t\t\t</dl>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "\t\t</div>
\t</div>
</div>

";
        // line 27
        if (isset($context["loops"])) { $_loops_ = $context["loops"]; } else { $_loops_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_loops_, "faq_block"));
        foreach ($context['_seq'] as $context["_key"] => $context["faq_block"]) {
            // line 28
            echo "\t<div class=\"panel ";
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            if (($this->getAttribute($_faq_block_, "S_ROW_COUNT") % 2 == 1)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t<div class=\"content\">
\t\t\t<h2 class=\"faq-title\">";
            // line 32
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            echo $this->getAttribute($_faq_block_, "BLOCK_TITLE");
            echo "</h2>
\t\t\t";
            // line 33
            if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_faq_block_, "faq_row"));
            foreach ($context['_seq'] as $context["_key"] => $context["faq_row"]) {
                // line 34
                echo "\t\t\t\t<dl class=\"faq\">
\t\t\t\t\t<dt id=\"f";
                // line 35
                if (isset($context["faq_block"])) { $_faq_block_ = $context["faq_block"]; } else { $_faq_block_ = null; }
                echo $this->getAttribute($_faq_block_, "S_ROW_COUNT");
                echo "r";
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                echo $this->getAttribute($_faq_row_, "S_ROW_COUNT");
                echo "\"><strong>";
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                echo $this->getAttribute($_faq_row_, "FAQ_QUESTION");
                echo "</strong></dt>
\t\t\t\t\t<dd>";
                // line 36
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                echo $this->getAttribute($_faq_row_, "FAQ_ANSWER");
                echo "</dd>
\t\t\t\t\t<dd><a href=\"#faqlinks\" class=\"top2\">";
                // line 37
                echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
                echo "</a></dd>
\t\t\t\t</dl>
\t\t\t\t";
                // line 39
                if (isset($context["faq_row"])) { $_faq_row_ = $context["faq_row"]; } else { $_faq_row_ = null; }
                if ((!$this->getAttribute($_faq_row_, "S_LAST_ROW"))) {
                    echo "<hr class=\"dashed\" />";
                }
                // line 40
                echo "\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "\t\t</div>

\t\t</div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['faq_block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "
";
        // line 47
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
        // line 48
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
        return "faq_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  190 => 48,  178 => 47,  175 => 46,  165 => 41,  159 => 40,  154 => 39,  149 => 37,  144 => 36,  133 => 35,  130 => 34,  125 => 33,  120 => 32,  107 => 28,  102 => 27,  96 => 23,  89 => 21,  73 => 19,  68 => 18,  63 => 17,  59 => 15,  53 => 11,  48 => 10,  43 => 9,  34 => 3,  31 => 2,  19 => 1,);
    }
}
