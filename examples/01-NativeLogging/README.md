# 01 - Basic Logging Using error_log

This example shows basic logging using PHP's built in error_log function.

## Examples 

Run the following: 

````
php 01-basic.php
````

If no value is set for error_log in your php.ini file the log messages will
appear on your screen.   

Run the following: 

````
php 02-ToFIle.php
````

Line 7 alters php's configuration to ensure that the log lines are written to a 
file in your systems temp directory. 

see this in action by running: 

````
tail -f /tmp/user.log 
````

## Pros

* Built into PHP so is always available

## Cons

* Not very flexible 
* No support for log levels (see next example)

