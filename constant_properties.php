<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Defining and Using Object Constant Properties</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	 <h1>Defining and Using Object Constant Properties</h1>

			     <?php

/*
For example, for the Car class you could define class constants to 
represent various types of cars, then use these constants when 
creating Car objects. In this example, the Car class contains three 
class constants — HATCHBACK, STATION_WAGON, and SUV — that are 
assigned the values 1, 2, and 3, respectively. These constants are 
then used when setting and reading the $type property of the $myCar 
object.
*/
			     		class Car {

			     			const HATCHBACK = 1;
                const STATION_WAGON = 2;
                const SUV = 3;

                public $model;
                public $color;
                public $manufacturer;
                public $type;
			     		}

			     		$myCar = new Car();

			     		$myCar->model = "Dodge Caliber";
              $myCar->color = "blue";
              $myCar->manufacturer = "Chrysler";
              $myCar->type = Car::HATCHBACK;

			     		echo "<h2>This $myCar->model is a </h2>";
			     		
              switch ($myCar->type) {
                case Car::HATCHBACK:
                    echo "<h2>HATCHBACK Baby!</h2>";
                  break;
                
                case Car::STATION_WAGON:
                    echo "<h2>STATION_WAGON Baby!</h2>";
                  break;

                  case Car::SUV:
                    echo "<h2>SUV Baby!</h2>";
                  break;
                  
                default:
                 
                  break;
              }
        	    ?>
         
        </body>
	</html>
