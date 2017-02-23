<!--

With the basics of PHP’s file and directory handling capabilities under your belt, it’s time to create a simple Web-based text file editor application. The editor will display a list of text files in a designated folder, inviting the user to edit a file by clicking its name. The edit page will simply display the file’s contents in an HTML text area field, with buttons for saving changes or canceling edits.
The user will also be able to create new text files to work with. For the sake of simplicity the editor will only handle text files with the .txt filename extension.

-->

<?php

/*

text files. Give the Web server user permission to create files in this folder. To do this on Linux and Mac OS X, open a terminal window, then change to the parent folder and use the chmod command on the text file folder. For example, if your text file folder was /home/matt/sandbox, you could type:
      $ cd /home/matt
      $ chmod 777 sandbox
If you’re running a Windows Web server, see the “Changing Permissions” section earlier in the chapter for details on how to change permissions. However, it’s quite likely that you won’t need to change permissions for the script to work on Windows.
Once you’ve created your text files folder and given it appropriate permissions, you need to tell the script about the new folder. To do this, set the PATH_TO_FILES constant at the top of the script.
*/

/*
The script kicks off by defining the path to the folder that will hold the text files. It does this using a constant called PATH_TO_FILES.
The user will create and edit all his text files in this folder. For security reasons it’s important to make sure that the user isn’t allowed to create or modify files outside this folder, and you see how this is don in a moment.
*/
      define( "PATH_TO_FILES", "../htdocs/photos" );

//The Main Logic
/*

Next comes the main decision logic of the script. This code examines the $_POST and $_GET superglobal arrays and, depending on what field it finds, it calls an appropriate function to handle the request.
If the saveFile form field was submitted, the user wants to save his edits, so the saveFile() function is called. If the filename field was found in the query string, the user has clicked a file to edit in the list; displayEditForm() is called to let the user edit the file. If the createFile form field was found, the user has clicked the Create File button to make a new file, so createFile() is called to create the new file. Finally, if none of these fields exist, the file list is displayed by calling displayFileList().
*/

      if ( isset( $_POST["saveFile"] ) ) {
        saveFile();
      } 
      elseif ( isset( $_GET["filename"] ) ) {
        displayEditForm();
      } 
      elseif ( isset( $_POST["createFile"] ) ) {
        createFile();
      } 
      else {
        displayFileList();
	  }

      function displayFileList( $message="" ) {

/*
First the function calls the displayPageHeader() helper function (described in a moment) to generate a standard page header. Next it checks that the text files directory exists (if not, the script exits with an error message) and attempts to open the directory and retrieve a Directory object by calling the dir() function (again, if there’s a problem the script exits).
*/
        displayPageHeader();
        if ( !file_exists( PATH_TO_FILES ) ) die( "Directory not found" );
        if ( !( $dir = dir( PATH_TO_FILES ) ) ) die( "Can't open directory" );
      ?>
          <?php 

          if ( $message ) echo '<p class="error">' . $message . '</p>' ?>
          <h2>Choose a file to edit:</h2>
          <table cellspacing="0" border="0" style="width: 40em; border: 1px solid #666;"> 

           <tr>
              <th>Filename</th>
              <th>Size (bytes)</th>
              <th>Last Modified</th>
		   </tr> 

		   <?php
    
    /*
		After displaying any error message passed to the function, and kicking off an HTML table to display the file list, the function uses a while construct along with calls to the $dir->read() method to loop through the entries in the text files directory. For each entry, the script checks that the entry’s filename is not “.” or “..”, and that the file isn’t a directory and its filename extension is “.txt”. If the entry matches all these criteria, it is displayed as a row in the table. Notice that the loop stores the complete path to each file in a temporary $filepath variable for convenience.
    
		
To display each file in the table, the script wraps a link around the filename to allow the user to edit the file. The link’s URL includes the query string ”?filename=” followed by the name of the file to edit. Notice that the filename is encoded in the query string by passing it through the urlencode() function. The script also displays the file’s size by calling the filesize() function. Finally, the file’s “last modified” time is displayed by calling the filemtime() function and passing the resulting timestamp to the date() function to format it.
Once the loop’s finished, the function closes the directory and displays the form for creating a new file.
The form includes a filename text field and a createFile submit button.
    */    
        	while ( $filename = $dir->read() ) {
          	
          		$filepath = PATH_TO_FILES . "/$filename";
          		if ( $filename != "." && $filename != ".." && !is_dir( $filepath ) && strrchr( $filename, "." ) == ".txt" ) {

					echo '<tr><td><a href="text_editor.php?filename=' . urlencode($filename ) . '">' . $filename . '</a></td>';
					echo '<td>' . filesize( $filepath ) . '</td>';

					date_default_timezone_set( 'Europe/London' ); 
              		echo '<td>' . date( "M j, Y H:i:s", filemtime( $filepath ) ) . '</td></tr>';
				} 
			}

        		$dir->close();
      		?>
          </table>

          <h2>...or create a new file:</h2>
          <form action="text_editor.php" method="post">
            <div style="width: 20em;">
              <label for="filename">Filename</label>
              <div style="float: right; width: 7%; margin-top: 0.7em;"> .txt</div>
              <input type="text" name="filename" id="filename" style="width: 50%;" value="" />
              <div style="clear: both;">
                <input type="submit" name="createFile" value="Create File" />
              </div>
            </div>
          </form>
        </body>
      </html>
<?php 

}

