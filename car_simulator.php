<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>A Simple Car Simulator</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	 <h1>A Simple Car Simulator</h1>

			     <?php

			     		class Car {

                public $model;
                public $color;
                public $manufacturer;

/*
Notice that the Car class contains a private property, $_speed. This is good OOP practice, 
because you should keep an object’s data and behaviors private unless they absolutely need 
to be publicly available. In this case, you don’t want outside code to be able to directly 
read or modify the car’s speed; instead the calling code should use the three methods you 
created. For this reason, it makes sense for $_speed to be private.
Incidentally, the underscore at the start of the $_speed variable name is a common coding 
practice used to indicate private properties and methods. You don’t have to use this 
convention, but it can make it easier to identify private class members at a glance.
*/
                private $_speed = 0;

//// accelerate() speeds up the car by 10 mph, returning true if successful. If the car is already at top
// speed — 100 mph — the car isn’t accelerated any further, and accelerate() returns false
                public function accelerate() {

                  if ($this->_speed >= 100) {
                    return false;
                  }

                  $this->_speed += 10;
                  return true;
                }

/// brake() does the opposite of accelerate() — it decreases speed by 10 mph, returning true if successful,
// or false if the car is stationary
                public function brake() {
                  
                  if ($this->_speed <= 0) {
                    return false;
                  }

                  $this->_speed -= 10;
                  return true;
                }

//// getSpeed() simply returns the car’s current speed, in mph
                public function getSpeed() {
                  
                  return $this->_speed;
                }
			     		}

			     		$myCar = new Car();

			     		$myCar->model = "Dodge Caliber";
              $myCar->color = "blue";
              $myCar->manufacturer = "Chrysler";
              

			     		echo "<p>I am driving a $myCar->color $myCar->manufacturer $myCar->model.</p>";
			     		echo "<p>Stepping on the gas...<br />";
              
              while ($myCar->accelerate()) {

                echo "Current Speed: " . $myCar->getSpeed() . " mph<br />";
              }
              echo "</p><p>Top speed! Slowing down...<br />";

              while ( $myCar->brake()) {
                
                echo "Current Speed: " . $myCar->getSpeed() . " mph<br />";
              }

             echo "</p><p>Stopped!</p> ";
        	 ?>
         
        </body>
	</html>
