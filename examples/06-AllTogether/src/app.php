<?php

use Symfony\Component\HttpFoundation\Response;

$app = require __DIR__.'/bootstrap.php';

$app->get('/', function() use ($app){    
    return $app['twig']->render('index.html.twig');
});

$app->get('/about', function() use ($app){    
    throw new \Exception('No Idea What This Is About');
});

$app->post('/register', function() use ($app){    
    return $app['twig']->render('index.html.twig');
});

$app->get('/contact', function() use ($app){    
    return $app['twig']->render('contact.html.twig');
});

$app->post('/contact-handler', function() use ($app){    
    return $app['twig']->render('contact.html.twig');
});

$app->get('/donate', function() use ($app){    
    trigger_error('Somthing, somwhere is unset!');
    return $app['twig']->render('donate.html.twig');
});

$app->post('/donate-handler', function() use ($app){    
    return $app['twig']->render('donate.html.twig');
});

$app->error(function(\Exception $e, $code){
    return new Response('An Error Has Occured.');
});

return $app;