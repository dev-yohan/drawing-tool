<?php

require 'vendor/autoload.php';

use \DrawingTool\Console\Messages\ConsoleMessenger;
use \DrawingTool\Console\Client\CommandLineClient;

$messenger = new ConsoleMessenger;
$client = new CommandLineClient;

if(!$client->isCommandLineClient()){
  $messenger->printMessage("no command line available");
}
else
{
  $messenger->printMessage("hola");
  $client->startCommandInteraction();
}





/*function isCLI() {
    return (php_sapi_name() === 'cli' OR defined('STDIN'));
}

function userPrompt($message, $validator=null) {
    if (!isCLI()) return null;

    print($message);
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");

    if (is_callable($validator) && !call_user_func($validator, $line)) {
        print("Invalid Entry.\r\n");
        return userPrompt($message, $validator);
    } else {
        print("Continuing...\r\n");
        return $line;
    }
}

// Example =====================

function validateSetLangCode($str) {
    return preg_match("/^[A-Z0-9]{3}-[A-Z]{2}$/", $str);
}

$code = userPrompt("Please enter the set / language codes. Use the format 'SET-EN', where SET is the three-letter set code and EN is the two-letter lang code. \r\n", 'validateSetLangCode') ?: 'SET-EN';
var_dump($code);*/



?>
