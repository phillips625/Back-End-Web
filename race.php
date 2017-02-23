<?php
$startTime = microtime(true);

///////// PHP’s microtime() function with an argument of true, which returns the current timestamp as a floating-point number (with the number of seconds before the decimal point and the fraction of a second after the decimal point).
////////Next, the for loop goes into action. The initializer sets up a variable, $num, with a value of 1. The loop test expression checks to see if the current time — again retrieved using microtime() — is still earlier than 1/10000th 
////////of a second (100 microseconds) after the start time; if it is the loop continues. Then the counting expression, rather than simply incrementing a counter, multiplies the $num variable by 2. Finally, the body of the loop simply displays the current value of $num.
      for ( $num = 1; microtime( true ) < $startTime + 0.0001; $num = $num * 2 ) 
      {
        echo "Current number: $num<br />";
}
      echo "Out of time!";
?>