// The displayEditForm() Function
      function displayEditForm( $filename="" ) {

/*
When the user clicks a file to edit, the displayEditForm() function is called to display the file conten for editing. This function can take an optional $filename argument containing the filename of the file to edit; if this isn’t passed, it looks up the filename in the query string, passing it through basename() ensure that no additional path information is in the filename; this is a good security measure, because i thwarts any attempt to edit files outside the designated folder. Furthermore, if the filename is empty fo some reason, the script exits with an error.
*/
        if ( !$filename ) $filename = basename( $_GET["filename"] );
        if ( !$filename ) die( "Invalid filename" );

/*
Next the function stores the full path to the file in a $filepath variable (because this path is needed many times in the function), and checks to make sure the file to edit actually exists — if it doesn’t, it exi with a “File not found” message.
*/
        $filepath = PATH_TO_FILES . "/$filename";
        if ( !file_exists( $filepath ) ) die( "File not found" );

 /*

The rest of the function calls displayPageHeader() to output the standard page header markup, the displays the name of the file being edited, as well as the HTML form for editing the file. The form consists of a hidden field storing the filename of the file being edited; a text area for the file contents; a Save File and Cancel buttons. The file’s contents are displayed in the text area simply by calling file_ get_contents() and outputting the result.
 */
        displayPageHeader();
      ?>
          <h2>Editing <?php echo $filename ?></h2>
          <form action="text_editor.php" method="post">
			<div style="width: 40em;">
			<input type="hidden" name="filename" value="<?php echo $filename ?>" /> 

<!--
Notice that the filename and fileContents field values are passed through PHP’s htmlspecialchars() function to encode characters such as &, <, and > in the markup. This is a good security measure to take.
-->
			<textarea name="fileContents" id="fileContents" rows="20" cols="80" style="width: 100%;">
				<?php echo htmlspecialchars( file_get_contents( $filepath ) ) ?>
			</textarea>
              <div style="clear: both;">
                <input type="submit" name="saveFile" value="Save File" />
                <input type="submit" name="cancel" value="Cancel" style="margin-right: 20px;" />
              </div>
            </div>
          </form>
        </body>
      </html>
      <?php
      }

// The saveFile() Function
 /*
saveFile() is called when the user sends back the edit form containing the file contents. It reads the filename from the form data — passing the filename through basename() to sanitize it — then stores the full path to the file in $filepath.
 */
      function saveFile() {
        $filename = basename( $_POST["filename"] );
        $filepath = PATH_TO_FILES . "/$filename";
 
 /*
Next the function checks that the file exists; if so, it writes the file contents to the file by calling file_ put_contents(), then redisplays the file list page by calling displayFileList(). If there was a problem, an appropriate error message is displayed and the script exits. Notice that the function uses the === operator to test if the return value of file_put_contents() exactly equals false. Merely using the == or ! operator wouldn’t do the job. Why? Because file_put_contents() returns the number of characters written if successful. Because this value will be zero if the file contents happen to be empty, and 0 == false, using == or ! would incorrectly exit the script with an error in this situation.
 */ 
  		if ( file_exists( $filepath ) ) {
    		if ( file_put_contents( $filepath, $_POST["fileContents"] ) === false ) die( "Couldn't save file" );
    			displayFileList();
  		} 
  		else {
    		die( "File not found" );
  		}

  	  }

// The createFile() Function
function createFile() {

/*
If the user clicks the Create File button in the file list page, createFile() is called to attempt to create the new file. The function reads and sanitizes the filename field sent from the form. If the filename is empty, the file list page is redisplayed with an error message.
*/
  $filename = basename( $_POST["filename"] );
  $filename = preg_replace( "/[^A-Za-z0-9_\- ]/", "", $filename );

  if ( !$filename ) {
    displayFileList( "Invalid filename - please try again" );
    return;
  }

// Next the function appends a .txt extension to the end of the filename and sets the $filepath variabl to store the full path to the file.
  $filename .= ".txt";
  $filepath = PATH_TO_FILES . "/$filename";

// The file path is then checked to make sure the file doesn’t already exist; if it does, the user is warned and the file isn’t created
  if ( file_exists( $filepath ) ) {
    displayFileList( "The file $filename already exists!" );
  }

/*
If the file doesn’t exist, it is created by calling file_put_contents() with an empty string for the file contents. (file_put_contents() automatically creates a file if it doesn’t already exist.) If file_put_ contents() returns exactly false (tested with the === operator), the file can’t be created and the scri exits with an error.
*/ 
  else {

    if ( file_put_contents( $filepath, "" ) === false ) die( "Couldn't create file" );

 /*
Once the file has been created its permissions are set so that anyone can read and write to the file. Final displayEditForm() is called, passing in the name of the newly created file so the user can begin editing it.
 */
    	chmod( $filepath, 0666 );
    	displayEditForm( "$filename" );
  	}
  }

// The displayPageHeader () Function
/*
The displayPageHeader() utility function simply outputs the XHTML page header common to all pages in the application. This saves having to include the markup more than once in the script. As well as including the standard common.css style sheet from Chapter 2, the header defines some extra CSS rules to style any error messages and the file list table.

*/
function displayPageHeader() {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>A simple text editor</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
    <style type="text/css">
      .error { 
      	background: #d33; 
      	color: white; 
      	padding: 0.2em; 
      }
      th { 
      	text-align: left; 
      	background-color: #999; 
      }
      th, td { 
      	padding: 0.4em; 
      }
    </style>
  </head>
  <body>
    <h1>A simple text editor</h1>
<?php 
	
	}
?>