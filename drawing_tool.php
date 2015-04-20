<?php

require 'vendor/autoload.php';

use \DrawingTool\Console\Messages\ConsoleMessenger;
use \DrawingTool\Console\Client\CommandLineClient;
use \DrawingTool\Draw\Figure\Canvas;

$messenger = new ConsoleMessenger;
$client = new CommandLineClient;

$canvasCreated = false;

if(!$client->isCommandLineClient()){
  $messenger->printMessage("no command line available");
}
else
{
  $line = '';

  if($client->startCommandInteraction($line)){

    if($client->startCanvasCreation($line))
    {
      $components = explode(" ", $line);
      $canvas = new Canvas(intval($components[1]), intval($components[2]));
      $canvas-> build();
      $canvas-> draw();

      $client->listenCanvasCommand($canvas, $line);

    }
    else{
      $messenger->printMessage("Canvas creation canceled\n");
    }
  }
  else{
    $messenger->printMessage("Tool closed, please execute php drawing_tool.php to start\n");
  }
}

?>
