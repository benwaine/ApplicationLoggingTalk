<?php

/* layout.html.twig */
class __TwigTemplate_c3c83218d8d5d7a677866a6d861801c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'container_content' => array($this, 'block_container_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html class=\"no-js\" lang=\"en\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">

        <title></title>
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">

        <meta name=\"viewport\" content=\"width=device-width\">

        <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
        <style>
        body {
        padding-top: 60px;
        padding-bottom: 40px;
        }
        </style>
        <link rel=\"stylesheet\" href=\"css/bootstrap-responsive.min.css\">
        <link rel=\"stylesheet\" href=\"css/style.css\">

        <script src=\"js/libs/modernizr-2.6.1.custom.js\"></script>
    </head>
    <body>
        <div class=\"navbar navbar-fixed-top\">
            <div class=\"navbar-inner\">
                <div class=\"container\">
                    <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                        <span class=\"icon-bar\"></span>
                    </a>
                    <a class=\"brand\" href=\"#\">Amazeballs Logging Site</a>
                    <div class=\"nav-collapse\">
                        <ul class=\"nav\">
                            <li class=\"active\"><a href=\"/\">Home</a></li>
                            <li><a href=\"/about\">About</a></li>
                            <li><a href=\"/contact\">Contact</a></li>
                            <li><a href=\"/donate\">Donate</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class=\"container\">

            ";
        // line 49
        $this->displayBlock('container_content', $context, $blocks);
        // line 50
        echo "            <hr>

            <footer>
                <p>&copy; Company 2012</p>
            </footer>

        </div> <!-- /container -->
        <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"js/libs/jquery-1.8.0.min.js\"><\\/script>')</script>

        <script src=\"js/libs/bootstrap/transition.js\"></script>
        <script src=\"js/libs/bootstrap/collapse.js\"></script>

        <script src=\"js/script.js\"></script>
    </body>
</html>";
    }

    // line 49
    public function block_container_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

}
