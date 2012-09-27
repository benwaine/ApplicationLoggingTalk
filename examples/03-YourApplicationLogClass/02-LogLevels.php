<?php

require_once __DIR__ . '/app/User.php';
require_once __DIR__ . '/app/UserMapper.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$environemnt = getenv('ENVIRONMENT');
$level = ($environemnt == "live") ? Logger::NOTICE : Logger::DEBUG;

// Create a New MonoLog
$logger = new Monolog\Logger('Application Log');
// Add a handler (writter)
$logger->pushHandler(new StreamHandler('/tmp/user.log', $level));

// Create a mapper
$mapper = new UserMapper($logger);

// Create Users and persist them
$logger->notice('Beginning User Creation');

while(true)
{
    $user = new User(rand(1, 10000), 'Betty Boo');
    
    $mapper->save($user);
    
    sleep(1);
    
    unset($user);
}