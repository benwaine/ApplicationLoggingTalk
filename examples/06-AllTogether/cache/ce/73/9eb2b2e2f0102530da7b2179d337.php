<?php

/* index.html.twig */
class __TwigTemplate_ce739eb2b2e2f0102530da7b2179d337 extends Twig_Template
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
    
    <h2>Registration</h2>

    <form method=\"post\" action=\"/register\">
        <div><label for=\"name\">Name: </label><input type=\"text\" name=\"name\" /></div>
        <div><label for=\"meme\">Favorite Meme: </label><input type=\"text\" name=\"meme\" /></div>
        <div><input type=\"Submit\" name=\"submit\" value=\"Register\" /></div>
    </form>
        
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
