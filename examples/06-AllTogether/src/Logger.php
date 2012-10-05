<?php

use Monolog\Logger as MLogger;
use Monolog\Handler\StreamHandler;
use Domnikl\Statsd\Client;
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
     * User Registration Event 
     */
    const EVENT_USERREG = 0;
    
    /**
     * Donation Event 
     */
    const EVENT_DONATION = 1;
    
   /**
    * Contact Event 
    */
    const EVENT_CONTACT = 2;
    
    /**
     * Dontation Total Event 
     */
    const EVENT_TOTALDONATION = 3;
    
    /**
     * Dontation Total Event 
     */
    const EVENT_REQUESTTIME = 4;
    
    /**
     * Array containign event strings for use with statsd.
     *  
     * @var array 
     */
    private $events = array(
        Logger::EVENT_USERREG  => "user.registration",
        Logger::EVENT_DONATION => "donation.occurence",
        Logger::EVENT_TOTALDONATION => "donation.total",
        Logger::EVENT_CONTACT  => "contact.website",
        Logger::EVENT_REQUESTTIME => 'request.time'
    );
    
    /**
     * @var MLogger           
     */
    protected $application;

    /**
     * @var MLogger 
     */
    protected $security;
    
    /**
     * 
     * @var type 
     */
    protected $statsd;
    
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
    public function __construct(MLogger $application, MLogger $security, Client $client, array $requestParams) {
        
        $this->application = $application;
        $this->security = $security;
        $this->statsd = $client;
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
    public function applicationLog($message, $level, $contextIn = array()) {
        
        // Including a request identifier allows us to track a users progress 
        // throughout the application by grepping the ID.
        
        $context = array('RID' => $this->requestId);
        
        $context = $context + $contextIn;
        
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
        
        $this->security->addRecord($level, $message, $context);
    }
    
    /**
     * Logs an event using statsd.
     * 
     * @param int $event 
     * 
     * @return void
     */
    public function logBusinessEvent($event) {
        
        if(!isset($this->events[$event]))
        {
            throw new \Exception('Invalid Logging Event');
        }
        
        $this->statsd->increment($this->events[$event]);
        
    }
    
    /**
     * Logs an event with count.
     * 
     * @param int $event 
     * 
     * @return void
     */
    public function logBusinessCount($event, $count) {
        
        if(!isset($this->events[$event]))
        {
            throw new \Exception('Invalid Logging Event');
        }
        
        $this->statsd->count($this->events[$event], $count);        
    }
    
    /**
     * Logs a timing with StatsD.
     * 
     * @return void 
     */
    public function logBusinessTime($event, $time)
    {
        if(!isset($this->events[$event]))
        {
            throw new \Exception('Invalid Logging Event');
        }
        
        $this->statsd->timing($this->events[$event], $time);
    }
    
            
    
}

