<?php
namespace DrawingTool\Console\Client;

use \DrawingTool\Console\Messages\ConsoleMessenger;
use \DrawingTool\Validator\RegexValidator;
use \DrawingTool\Draw\Figure\Canvas;

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

  function startCommandInteraction(&$line){

    $line = '';
    return $this->askForCommand("Write YES to start!, write Q to quit: ", "/^[A-Z]{3}$/", $line);
  }

  function startCanvasCreation(&$line){
    return $this->askForCommand("enter command: ", "/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $line);
  }


  function listenCanvasCommand(&$canvas, &$line){

    $this->messenger->printMessage("enter command: ");
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");

     if($this->regexValidator->validateRegex("/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $line)){
       $components = explode(" ", $line);
       $canvas = new Canvas(intval($components[1]), intval($components[2]));
       $canvas-> build();
       $canvas-> draw();
       $this->listenCanvasCommand($canvas, $line);
     }
     else if($this->regexValidator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $line)){
       $components = explode(" ", $line);
       $canvas->drawLine($components[1], $components[2], $components[3], $components[4]);
       $canvas-> draw();
       $this->listenCanvasCommand($canvas, $line);
     }

  }

  function evaluateCommand($message, $regex, &$line){

    $this->messenger->printMessage($message);
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");

    if($line === 'Q')
    {return false;}

    if (!$this->regexValidator->validateRegex($regex, $line)) {
      $this->messenger->printMessage("Invalid Entry ".$line." ".$regex."\n");
        return false;
    } else {
      //$this->messenger->printMessage("Continuing...\n");
        //return $line;
        return true;
    }

  }


  function askForCommand($message, $regex, &$line){

    $this->messenger->printMessage($message);
    $handle = fopen ('php://stdin','r');
    $line = rtrim(fgets($handle), "\r\n");

    if($line === 'Q')
    {return false;}

    if (!$this->regexValidator->validateRegex($regex, $line)) {
      $this->messenger->printMessage("Invalid Entry ".$line." ".$regex."\n");
        return $this->askForCommand($message, $regex, $line);
    } else {
      //$this->messenger->printMessage("Continuing...\n");
        //return $line;
        return true;
    }

  }

}
