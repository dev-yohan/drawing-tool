# drawing-tool

#1. How to install
In your shell please execute:
```
$git clone https://github.com/dev-yohan/drawing-tool.git <your_folder>
$cd <your_folder>
$php composer.phar install
```
#2. How to execute
From a shell window go to <your_folder> and execute:
```
$cd <your_folder>
$php drawing_tool.php
```
#3. How to use
Once the app starts, from shell write YES to start:
```
Write YES to start!, write Q to quit: YES
```
After start, you can use the following commands:

  * C w h Should create a new canvas of width w and height h. 
  * L x1 y1 x2 y2 Should create a new line from (x1,y1) to (x2,y2). Currently only horizontal or vertical lines are supported. Horizontal and vertical lines will be drawn using the 'x' character. 
  * R x1 y1 x2 y2 Should create a new rectangle, whose upper left corner is (x1,y1) and lower right corner is (x2,y2). Horizontal and vertical lines will be drawn using the 'x' character. 
  * B x y c Should fill the entire area connected to (x,y) with "colour" c. The behaviour of this is the same as that of the "bucket fill" tool in paint programs. 
  * Q Should quit the program.

Remember to create a canvas before draw some figures

#4. Sample I/O
```
enter command: C 10 10
 -  -  -  -  -  -  -  -  -  -  -  -
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 -  -  -  -  -  -  -  -  -  -  -  -

```
```
enter command: C 10 10
 -  -  -  -  -  -  -  -  -  -  -  -
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 -  -  -  -  -  -  -  -  -  -  -  -

```
```
enter command: L 1 1 9 1
 -  -  -  -  -  -  -  -  -  -  -  -
 |  x  x  x  x  x  x  x  x  x     |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |
 |                                |

```
```
enter command: R 3 3 6 6
 -  -  -  -  -  -  -  -  -  -  -  -
 |  x  x  x  x  x  x  x  x  x     |
 |                                |
 |        x  x  x  x              |
 |        x        x              |
 |        x        x              |
 |        x  x  x  x              |
 |                                |
 |                                |
 |                                |
 |                                |

```
```
enter command: L 7 5 7 10
 -  -  -  -  -  -  -  -  -  -  -  -
 |  x  x  x  x  x  x  x  x  x     |
 |                                |
 |        x  x  x  x              |
 |        x        x              |
 |        x        x  x           |
 |        x  x  x  x  x           |
 |                    x           |
 |                    x           |
 |                    x           |
 |                    x           |
 -  -  -  -  -  -  -  -  -  -  -  -
```
```
enter command: B 9 9 o
-  -  -  -  -  -  -  -  -  -  -  -
 |  x  x  x  x  x  x  x  x  x  o  |
 |  o  o  o  o  o  o  o  o  o  o  |
 |  o  o  x  x  x  x  o  o  o  o  |
 |  o  o  x        x  o  o  o  o  |
 |  o  o  x        x  x  o  o  o  |
 |  o  o  x  x  x  x  x  o  o  o  |
 |  o  o  o  o  o  o  x  o  o  o  |
 |  o  o  o  o  o  o  x  o  o  o  |
 |  o  o  o  o  o  o  x  o  o  o  |
 |  o  o  o  o  o  o  x  o  o  o  |
 -  -  -  -  -  -  -  -  -  -  -  -
```
#5. Unit tests
To run PHPUnit test execute
```
$cd <your_folder>
$/vendor/bin/phpunit
PHPUnit 4.6.4 by Sebastian Bergmann and contributors.

..............................

Time: 814 ms, Memory: 4.75Mb

OK (30 tests, 30 assertions)
```
