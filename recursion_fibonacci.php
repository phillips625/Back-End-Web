 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  	<head>
  		  <title>Fibonacci sequence using recursion</title>
        <link rel="stylesheet" type="text/css" href="common.css" />

        <style type="text/css">
            th { 
                  text-align: left; 
                  background-color: #999; 
                }
            th, td { 
                  padding: 0.4em; 
                }
            tr.alt td { 
                  background: #ddd; 
                }
        </style>
  </head>

  <body>
    	<h1>Fibonacci sequence using recursion</h1>

      <table cellspacing="0" border="0" style="width: 20em; border: 1px solid #666; ">
          <tr>
              <th>Sequence #</th>
              <th>Value</th>
          </tr>
	       <?php 

    	       $iterations = 10;

////// This code checks if the sequence number is 0 or 1; if it is then it immediately exits the function and returns the sequence number (because F0 is 0 and F1 is 1). So once this condition is met, the function finishes and control is passed back to the calling code. If the base case hasn’t yet been reached, the second line of code is run:
             function fibonacci($n) {

              ///// Termination point 
                if (($n == 0)||($n == 1))
                  return $n;

////// This code calls the fibonacci() function twice recursively — once to compute the Fibonacci number two positions lower in the sequence, and once to compute the Fibonacci number that’s one position lower in the sequence. It then adds these two Fibonacci numbers together to produce the Fibonacci number for the current sequence number, which it then returns to the calling code (which will either be the code within the for loop, or another instance of the fibonacci() function).
////// So when this function is run with a sequence number of, say, 10, it calls itself to obtain the numbers at positions 8 and 9. In turn, when called with the sequence number 8, the function computes the Fibonacci number at this position by calling itself to obtain the numbers at positions 6 and 7, and so on. This process continues until the function is called with a sequence number of 0 or 1; at this point, it no longer calls itself but merely returns the value 0 or 1.
                return fibonacci($n - 2) +  fibonacci($n - 1);
             }

             for ( $i=0; $i <= $iterations; $i++ )
             {
                ?>
                <!--Table presentation for each row-->
                <tr<?php 
                      if ( $i % 2 != 0 ) 
                        echo ' class="alt"' 
                      ?>
                >
                      <td>F<sub><?php echo $i?></sub></td>
                      <td><?php echo fibonacci( $i )?></td>
                </tr>

                <?php 
                    }
                ?>
             }
      </table>
    </body>
</html>


























