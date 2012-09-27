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
$logger = $container->get('Logger');
$mapper = $container->get('UserMapper');

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// REST OF REQUEST ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Create Users and persist them


// Run infinate loop to generate data for statsd

while(true) {

    
    $number = rand(1, 10);
    
    for($x = 0; $x <= $number; $x++)
    {

        $user = new User(rand(1, 10000), 'Betty Boo');
        
        $mapper->save($user); 
        
        $logger->logBusinessEvent(Logger::EVENT_USERCREATED);
        
        unset($user);

        if($x%2 === 0) {

            // Simulate some kind of security warning when creating some 
            // of the users.
            
            $logger->logBusinessEvent(Logger::EVENT_USERWARNING);
        }
    }
    
     sleep(rand(1, 15));
    
}
