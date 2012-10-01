<?php

/* donate.html.twig */
class __TwigTemplate_386df619b4d53f8cdfb978c340524f22 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'container_content' => array($this, 'block_container_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_container_content($context, array $blocks = array())
    {
        // line 4
        echo "<h1> Example Logging Website</h1>
    <p>Navigate round the site and complete the various actions to trigger business 
    / domain events in the logs.
    </p>
    
    <h2>Donations Welcome</h2>
    <p>It costs loads of money to keep this boat running!</p>
    <p>Enter an amount in the box below and we'll magically deduct it from your 
       bank account!</p>

    <form method=\"post\" action=\"/donate-handler\">
        <div><label for=\"cash\">Amount: </label><input type=\"text\" name=\"name\" /></div>
        <div><input type=\"submit\" name=\"submit\" value=\"Donate\" /></div>
    </form>
        
";
    }

    public function getTemplateName()
    {
        return "donate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
