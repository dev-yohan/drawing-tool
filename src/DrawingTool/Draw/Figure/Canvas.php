<?php
namespace DrawingTool\Draw\Figure;

use \DrawingTool\Draw\Figure\DrawableInterface;

class Canvas implements DrawableInterface{

   public $width;
   public $height;
   public $pixels;

   public function __construct($width, $height){

     $this->width = $width;
     $this->height = $height;
     $this->pixels = array();

   }

   public function build(){

     for($i = 0; $i < $this->height; $i++)
     {
       for($j = 0; $j < $this->width; $j++)
       {
         $this->pixels[$i][$j] = " ";
       }
     }

   }

   
   public function validateLineViability($x1, $y1, $x2, $y2){
     if($x1 == $x2 || $y1 == $y2)
     {return true;}
     else
     {return false;}
   }

   public function validateLineBounds($x1, $y1, $x2, $y2){
     if($x1 <= $this->width && $x2 <= $this->width && $y1 <= $this->height && $y2 <= $this->height)
     {return true;}
     else
     {return false;}
   }

   public function drawLine($x1, $y1, $x2, $y2){

     for($i = 0; $i < $this->width; $i++)
     {
       for($j = 0; $j < $this->height; $j++)
       {
         if($i>= $x1-1 && $i <= $x2-1 && $j>= $y1-1 && $j <= $y2-1){
           $this->pixels[$j][$i] = "x";
         }
       }
     }

   }

   public function draw(){

     for($i = 0; $i < $this->height + 2; $i++)
     {
       if($i == 0 || $i == $this->height + 1)
       {
         for($j = 0; $j < $this->width + 2; $j++)
         {
            echo " - ";
         }
         echo "\n";
       }
      else{
        for($j = 0; $j < $this->width + 2; $j++)
        {
           if($j == 0 || $j == $this->width + 1)
           {
             echo " | ";
           }
           else
           {
             echo " ".$this->pixels[$i-1][$j-1]." ";
           }
        }
        echo "\n";
      }

     }

   }

}
