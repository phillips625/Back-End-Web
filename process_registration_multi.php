<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Thank You</title>
          <link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>
          	<h1>Thank You</h1>
        
            <p>Thank you for registering. Here is the information you submitted:</p>

            <?php 

                $favoriteWidgets = "";
                $newsletters = "";
/*
Next, for the favoriteWidgets field, the script checks to see if the corresponding $_POST array eleme ($_POST[“favoriteWidgets”]) exists. (Remember that, for certain unselected form controls such as multi-select lists and checkboxes, PHP doesn’t create a corresponding $_POST/$_GET/$_REQUEST arra element.) If the $_POST[“favoriteWidgets”] array element does exist, the script loops through each of the array elements in the nested array, concatenating their values onto the end of the $favoriteWidgets string, along with a comma and space to separate the values
*/
                if (isset($_POST["favoriteWidgets"])) {
                    foreach ($_POST["favoriteWidgets"] as $widget) {
                        
                        $favoriteWidgets .= $widget . ", ";
                    }
                }
                
                if (isset($_POST["newsletter"])) {
                    foreach ($_POST["newsletter"] as $newsletter) {
                        
                        $newsletters .= $newsletter . ", ";
                    }
                }

//If any field values were sent for these fields, the resulting strings now have a stray comma and space o the end, so the script uses a regular expression to remove these two characters, tidying up the strings
                $favoriteWidgets = preg_replace("/, $/", "", $favoriteWidgets);
                $newsletters = preg_replace("/, $/", "", $newsletters);
            ?>

<!--
As you can see, the process of capturing and displaying the submitted form data is really quite simple. Because the form is sent using the post method, the script extracts the form field values from the $_POST superglobal array, and displays each field value using echo().
-->
            <dl>
            	<dt>First name</dt><dd><?php echo $_POST["firstName"]?></dd>
            	<dt>Last name</dt><dd><?php echo $_POST["lastName"]?></dd>
            	<dt>Password</dt><dd><?php echo $_POST["password1"]?></dd>
            	<dt>Retyped password</dt><dd><?php echo $_POST["password2"]?></dd>
            	<dt>Gender</dt><dd><?php echo $_POST["gender"]?></dd>
            	<dt>Favorite widgets</dt><dd><?php echo $favoriteWidgets?></dd>
            	<dt>You want to receive the following newsletters:</dt><dd><?php echo $newsletters?></dd>
            	<dt>Comments</dt><dd><?php echo $_POST["comments"]?></dd>
            </dl>

        </body>

	   </html>