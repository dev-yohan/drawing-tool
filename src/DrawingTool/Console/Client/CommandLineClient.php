<?php
namespace DrawingTool\Console\Client;

use \DrawingTool\Console\Messages\ConsoleMessenger;
use \DrawingTool\Validator\RegexValidator;

class CommandLineClient {

  private $messenger;
  private $regexValidator;

  function __construct(){
    $this->messenger = new ConsoleMessenger;
    $this->regexValidator = new RegexValidator;
  }

  function isCommandLineClient() {
      return (php_sapi_name() === 'cli' OR defined('STDIN'));
  }

  function startCommandInteraction(){

    $this->askForCommand("Write YES to start!", "/^[A-Z0-9]{3}-[A-Z]{2}$/");

  }

  function askForCommand($message, $regex){

    $this->messenger->printMessage($message);
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");

    if (!$this->regexValidator->validateRegex($regex, $line)) {
      $this->messenger->printMessage("Invalid Entry");
        $this->startCommandInteraction();
    } else {
      $this->messenger->printMessage("Continuing...");
        return $line;
    }

  }

}
