<?php
namespace DrawingTool\Tests\Validator;

require 'vendor/autoload.php';

use \DrawingTool\Validator\RegexValidator;

class RegexValidatorTest extends \PHPUnit_Framework_TestCase{

  private $validator;

  public function setUp(){
    $this->validator = new RegexValidator;
  }

  public function testRightCanvasExpression()
  {
    $expression = "C 20 20";
    $this->assertEquals(1, $this->validator->validateRegex("/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadCanvasExpression1()
  {
    $expression = "C 200 20";
    $this->assertEquals(0, $this->validator->validateRegex("/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadCanvasExpression2()
  {
    $expression = "c 200 20";
    $this->assertEquals(0, $this->validator->validateRegex("/^[C]{1} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testRightLineExpression()
  {
    $expression = "L 20 20 4 5";
    $this->assertEquals(1, $this->validator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadLineExpression1()
  {
    $expression = "L 200 20 -1 -6";
    $this->assertEquals(0, $this->validator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadLineExpression2()
  {
    $expression = "L 200 20 2";
    $this->assertEquals(0, $this->validator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadLineExpression3()
  {
    $expression = "l 200 20 2 1";
    $this->assertEquals(0, $this->validator->validateRegex("/^[L]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testRightRectangleExpression()
  {
    $expression = "R 1 1 5 5";
    $this->assertEquals(1, $this->validator->validateRegex("/^[R]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadRectangleExpression1()
  {
    $expression = "R 1 1 5 -5";
    $this->assertEquals(0, $this->validator->validateRegex("/^[R]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadRectangleExpression2()
  {
    $expression = "R 100 1 500 5";
    $this->assertEquals(0, $this->validator->validateRegex("/^[R]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

  public function testBadRectangleExpression3()
  {
    $expression = "R 200 20 2 1";
    $this->assertEquals(0, $this->validator->validateRegex("/^[R]{1} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2} [0-9]{1,2}$/", $expression));
  }

}
