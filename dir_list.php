<!--
Here’s how to set up a loop to get all the files and folders inside a specified directory. 
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Listing the contents of a directory</title>
          	<link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	 <h1>Listing the contents of a directory</h1>

<!--

You can see that the returned filenames are not sorted in any way. To sort them, first read the entries into an array:
      $filenames = array();
      while ( $file = readdir( $handle ) ) $filenames[] = $file;
      closedir( $handle );
      
The $filenames array now contains every entry in the directory. Now you can call sort() to arrange the array elements in ascending order, then loop through the array displaying all except the “.” and “..” entries:
      sort( $filenames );
      foreach ( $filenames as $file ) {
        if ( $file != “.” && $file != “..” ) {
          echo “<li>$file</li>“;
        }
}

-->

			     <?php

			     	   $dirpath = "../htdocs/photos";
   
   /*
      After displaying the page header and storing the path to the directory to scan in the $dirPath variable, the script gets a handle on the directory.
   */                  
               if(!($handle = opendir($dirpath))) {
                         
                  die("Cannot open the directory.");
                }
        	 	?>

            <p><?php echo $dirpath ?>contains the following files and folders:</p>
            
            <ul>
              
              <?php

/*
  If the directory was successfully opened, its name is displayed in the page and an unordered list (ul) HTML element is started. Next the script uses readdir() to loop through each entry in the directory and, as long as the entry isn’t “.” or “..”, display it. The loop exits when readdir() returns false, which occurs when the list of entries is exhausted.
*/
                while ($file = readdir($handle)) {
                  
                  if ($file != "." && $file != "..") {
                    
                    echo "<li>$file</li>";
                  }
                }

// Finally, the script calls closedir() to close the directory, then finishes off the markup for the list and the page.
                closedir($handle);
              ?>              

            </ul>

        </body>
	</html>
