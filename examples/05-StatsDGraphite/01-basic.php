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

$mapper = $container->get('UserMapper');

// Creating StatsD Client 
$connection = new \Domnikl\Statsd\Connection\Socket('localhost', 8125);
$statsd = new \Domnikl\Statsd\Client($connection, "beta");

// simple counts
$statsd->increment("request");

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// REST OF REQUEST ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// Create Users and persist them


// Run infinate loop to generate data for statsd

while(true) {
    $number = rand(1, 10);
    $statsd->increment("user.creation.startevent");
    
    for($x = 0; $x <= $number; $x++)
    {

        $user = new User(rand(1, 10000), 'Betty Boo');
        
        $mapper->save($user); 

        $statsd->increment("user.created");

        unset($user);

        if($x%2 === 0) {

            // Simulate some kind of security warning when creating some 
            // of the users.
            $statsd->increment("security.userwarning");
        }
    }
    
     sleep(rand(1, 15));
    
    $statsd->increment("user.creation.endevent");
}
