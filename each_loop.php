<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Using each() with a while loop</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Using each() with a while loop</h1>
			<dl> <?php
      		$myBook = array( "title" => "The Grapes of Wrath",
                       		"author" => "John Steinbeck",
                       		"pubYear" => 1939 );

      		
///The while loop continues as long as each() keeps returning a four-element 
//array (which evaluates to true). When the end of the array is reached, each() 
//returns false and the loop finishes.
      		while ( $element = each( $myBook ) ) {
      			// Column 1
        		echo "<dt>$element[0]</dt>";
        		// Column 2
        		echo "<dd>$element[1]</dd>";
			} ?>
          </dl>
        </body>
	</html>

