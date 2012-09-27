<?php

require_once __DIR__ . '/app/User.php';
require_once __DIR__ . '/app/UserMapper.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Create a mapper
$mapper = new UserMapper();

// Create Users and persist them
error_log('Beginning User Creation');

while(true)
{
    $user = new User(rand(1, 10000), 'Betty Boo');
    
    $mapper->save($user);
    
    sleep(1);
    
    unset($user);
}