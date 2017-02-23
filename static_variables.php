<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Static Variable</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Static Variable</h1>
			     <?php
  
///////// The first time the function is called, the variable is set 
      // to its initial value (zero in this example). However, if the 
      // variable’s value is changed within the function, the new value 
      // is remembered the next time the function is called. The value is 
      // remembered only as long as the script runs, so the next time you 
      // run the script the variable is reinitialized.    		  
        function nextNumber() {
            $counter = 0;
            return ++$counter;
        }
      echo "I’ve counted to: " . nextNumber() . "<br/>"; //Displays 1
      echo "I’ve counted to: " . nextNumber() . "<br/>"; //Displays 1
      echo "I’ve counted to: " . nextNumber() . "<br/>"; //Displays 1

/////// Each time the nextNumber() function is called, its $counter 
      // local variable is re-created and initialized to zero. Then it’s 
      // incremented to 1 and its value is returned to the calling code. 
      // So the function always returns 1, no matter how many times it’s 
      // called.

//////// You probably won’t use static variables that often, and you can 
      // often achieve the same effect (albeit with greater risk) using 
      // global variables. However, when you do really need to create a 
      // static variable you’ll probably be thankful that they exist. 
      // They’re often used with recursive functions (which you learn about 
      // later in this chapter) to remember values throughout the recursion.
        function nextNumber1() {
          /// $counter value latches the new value in memory every time it
          // is called.
            static $counter = 0;
            return ++$counter;
        }
        echo "I’ve counted to: " . nextNumber1() . "<br/>";
        echo "I’ve counted to: " . nextNumber1() . "<br/>";
        echo "I’ve counted to: " . nextNumber1() . "<br/>";
			     
           ?>
        
        </body>
	</html>

