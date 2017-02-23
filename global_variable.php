<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Global variable</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	 <h1>Global variable</h1>

			     <?php
//////////////////////////////////////////////////////////////////// (1)
              $myGlobal = "Hello there!";

              ////// Super globals
      		    function hello() {
                echo $GLOBALS["myGlobal"] . "<br/>";
              }

              hello(); // Displays “Hello there!”

//////////////////////////////////////////////////////////////////// (2)

              ////////// External globals
              $myGlobal1 = "Hello there!";

              function hello1() {
                    global $myGlobal1;
                    echo "$myGlobal1<br/>";
              }
              hello1(); // Displays “Hello there!”

//////////////////////////////////////////////////////////////////// (3)

         //////// Declare globals inside functions      
              function setup1() {
                global $myGlobal2;
                $myGlobal2 = "Hello there!";
              }
              function hello2() {
                global $myGlobal2;
                echo "$myGlobal2 <br/>";
              }

              //need to call setup function to set up global variable
              setup1();
              hello2(); // Displays “Hello there!”

			    ?>
          
        </body>
	</html>

