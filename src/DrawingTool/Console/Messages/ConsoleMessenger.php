<?php
namespace DrawingTool\Console\Messages;

use \DrawingTool\Console\Messages\MessageInterface;

class ConsoleMessenger implements MessageInterface{

  public function printMessage($message){

     echo $message."\n";

  }


}
