<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

     <head>
       <title>Justifying Lines of Text</title>
       <link rel="stylesheet" type="text/css" href="common.css" />
     </head>

	 <body>

	 	<h1>Justifying Lines of text</h1>
	 	<?php 

	 		//The text to justify
	 		  $myText = <<<EOT
              But think not that this famous town has
   		only harpooneers, cannibals, and
   		bumpkins to show her visitors. Not at
   		all. Still New Bedford is a queer place.
  		Had it not been for us whalemen, that
 	        tract of land would this day perhaps   			
                have been in as howling condition as the
   		coast of Labrador. 

EOT;

/////////After defining $myText, the script uses str_replace() to convert any Windows line endings
//(a carriage return followed by a line feed) into UNIX line endings (a line feed 
//on its own). Windows line endings can occur if the script file was saved on a 
//Windows machine, and they can confuse the justification algorithm (which 
//expects each line to end with just a line feed):
      $myText = str_replace( "\r\n", "\n", $myText );

   		// The desired length that you’d like each line of text to be. Try 
      //changing this to different values to see what happens
   			$lineLength = 40;
      //This will contain the final, justified text
   			$myTextJustified = "";
      //Contains the number of lines of text, computed by counting the number 
      //of newline characters in the text with the substr_count() function
   			$numLines = substr_count($myText, "\n");

      //Points to the index position within $myText of the start of the current 
      //line being processed
   			$startOfLine = 0;
   			//Now that the script has initialized these variables, the text can be processed. 
        //To do this, the script sets up a for loop that moves through each line of the text
   			for ($i=0; $i < $numLines; $i++) { 
   			
        //Within the loop, the script first computes the length of the original, unjustified
        // line. It does this by using strpos() to find the index position of the next 
        //newline character after the start of the current line, then subtracting this
        // index position from that of the start of the line:
   				$originalLineLength = strpos($myText, "\n", $startOfLine) - $startOfLine;
        //Now that the script knows the length of the line, it’s easy to copy the entire line 
        //to a new variable, $justifiedLine, that will hold the justified version 
        //of the line. Another variable, $justifiedLineLength, is set up to track the 
        //length of the justified line:
   				$justifiedLine = substr($myText, $startOfLine, $originalLineLength);
   				$justifiedLineLength = $originalLineLength;

   				//The next block of code makes up the meat of the justification algorithm. The script
          // uses a while loop to run the algorithm repeatedly until the line has been padded 
          //out to match the desired line length. Note that the while loop condition also 
          //skips the last line of text, because you don’t want this to be justified
   				while ( $i < $numLines - 1 && $justifiedLineLength < $lineLength ) {

          //Within the while loop, a for loop works its way through $justifiedLine, 
          //character by character. If the current character is a space, and the line 
          //length is still less than the desired length, the script uses 
          //substr_replace() to insert an extra space character at that point. It then 
          //increments $justifiedLineLength to keep track of the current length, and 
          //also increments the loop counter, $j, to skip over the extra space that’s 
          //just been created
   					for ($j=0; $j < $justifiedLineLength; $j++) { 
   						if ($justifiedLineLength < $lineLength && $justifiedLine[$j] == " ") {
   							$justifiedLine = substr_replace($justifiedLine, " ", $j, 0);
   							$justifiedLineLength++;
   							$j++;
   						}
   					}
   				}
   				//Add justified line to the string and move to the start of a new line
          //Once the desired line length has been reached, the justified line is 
          //appended to $myTextJustified (adding a newline character at the end 
          //of the line), and the $startOfLine pointer is moved to the start of 
          //the next line (adding 1 to the index to skip over the newline character):
   				$myTextJustified .= "$justifiedLine\n";
   				$startOfLine += $originalLineLength + 1;
   			}
	 	?>
        <!--Finally, the original and justified blocks of text are displayed in 
        the page -->
	 			<h2> Original Text: </h2>
   				<pre> <?php echo $myText ?></pre>

   				<h2> Justified Text: </h2>
   				<pre> <?php echo $myTextJustified ?></pre>

	</body>

</html>