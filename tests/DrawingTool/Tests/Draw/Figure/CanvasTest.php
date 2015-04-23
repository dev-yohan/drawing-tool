<?php
namespace DrawingTool\Tests\Draw\Figure;

require 'vendor/autoload.php';

use \DrawingTool\Draw\Figure\Canvas;

class CanvasTest extends \PHPUnit_Framework_TestCase{

  private $canvas;

  public function setUp(){
    $this->canvas = new Canvas(20, 20);
  }

  public function testCanvasBuild()
  {
    $this->canvas->build();
    $this->assertContains(' ', $this->canvas->pixels[0]);
  }

  public function testCanvasLineViability()
  {
    $this->assertTrue($this->canvas->validateLineViability(1, 1, 10, 1));
  }

  public function testCanvasLinenInfeasibility1()
  {
    $this->assertFalse($this->canvas->validateLineViability(1, 1, 10, 3));
  }

  public function testCanvasLinenInfeasibility2()
  {
    $this->assertFalse($this->canvas->validateLineViability(-1, 1, 10, 3));
  }

  public function testCanvasLineBounds()
  {
    $this->assertTrue($this->canvas->validateLineBounds(1, 1, 19, 1));
  }

  public function testCanvasLineOutOfBounds1()
  {
    $this->assertFalse($this->canvas->validateLineBounds(1, 1, 21, 1));
  }

  public function testCanvasLineOutOfBounds2()
  {
    $this->assertFalse($this->canvas->validateLineBounds(1, 21, 21, 1));
  }

  public function testCanvasRectangleViability()
  {
    $this->assertTrue($this->canvas->validateRectangleViability(1, 1, 5, 5));
  }

  public function testCanvasRectangleInfeasibility1()
  {
    $this->assertFalse($this->canvas->validateRectangleViability(5, 5, 1, 1));
  }

  public function testCanvasRectangleInfeasibility2()
  {
    $this->assertFalse($this->canvas->validateRectangleViability(1, 3, -1, 5));
  }

  public function testCanvasPointViability()
  {
    $this->assertTrue($this->canvas->validatePointViability(1, 1));
  }

  public function testCanvasPointInfeasibility1()
  {
    $this->assertFalse($this->canvas->validatePointViability(21, 1));
  }

  public function testCanvasPointInfeasibility2()
  {
    $this->assertFalse($this->canvas->validatePointViability(1, 100));
  }

  public function testCanvasPointInfeasibility3()
  {
    $this->assertFalse($this->canvas->validatePointViability(-1, 0));
  }

  public function testLineDrawn(){
    $this->canvas->build();
    $this->canvas->drawLine(1, 1, 10, 1);
    $this->assertContains('x', $this->canvas->pixels[0]);
  }

  public function testRectangleDrawn1(){
    $this->canvas->build();
    $this->canvas->drawRectangle(1, 1, 5, 5);
    $this->assertContains('x', $this->canvas->pixels[0][4]);
  }

  public function testRectangleDrawn2(){
    $this->canvas->build();
    $this->canvas->drawRectangle(1, 1, 5, 5);
    $this->assertContains('x', $this->canvas->pixels[0][1]);
  }

  public function testFill1(){
    $this->canvas->build();
    $this->canvas->fillArea(5, 5, "a");
    $this->assertContains('a', $this->canvas->pixels[3][3]);
  }

  public function testFill2(){
    $this->canvas->build();
    $this->canvas->drawRectangle(1, 1, 5, 5);
    $this->canvas->fillArea(7, 7, "a");
    $this->assertContains('x', $this->canvas->pixels[0][1]);
  }

}
