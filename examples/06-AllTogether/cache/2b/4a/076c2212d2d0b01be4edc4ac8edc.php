<?php

/* contact.html.twig */
class __TwigTemplate_2b4a076c2212d2d0b01be4edc4ac8edc extends Twig_Template
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
    
    <h2>Contact Us</h2>
    <p>You're opinions matter to us (honest). Get in touch!</p>

    <form method=\"post\" action=\"/contact-handler\">
        <div><label for=\"name\">Name: </label><input type=\"text\" name=\"name\" /></div>
        <div><label for=\"comment\">Comment: </label><textarea name=\"comment\"></textarea></div>
        <div><input type=\"submit\" name=\"submit\" value=\"Submit\" /></div>
    </form>
        
";
    }

    public function getTemplateName()
    {
        return "contact.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
