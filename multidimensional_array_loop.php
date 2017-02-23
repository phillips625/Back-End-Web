 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  	<head>
    	<title>Looping Through a Two-Dimensional Array</title>
    	<link rel="stylesheet" type="text/css" href="common.css" />
  	</head>

  	<body>
    	<h1>Looping Through a Two-Dimensional Array</h1>

    	<?php 

    		$myBooks = array (
    						 array(
    						 	"title" => "The Grapes of Wrath", 
    						 	"author" => "John Steinbeck",
    						 	"pubYear" => 1939 ),

    						 array(
   								 "title" => "The Trial",
    							 "author" => "Franz Kafka",
    							 "pubYear" => 1925
								), 
    						 array(
    							 "title" => "The Hobbit",
    							 "author" => "J. R. R. Tolkien",
    							 "pubYear" => 1937
								), 
    						 array(
    							 "title" => "A Tale of Two Cities",
    							 "author" => "Charles Dickens",
         						 "pubYear" => 1859
  								)
    						 );

/*

Next, the script sets a counter variable, $bookNum, to zero and sets up the outer foreach loop. This loop moves through each of the elements of the top-level $myBooks array. For each element, it increments $bookNum and displays the current book number, then starts a new definition list (dl) XHTML element.
The inner foreach loop works through the elements of the associative array stored in the current element. For each element of the associative array, it displays the element’s key (“title”, “author”, or “pubYear”) within an XHTML dt element, and the element’s value within a dd element. After the inner foreach loop has run, the dl element is closed.

*/
    		$bookNum = 0;

    		foreach ($myBooks as $book) {
    			
    			$bookNum++;
    			echo "<h2> Book #$bookNum: </h2>";

    			echo "<dl>";

    			foreach ($book as $key => $value) {
    				echo "<dt> $key </dt> <dd> $value </dd>";
    			}

    			echo "</dl>";
    		}
    	?>
    </body>
</html>










