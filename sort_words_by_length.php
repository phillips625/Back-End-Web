<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
       	<head>
         	<title>Sorting words in a block of text by length</title>
         	<link rel="stylesheet" type="text/css" href="common.css" />
	   	</head>

	   	<body>

	   		 <h1>Sorting words in a block of text by length</h1>

	   		<?php
	   			
	   			$myText = <<<END_TEXT
	   			 	But think not that this famous town has
					only harpooneers, cannibals, and
					bumpkins to show her visitors. Not at
					all. Still New Bedford is a queer place.
					Had it not been for us whalemen, that
					tract of land would this day perhaps
					have been in as howling condition as the
					coast of Labrador.
END_TEXT;

				echo "<h2>The text:</h2>";
				echo "<div style = \"width: 30em;\">$myText</div>";

//////  Next, the script gets to work on processing the text. First it 
	// uses PHP’s preg_replace() function to strip out all commas and 
	// periods from the text
				$myText = preg_replace( "/[\,\.]/", "", $myText );
///// The next line of code calls the PHP function preg_split() to split 
	// the string into an array of words, using any of the whitespace 
	// characters \n, \r, \t and space to determine the word boundaries. 
	// It then processes the array through PHP’s handy array_unique() 
	// function, which removes any duplicate words from the array
				$words = array_unique( preg_split ( "/[ \n\r\t]+/", $myText ) );

	/*
Next comes the sorting logic, and this is where anonymous functions come into play. 
The script uses PHP’s usort() function to sort the array of words. usort() 
expects an array to sort, followed by a callback comparison function. 
All comparison functions need to accept two values — $a and $b — and 
return one of three values:

❑ A negative number if $a is considered to be “less than” $b
❑ Zero if $a is considered to be “equal to” $b
❑ A positive number if $a is considered to be “greater than” $b
In this case, the comparison function needs to determine if the length of 
the string $a is less than, equal to, or greater than the length of the 
string $b. It can do this simply by subtracting the length of $a from the 
length of $b and returning the result. (Remember from Chapter 5 that PHP’s 
strlen() function returns the length of a string.) Notice that this line of 
code uses the create_function() function to create an anonymous compariso 
function, which is in turn used by usort() to sort the array.
Finally, the script displays the sorted list of words in another fixed-width div 
element.
By the way, you don’t have to use an anonymous function in this situation. 
The preceding line of code
could be written as:

      function sortByLength( $a, $b ) {
        	return strlen( $a ) - strlen( $b );
	  }
      usort( $words, “sortByLength” );

As you can see, though, the anonymous function version is much 
more compact.

	*/
				usort($words, create_function( '$a, $b', 
											'return strlen($a) - strlen($b);' ) );

				echo "<h2>The sorted words:</h2>";
				echo "<div style = \"width: 30em;\">";

					foreach ($words as $word ) {
						echo "$word ";
					}

				echo "</div>";
	   		?>
	   	</body>

	  </html>