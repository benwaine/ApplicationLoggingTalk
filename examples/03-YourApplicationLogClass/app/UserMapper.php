<?php

class UserMapper {
   
    protected $logger;
    
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    public function save(User $user)
    {
        
        $this->logger->applicationLog('Saving User: ' . $user->getID(), Logger::INFO);
        
        // Code For Saving User
        
    }
    
}


