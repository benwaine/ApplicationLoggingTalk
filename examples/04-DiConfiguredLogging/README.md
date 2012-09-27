# 02 Logging As A Dependency

This example uses the popular logging library Monolog to show a more flexible
object oriented approach to logging.

## Examples 

### Basic Logging with Monolog 

Run the following: 

````
php 01-basic.php

tail -f /tmp/user.log
````

On the surface this example produces the same effect as example two in the 
previous section. However when looking at the implementation there are some key 
differences.

The following sample from the example instanciates a monolog logging object 
and injects it into the UserMapper object on instanciation.

````php
// Create a New MonoLog
$logger = new Monolog\Logger('Application Log');
// Add a handler (writter)
$logger->pushHandler(new StreamHandler('/tmp/user.log', Logger::DEBUG));

// Create a mapper
$mapper = new UserMapper($logger);

// Create Users and persist them
$logger->notice('Beginning User Creation');
````

The UserMapper requires the ability to log as part of its role so it makes
sense to make Monolog a dependency in this way.

Rather than using PHP's error_log function to do logging the UserMapper now uses
 the previously injected logging object. 

````php 
    
    public function save(User $user)
    {
        
        $this->logger->info('Saving User: ' . $user->getID());
        
        // Code For Saving User
        
    }

````

### Log Levels



 