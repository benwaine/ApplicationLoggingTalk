<?php

use Monolog\Logger as MLogger;
use Monolog\Handler\StreamHandler;

class Logger {
    /**
     * Detailed debug information
     */

    const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = 200;

    /**
     * Uncommon events
     */
    const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = 300;

    /**
     * Runtime errors
     */
    const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = 550;

    /**
     * Urgent alert.
     */
    const EMERGENCY = 600;

    /**
     * @var MLogger           
     */
    protected $application;

    /**
     * @var MLogger 
     */
    protected $secuirty;
    
    /**
     * @var array
     */
    protected $requestParams;
    
    /**
     * @var string 
     */
    protected $requestId;

    /**
     * Creates an instance of the Logger. 
     * 
     * @param Logger $logger 
     */
    public function __construct(MLogger $application, MLogger $security, array $requestParams) {
        
        $this->application = $application;
        $this->secuirty = $security;
        $this->requestParams = $requestParams;
        
        $this->requestId = md5(microtime() . $this->requestParams['REMOTE_ADDR']);
    }

    /**
     * Adds a record to the application log.
     * 
     * @param string $message
     * @param int $level 
     * 
     * @return void
     */
    public function applicationLog($message, $level) {
        
        // Including a request identifier allows us to track a users progress 
        // throughout the application by grepping the ID.
        
        $context = array('RID' => $this->requestId);
        
        $this->application->addRecord($level, $message, $context);
    }

    /**
     * Adds a record to the security log.
     * 
     * @param string $message
     * @param int $level 
     * 
     * @return void
     */
    public function securityLog($message, $level) {
        
        // The security may require additional information that the normal 
        // applicaton log does not. IP address etc. 
        
        $context = array(
            'RID' => $this->requestId,
            'IP' => $this->requestParams['REMOTE_ADDR']
            );
        
        $this->securityLog($message, $level, $context);
    }
    
}

