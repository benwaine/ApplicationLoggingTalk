<?php
require_once __DIR__ . '/app/Logger.php';
require_once __DIR__ . '/app/User.php';
require_once __DIR__ . '/app/UserMapper.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;

// Simulate a request: Bootstrap > Processing > Dispatch

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// BOOTSTRAPPING /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$requestParams = array('REMOTE_ADDR' => '127.0.0.1'); 

// Create first logger (application)
$applicationLogger = new MonoLogger('Application');
// Add a handler (writter)
$applicationLogger->pushHandler(new StreamHandler('/tmp/application.log', MonoLogger::DEBUG));

// Create second logger (security)
$securityLogger = new MonoLogger('Security');
$securityLogger->pushHandler(new StreamHandler('/tmp/security.log', MonoLogger::DEBUG));

$logger = new Logger($applicationLogger, $securityLogger, $requestParams);

// Creating StatsD Client 
$connection = new \Domnikl\Statsd\Connection\Socket('localhost', 8125);
$statsd = new \Domnikl\Statsd\Client($connection, "test.namespace");
// the global namespace is prepended to every key (optional)
$statsd->setNamespace("test");
// simple counts
$statsd->increment("request");


// Create a mapper
$mapper = new UserMapper($logger);

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// REST OF REQUEST ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Create Users and persist them
$logger->applicationLog('Beginning User Creation', Logger::INFO);

// Run infinate loop to generate data for statsd

while(true) {
    
    $statsd->increment("user.creation.startevent");
    
    for($x = 0; $x <= 4; $x++)
    {

        $user = new User(rand(1, 10000), 'Betty Boo');

        // The mapper generates some informational logs when the
        // the user record is 'saved'
        $mapper->save($user); 

        $statsd->increment("user.created");

        unset($user);

        if($x%2 === 0) {

            // Simulate some kind of security warning when creating some 
            // of the users.
            $logger->securityLog('UNSAFE USER!', Logger::WARNING);
            $statsd->increment("security.userwarning");
        }
    }
    
     sleep(rand(1, 15));
    
    $statsd->increment("user.creation.endevent");
}
