<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Number squaring</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />

<!--The script starts with the regular XHTML page header, adding some CSS styles for the table in the page.-->
            <style type="text/css">

              th { text-align: left; background-color: #999; }
              th, td { padding: 0.4em; }
              tr.alt td { background: #ddd; }
            </style>
        </head>

        <body>         	 

			     <?php

//Next the script defines a constant, PAGE_SIZE, that holds the number of squares to display on each page (ten in this case).
              define("PAGE_SIZE", 10);
/*
The script then creates a variable, $start, to hold the first integer to display within the page. This defaults to zero. However, if the field start has been passed to the script in a query string — and the field’s value is within an acceptable range — this value is used instead. Note that the script casts
the value of $_GET[“start“] to an integer as a security measure; it’s always good to filter and/or validate any user input to make sure it is of the correct format.
*/
              $start = 0;

              if (isset($_GET["start"]) and $_GET["start"] >= 0 and $_GET["start"] <= 100000) {
                
                $start = (int) $_GET["start"];
              }
//Next, the script works out the last integer to display on the current page, and stores it in another variable, $end.            
              $end = $start + PAGE_SIZE - 1;
        	 ?>
<!--Now it’s simply a case of displaying the table of ten integers, along with their squares. PHP’s pow()
function is used to calculate the square of each integer-->         
            <h1>Number squaring</h1>
            <p>Displaying the squares of the numbers <?php echo $start ?> to <?php echo $end ?>:</p>

             <table cellspacing="0" border="0" style="width: 20em; border: 1px solid #666;">
                <tr>
                  <th>n</th>
                  <th>n<sup>2</sup></th>
                </tr> 

          <?php  

                  for ($i=$start; $i <= $end ; $i++) {                 
                  ?>

                  <tr <?php if ($i % 2 != 0) echo ' class="alt"' ?>>
                    
                    <td><?php echo $i ?></td>
                    <td><?php echo pow($i, 2) ?></td>
                  </tr>

                <?php
                  }
                ?>
              </table>

              <p>
                <?php  
//Finally, the Next Page and (if appropriate) Previous Page links are displayed. Notice how the script builds the query string within each link.
/*
Because you know that the start field will only ever contain digits, there’s no need to URL-encode the values in this situation. However, if there’s any chance that your field values might contain reserved char- acters, you should use urlencode() or http_build_query().
*/
                  if ($start > 0) {
                ?>
                    <a href="number_squaring.php?start=<?php echo $start - PAGE_SIZE ?>">&lt; Previous Page</a> |

                <?php  
                  }
                ?>
                     <a href="number_squaring.php?start=<?php echo $start + PAGE_SIZE ?>">Next Page &gt;</a>
            ?>
                               
              </p>
        </body>
	</html>















