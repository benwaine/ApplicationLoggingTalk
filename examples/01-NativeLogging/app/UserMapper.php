<?php

use Monolog\Logger;

class UserMapper {
    
    public function save(User $user)
    {
        
       error_log('Saving User: ' . $user->getId());
        
       // Code For Saving User
        
    }
    
}


