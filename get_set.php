<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Using __get() and __set()</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Using __get() and __set()</h1>
   <!--The following example shows how __get() and __set() can be used to store “nonexistent” properties in a private array. This effectively creates a class with a potentially unlimited number of “virtual” properties that are kept safely away from any real properties of the class. This technique can be useful for creating classes that need to hold arbitrary data.-->
          		 <?php
  				
  					class Car 
  					{
  						public $manufacturer;
  						public $model;
  						public $color;
  						private $_extraData  = array();

  						public function __get($propertyName)
  						{
                /*
                  The Car class also contains a __get() method that looks
                   up the requested property name in the keys of the 
                   $_extraData array, returning the corresponding value in 
                   the array (if found)
                */
  							if (array_key_exists($propertyName, $this->_extraData)) {
  								
  								return $this->_extraData[$propertyName];
  							}

  							else {
  								return null;
  							}
  						}

  						public function __set($propertyName, $propertyValue){
  							/*
                   The corresponding __set() method takes the supplied 
                   property name and value, and stores the value in the 
                   $_extraData array, keyed by the property name.
                */
  							$this->_extraData[$propertyName] = $propertyValue;
  						}
  					}
			     	
			     	$myCar = new Car();
					  $myCar->manufacturer = "Volkswagen";
					  $myCar->model = "Beetle";
					  $myCar->color = "red";

            /*
              The fourth property, $engineSize, doesn’t exist in the class, 
              so the __set() method is called; this in turn creates an array 
              element in $_extraData with a key of “engineSize” and a value of 
              1.8.
              Similarly, the fifth property, $otherColors, also doesn’t 
              exist in the Car class, so __set() is called, creating 
              an array element in $extraData with a key of “otherColors” 
              that stores the passed-in value, which in this case is an 
              array containing the strings “green”, “blue”, and “purple”.
            */
					  $myCar->engineSize = 1.8;
					  $myCar->otherColors = array( "green", "blue", "purple" );

					    echo "<h2>Some properties:</h2>";
      				echo "<p>My car’s manufacturer is " . $myCar->manufacturer . ".</p>";
      				echo "<p>My car's engine size is " . $myCar->engineSize . ".</p>";

              /*
                The script also tries to retrieve the value of a property called 
                $fuelType; because this doesn’t exist in the class or in the 
                $_extraData array, the __get( method returns null to the calling 
                code. 
              */
      				echo "<p>My car's fuel type is " . $myCar->fuelType . ".</p>";
      				echo "<h2>The \$myCar Object:</h2><pre>";
      				print_r( $myCar );
      				echo "</pre>";
           		?>
        
        </body>
	</html>