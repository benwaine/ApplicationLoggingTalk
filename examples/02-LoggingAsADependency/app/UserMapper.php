<?php

use Monolog\Logger;

class UserMapper {
   
    protected $logger;
    
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    public function save(User $user)
    {
        
        $this->logger->info('Saving User: ' . $user->getID());
        
        // Code For Saving User
        
    }
    
}


