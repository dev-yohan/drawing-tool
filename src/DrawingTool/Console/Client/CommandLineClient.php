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
    $line = trim(fgets($handle), "\r\n");

     if($this->regexValidator->validateRegex("/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $line)){
       $components = explode(" ", $line);
       $canvas = new Canvas(intval($components[1]), intval($components[2]));
       $canvas-> build();
       $canvas-> draw();
       $this->listenCanvasCommand($canvas, $line);
     }
     else if($this->regexValidator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $line))
     {
         $coords = explode(" ", $line);
         $x1 = intval($coords[1]);
         $y1 = intval($coords[2]);
         $x2 = intval($coords[3]);
         $y2 = intval($coords[4]);

         if($canvas->validateLineViability($x1, $y1, $x2, $y2))
         {
           if($canvas->validateLineBounds($x1, $y1, $x2, $y2))
           {
             $canvas->drawLine($x1, $y1, $x2, $y2);
             $canvas-> draw();
           }
           else
           {  $this->messenger->printMessage("Line is out of bounds!\n"); }
         }
         else
         {  $this->messenger->printMessage("Diagonal lines are not supported!\n");  }

         $this->listenCanvasCommand($canvas, $line);
     }
     else if($this->regexValidator->validateRegex("/^[R]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $line))
     {
         $coords = explode(" ", $line);
         $x1 = intval($coords[1]);
         $y1 = intval($coords[2]);
         $x2 = intval($coords[3]);
         $y2 = intval($coords[4]);

         if($canvas->validateRectangleViability($x1, $y1, $x2, $y2)){
           if($canvas->validateLineBounds($x1, $y1, $x2, $y2))
           {
             $canvas->drawRectangle($x1, $y1, $x2, $y2);
             $canvas-> draw();
           }
           else
           {$this->messenger->printMessage("Rectangle is out of bounds!\n");}
         }
         else
         {$this->messenger->printMessage("Rectangle is not viable\n");}

         $this->listenCanvasCommand($canvas, $line);

     }
     else if($this->regexValidator->validateRegex("/^[B]{1} [0-9]{1,2} [0-9]{1,2} [a-z]{1}$/", $line))
     {
         $coords = explode(" ", $line);
         $x = intval($coords[1]);
         $y = intval($coords[2]);
         $color = $coords[3];

         if($canvas->validatePointViability($x, $y)){
           $canvas->fillArea(intval($coords[1]), intval($coords[2]),  $coords[3]);
           $canvas-> draw();
         }
         else
         {$this->messenger->printMessage("Point is out of bounds\n");}
         $this->listenCanvasCommand($canvas, $line);
     }
     else if($this->regexValidator->validateRegex("/^[Q]{1}$/", $line))
     {  $this->messenger->printMessage("Tool reseted\n"); }
     else
     {
         $this->messenger->printMessage("Invalid command\n");
         $this->listenCanvasCommand($canvas, $line);
     }

  }

  function evaluateCommand($message, $regex, &$line){

    $this->messenger->printMessage($message);
    $handle = fopen ('php://stdin','r');
    $line = trim(fgets($handle), "\r\n");

    if($line === 'Q')
    {return false;}

    if (!$this->regexValidator->validateRegex($regex, $line)) {
      $this->messenger->printMessage("Invalid Entry\n");
        return false;
    } else {
        return true;
    }

  }


  function askForCommand($message, $regex, &$line){

    $this->messenger->printMessage($message);
    $handle = fopen ('php://stdin','r');
    $line = trim(fgets($handle), "\r\n");

    if($line === 'Q')
    {return false;}

    if (!$this->regexValidator->validateRegex($regex, $line)) {
      $this->messenger->printMessage("Invalid Entry\n");
        return $this->askForCommand($message, $regex, $line);
    } else {
        return true;
    }

  }

}
