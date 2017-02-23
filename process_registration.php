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

<!--
As you can see, the process of capturing and displaying the submitted form data is really quite simple. Because the form is sent using the post method, the script extracts the form field values from the $_POST superglobal array, and displays each field value using echo().
-->
            <dl>
            	<dt>First name</dt><dd><?php echo $_POST["firstName"]?></dd>
            	<dt>Last name</dt><dd><?php echo $_POST["lastName"]?></dd>
            	<dt>Password</dt><dd><?php echo $_POST["password1"]?></dd>
            	<dt>Retyped password</dt><dd><?php echo $_POST["password2"]?></dd>
            	<dt>Gender</dt><dd><?php echo $_POST["gender"]?></dd>
            	<dt>Favorite widget</dt><dd><?php echo $_POST["favoriteWidget"]?></dd>
            	<dt>Do you want to receive our newsletter?</dt><dd><?php echo $_POST["newsletter"]?></dd>
            	<dt>Comments</dt><dd><?php echo $_POST["comments"]?></dd>
            </dl>

        </body>

	   </html>