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

As you learned in Chapter 7, recursion is particularly useful when a script has to perform repetitive operations over a set of data of unknown size, and traversing a directory hierarchy is a very good example.
A directory may hold subdirectories as well as files. If you want to create a script that lists all the files and subdirectories under a given directory — including subdirectories of subdirectories, and so on — you need to write a recursive function, as follows:

1. Read the entries in the current directory.
2. If the next entry is a file, display its name.
3. If the next entry is a subdirectory, display its name, then call the function recursively to read the entries inside it.

As you can see, the third step repeats the whole process by itself, when necessary. The recursion continues until there are no more subdirectories left to traverse.
To try out this technique, first save the following script as directory_tree.php. Now change the $dirPath variable at the top of the script to point to a folder on your Web server’s hard drive, and open the script’s URL in your Web browser. 

-->

			     <?php

			     	   $dirpath = "../htdocs/photos";

               function traverseDir($dir)
               {
                 
                 echo "<h2>Listing $dir ...</h2>";

/*
The traverseDir() recursive function traverses the whole directory hierarchy under a specified directory. First, the function displays the path of the directory it is currently exploring. Then, it opens the directory with opendir().
*/
                 if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );
 
 /*
Next the function sets up a $files array to hold the list of filenames within the directory, then uses readdir() with a while loop to move through each entry in the directory, adding each filename to the array as it goes (”.” and “..” are skipped). If a particular filename is a directory, a slash (/) is added to the end of the filename to indicate to the user (and the rest of the function) that the file is in fact a directory.
 */       
                 $files = array();

                 while ( $file = readdir( $handle ) ) {
                  if ( $file != "." && $file != ".." ) {
                    if ( is_dir( $dir . "/" . $file ) ) $file .= "/";
                      
                      $files[] = $file;
                  }
                }

/*
Now the array of filenames is sorted alphabetically to aid readability, and the filenames are displayed in an unordered list.
*/
                sort($files);

                echo "<ul>";
                  foreach ( $files as $file ) echo "<li>$file</li>";
                echo "</ul>";

/*
The last part of the function loops through the array again, looking for any directories (where the filename ends in a slash). If it finds a directory, the function calls itself with the directory path (minus the trailing slash) to explore the contents of the directory.
*/
                 foreach ( $files as $file ) {

                  if (substr($file, -1) == "/") traverseDir("$dir/", substr($file, 0, -1));
                 }

// Finally, the directory handle is closed.
                 closedir( $handle );
               }

// The last line of code in the script kicks off the directory traversal, starting with the path to the initial, topmost directory.
               traverseDir($dirpath);
        	 	?>

        </body>
	</html>
