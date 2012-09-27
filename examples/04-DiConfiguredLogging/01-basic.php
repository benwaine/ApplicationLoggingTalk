<?php
require_once __DIR__ . '/app/Logger.php';
require_once __DIR__ . '/app/User.php';
require_once __DIR__ . '/app/UserMapper.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// BOOTSTRAPPING /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Set Up Container
$container = new ContainerBuilder;
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load("services.yml");

// Get Mapper and Logger
$logger = $container->get('logger');
$mapper = $container->get('UserMapper');
//var_dump($logger); exit;
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// REST OF REQUEST ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Create Users and persist them
$logger->applicationLog('Beginning User Creation', Logger::INFO);

for($x = 0; $x <= 4; $x++)
{
    
    $user = new User(rand(1, 10000), 'Betty Boo');
    
    // The mapper generates some informational logs when the
    // the user record is 'saved'
    $mapper->save($user); 
    
    unset($user);
    
    if($x % 2) {
        
        // Simulate some kind of security warning when creating some 
        // of the users.
        $logger->securityLog('UNSAFE USER!', Logger::WARNING);
    }
}

$logger->applicationLog('Ending User Creation', Logger::INFO);