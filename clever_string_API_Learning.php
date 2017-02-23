<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Creating a Wrapper Class with __call()</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Creating a Wrapper Class with __call()</h1>
 
 <!--
This example shows how easy it is to wrap a set of existing functions, methods, or API calls in a class using a single __call() method. You could easily extend this example to allow practically all of PHP’s tens of string functions to be called, without having to write much extra code.
 -->
          		 <?php
  				
  					     class CleverString {

                  /*
                    The CleverString class serves two purposes: it stores a string to be operated on, and it provides method-based access to three built-in string functions that operate on the stored string:

                      ❑ strlen() for calculating the length of the string
                      ❑ strtoupper() for converting the string to uppercase letters
                      ❑ strpos() for finding the position of the first occurrence of a character in the string

                    As mentioned earlier, it’s good practice to encapsulate the members of a class as much as possible in order to make the class robust and maintainable. To this end, the stored string is encapsulated in a private property, $_theString; calling code can use the public methods setString() and getString() to set and read the string value.
                  */
                    private $_theString = "";
                    private static $_allowedFunctions = array("strlen", "strtoupper", "strpos" );

                    public function setString ($stringVal) {
                      $this->_theString = $stringVal;
                    }

                    public function getString () {
                      return $this->_theString;
                    }
                    /*
                      First, the method stores the name of the method that was called in a $methodName parameter, and the array containing any passed arguments is stored in the $arguments parameter.
                    */
                    public function __call($methodName, $arguments) {
                      /*
                        Next the method checks that $methodName is contained in the CleverString::$_allowedFunctions array.
                      */
                      if (in_array($methodName, CleverString::$_allowedFunctions)) {
                      /*
                        The method adds the object’s stored string value, $this->_theString, to the start of the $arguments array.
                        This is because most built-in string functions — including the three that this class is capable of calling — expect the string to operate on to be the first argument that is passed to them.
                      */ 
                        array_unshift($arguments, $this->_theString);
                        /*
                          Finally, the __call() method is ready to call the appropriate string function. It does this using the PHP function call_user_func_array(), which expects the function name as the first argument, and the argument list — as an array — as the second argument. The __call() method then returns the return value from the string function back to the method’s calling code:
                        */
                        return call_user_func_array($methodName, $arguments);
                      }
                      /*
                        If $methodName is not one of these three values, the function terminates the script with an error
                        message
                      */
                      else {
                        die("<p>Method 'CleverString::$methodName' doesn't exist</p>");
                      }
                    }
                 }
  					           
  				         $myString = new CleverString;
                   $myString->setString( "Hello!" );

                   echo "<p>The string is: " . $myString->getString() . "</p>";
                   echo "<p>The length of the string is: " . $myString->strlen() . "</p>";
                   echo "<p>The string in uppercase letters is: " . $myString->strtoupper() . "</p>";
                   echo "<p>The letter 'e' occurs at position: " . $myString->strpos( "e" ) . "</p>";
    
                   $myString->madeUpMethod();
           		?>
        
        </body>
	</html>