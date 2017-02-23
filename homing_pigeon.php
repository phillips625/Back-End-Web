<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <title>Homing Pigeon Simulator</title>
            <link rel="stylesheet" type="text/css" href="common.css" />
            <style type="text/css">
              div.map { 
                float: left; 
                text-align: center; 
                border: 1px solid #666;
                background-color: #fcfcfc; 
                margin: 5px; 
                padding: 1em; 
              }
              span.home, span.pigeon { 
                font-weight: bold; 
              }
              span.empty { 
                color: #666; 
              }
            </style>
        </head>
        <body>
          <?php
          /*Position the pigeon and the home*/
          ///////Each map represents the progress of the pigeon (represented by the % 
          //////symbol) toward its home (the + symbol). Reload the page to run a new simulation, 
          //////with the home and the pigeon in different positions.

          ////$mapSize, representing the width and height of the map square
            $mapSize = 10;
            //////Position the home and the pigeon
            do {
              //This code uses PHP’s rand() function to randomly position 
              //the home point and the pigeon within the boundaries of the map.
              //X = x coordinate
              //Y = y coordinate
               $homeX = rand ( 0, $mapSize-1 );
               $homeY = rand ( 0, $mapSize-1 );
               $pigeonX = rand ( 0, $mapSize-1 );
               $pigeonY = rand ( 0, $mapSize-1 );
            }
            ///// checks to ensure that the home and the pigeon are at least half the width (or height) of 
            ///the map apart from each other; if they’re not, the loop repeats itself with new random positions. 
            //This ensures that the pigeon always has a reasonable distance to travel:
            // The built-in abs() function determines the absolute value of a number. For example, 
            //abs(3) is 3, and abs(-3) is also 3.
            while ( ( abs( $homeX - $pigeonX ) < $mapSize/2 ) && ( abs( $homeY - $pigeonY ) < $mapSize/2 ) );

            /*Move the pigeon to home*/
            do {
              // Move the pigeon closer to home
              /////  It simply checks to see if the x coordinate of the pigeon is greater or less than the x 
              ///coordinate of the home square, and adjusts the pigeon’s x coordinate appropriately. The y coordinate 
              ///is adjusted in the same way. Note that if the x or y coordinate of the pigeon matches the corresponding 
              ///home coordinate, there’s no need to adjust the pigeon’s coordinate.
              if ( $pigeonX < $homeX )
                $pigeonX++;
              else if ( $pigeonX > $homeX )
                $pigeonX--;
              if ( $pigeonY < $homeY )
                $pigeonY++;
              elseif ( $pigeonY > $homeY )
                $pigeonY--;

              // Display the current map
              /////The last section of code within the loop is concerned with displaying the current map. 
              //This code itself comprises two nested for loops that move through all the x and y coordinates 
              //of the map. For each square within the map, the code displays a + symbol if the square matches 
              //the coordinates of the home position, and a % symbol if the square matches the pigeon coordinates. 
              //Otherwise, it displays a dot (.). After each square, it adds a space character (unless it’s the last 
              //square on the row)
              echo '<div class="map" style=”width: ' . $mapSize . 'em;”><pre>';
              for ( $y = 0; $y < $mapSize; $y++ ) {
                for ( $x = 0; $x < $mapSize; $x++ ) {
                  if ( $x == $homeX && $y == $homeY ) {
                      echo '<span class="home">+</span>'; // Home
                    } 
                  else if ( $x == $pigeonX && $y == $pigeonY ) {
                      echo '<span class="pigeon">%</span>'; // Pigeon
                    } 
                  else {
                      echo '<span class="empty">.</span>'; // Empty square
                    }
                    //// Creates space btw '.' 
                    echo ( $x != $mapSize - 1 ) ? " " : "";
                  }
                  /////// Moves the '.' print to the next line after each row.
                  echo "\n"; 
                }
                echo "</pre></div>\n";
              } 
              while ( $pigeonX != $homeX || $pigeonY != $homeY );
          ?>
        </body>
      </html>