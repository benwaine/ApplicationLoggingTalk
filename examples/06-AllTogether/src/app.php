<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app = require __DIR__.'/bootstrap.php';

$app->get('/', function() use ($app){    
    $app['log']->applicationLog('Serving page: Home', Logger::INFO);
    return $app['twig']->render('index.html.twig');
});

$app->get('/about', function() use ($app){    
    $app['log']->applicationLog('Serving page: About', Logger::INFO);
    $app['log']->applicationLog('Database: Retrieving about data', Logger::INFO);
    throw new \Exception('No Idea What This Is About');
});

$app->post('/register', function(Request $request) use ($app){    
    $app['log']->applicationLog('Handling POST: Registration', Logger::INFO);
    $app['log']->logBusinessEvent(Logger::EVENT_USERREG);
    return $app['twig']->render('index.html.twig');
});

$app->get('/contact', function() use ($app){    
    $app['log']->applicationLog('Serving page: Contact', Logger::INFO);
    return $app['twig']->render('contact.html.twig');
});

$app->post('/contact-handler', function() use ($app){    
    $app['log']->applicationLog('Handling POST: Contact', Logger::INFO);
    $app['log']->logBusinessEvent(Logger::EVENT_CONTACT);
    return $app['twig']->render('contact.html.twig');
});

$app->get('/donate', function() use ($app){    
    trigger_error('Somthing, somwhere is unset!');
    $app['log']->applicationLog('Serving page: Donate', Logger::INFO);
    return $app['twig']->render('donate.html.twig');
});

$app->post('/donate-handler', function(Request $request) use ($app){    
    $app['log']->applicationLog('Handling POST: Donate', Logger::INFO);
    
    $cash = $request->get('cash');
    
    if(is_null($cash) || !is_numeric($cash)) 
    {
        throw new \InvalidArgumentException('Bad donation value');
    }
    
    $app['log']->applicationLog('User Action: Donation', Logger::INFO, array('amount' => $cash));
    
    $app['log']->logBusinessEvent(Logger::EVENT_DONATION);
    $app['log']->logBusinessCount(Logger::EVENT_TOTALDONATION, $cash);
    
    return $app['twig']->render('donate.html.twig');
});

$app->before(function() use ($app){
    $app['log']->applicationLog('REQUEST BEGIN', Logger::INFO);
});

$app->after(function() use ($app){
    $reqTime = 1000 *(microtime(true) - $app['reqStart']);
    $app['log']->applicationLog('REQUEST END', Logger::INFO, array('time' => $reqTime));
    $app['log']->logBusinessTime(Logger::EVENT_REQUESTTIME, $reqTime);
});

$app->error(function(\Exception $e, $code) use ($app){
    $app['log']->applicationLog('REQUEST ERROR: ' . $e->getMessage(), Logger::ERROR); 
    return new Response('An Error Has Occured.');
});

return $app;