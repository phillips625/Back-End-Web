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

The Directory object supports three methods — read(), rewind(), and close()— which are functionally equivalent to readdir(), rewinddir(), and closedir(), respectively. For example, you can rewrite the dir_list.php script from earlier in the chapter using a Directory object.

-->

			     <?php

			     	   $dirpath = "../htdocs/photos";
               $dir = dir($dirpath);
                
               if(!($handle = opendir($dirpath))) {
                         
                  die("Cannot open the directory.");
                }
        	 	?>

            <p><?php echo $dirpath ?> contains the following files and folders:</p>
            
            <ul>
              
              <?php

                while ( $file = $dir->read() ) {
                  if ( $file != "." && $file != ".." ) echo "<li>$file</li>";
                }

                $dir->close();

              ?>              

            </ul>

        </body>
	</html>
