<!--

One very popular use for Web scripts is a hit counter, which is used to show how many times a Web page has been visited and therefore how popular the Web site is. Hit counters come in different forms, the simplest of which is a text counter.

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>A simple hit counter</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	 <h1>A simple hit counter</h1>

			     <?php
	
  // After displaying a page header, the script stores the filename of the file that will hold the hit count.		     		
              $counterFile = "./count.dat";
  
  // Next, the script checks to see if the counter file exists. If it doesn’t, it is created by opening the file for writing, writing a zero to it (thereby initializing the hit count to zero), then closing it.
              if (!file_exists($counterFile)) {
                
                if (!( $handle = fopen($counterFile, "w"))) {
                  
                  die("Cannot create the counter file.");
                }
                else {

                  fwrite($handle, 0);
                  fclose($handle);
                }
              }

// Next, the script checks to see if the counter file exists. If it doesn’t, it is created by opening the file for writing, writing a zero to it (thereby initializing the hit count to zero), then closing it.
              if (!( $handle = fopen($counterFile, "r"))) {
                  
                  die("Cannot read the counter file.");
                }

// The script now uses the file handle to read the hit counter value from the open file. As you can see, the script calls fread() to read up to 20 bytes from the data file (enough to store a very large integer). Because fread() returns a string value, and the counter needs to be an integer value, the return value is cast into an integer using (int).
              $counter = (int) fread($handle, 20);
// The call to fclose() closes the file referenced by the file handle $handle, freeing up the file for reading or writing by other processes.
              fclose($handle);

 // After closing the data file, the script increments the counter and tells the visitor how many times the page has been accessed.
              $counter++; 

               echo "<p>You're visitor No. $counter.</p>";

// Next the script writes the new counter value back to the data file. To do this it opens the file in write mode (w), then calls fwrite() to write the $counter variable’s value to the file, followed by fclose() to close the open file again.
               if (!( $handle = fopen($counterFile, "w"))) {
                  
                  die("Cannot open the counter file for writing.");
                }

                  fwrite($handle, $counter);
                  fclose($handle);

        	 ?>
         
        </body>
	</html>







