<!--
You can see from this example that cookies are a convenient way to store small amounts of data on a semi-permanent basis. Because the cookies are stored in the browser, you don’t have to worry about sending the data to the browser each time a page is viewed. You just set the cookies once then read their values later as needed.
-->
<?php 

/*
The script starts with the main decision-making logic. If the user details form was sent, it
calls storeInfo() to save the details in cookies. If the “Forget about me!” link was clicked, it calls forgetInfo() to erase the cookies. If neither of those things occurred, the script calls displayPage() to display the output to the visitor.
*/
	if (isset($_POST["sendInfo"])) {
		
		storeInfo();
	}
	elseif (isset($_GET["action"]) and $_GET["action"] == "forget") {
		
		forgetInfo();
	}
	else{

		displayPage();
	}
/*
The storeInfo() function looks for the user info fields, firstName and location, in the $_POST array. For each field, if it is found then a corresponding cookie is sent to the browser to store the field value. Each cookie is given an expiry time of one year from today. Finally, the function sets a Location: header to cause the browser to reload the remember_me.php script. Note that this reloading will cause the browser to send the recently created cookies back to the script.
*/
	function storeInfo()
	{
		if (isset($_POST["firstName"])) {
		
			setcookie("firstName", $_POST["firstName"], time() + 60 * 60 * 24 * 365, "", "", false, true);
		}

		if (isset($_POST["location"])) {
		
			setcookie("location", $_POST["location"], time() + 60 * 60 * 24 * 365, "", "", false, true);
		}

		header("Location: remember_me.php");
	}
/*
The forgetInfo() function sets both the firstName and location cookies’ expiry times to one hour ago, effectively deleting them from the browser. It then sends a Location: header to reload the remember_ me.php script. The browser won’t send the cookies to the script because they’ve just been deleted.
*/
	function forgetInfo()
	{
		setcookie("firstName", "", time() - 3600, "", "", false, true);
		setcookie("location", "", time() - 3600, "", "", false, true);
		header("Location: remember_me.php");
	}

//The final function, displayPage(), displays the output to the visitor. It starts by creating two variables to hold the values from the user info cookies (if any).
	function displayPage()
	{
		$firstName = (isset($_COOKIE["firstName"])) ? $_COOKIE["firstName"] : "";
		$location = (isset($_COOKIE["location"])) ? $_COOKIE["location"] : "";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Remembering user information with cookies</title>
          <link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>

        	 <h2>Remembering user information with cookies</h2>
        	 <?php  
/*
Next, after displaying the page header, the function looks at the values of $firstName and $location. If either variable contains a non-empty value, the function displays a greeting page, including the visitor info, a short nursery rhyme, and the “Forget about me!” link that links back to the remember_me.php script. This link contains a query string, action=forget, to signal to the script that the user wants to delete her information.
*/
        	 	if ($firstName or $location) {
        	 ?>       	
        	 		<p> Hi, <?php echo $firstName ? $firstName : "vistor" ?><?php echo $location ? " in $location" : "" ?>!</p>

					<p>Here’s a little nursery rhyme I know:</p>
   
    				<p><em>Hey diddle diddle,<br />
    					The cat played the fiddle,<br />
    					The cow jumped over the moon.<br />
    					The little dog laughed to see such sport,<br />
    					And the dish ran away with the spoon.</em>
    				</p>

    				<p><a href="remember_me.php?action=forget">Forget about me!</a></p>

    		<?php 
    			}

//However, if both $firstName and $location are empty, the script instead displays the user info form:
    			else {
    		?>

    				<form action="remember_me.php" method="post">
      					<div style="width: 30em;">
        					<label for="firstName">What's your first name?</label>
        						<input type="text" name="firstName" id="firstName" value="" />
        					<label for="location">Where do you live?</label>
        						<input type="text" name="location" id="location" value="" />
        						<div style="clear: both;">
          							<input type="submit" name="sendInfo" value="Send Info" />
        						</div>
      					</div>
    				</form>
    		<?php  
    			}
    		?>
    	<?php 
    	}
		?>        
	</body>    
</html>










