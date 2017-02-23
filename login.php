/*
 
 One common use of sessions is to allow registered users of your site to log in to the site in order to access their account and carry out actions. For example, customers of your online store could log in so that they could check their order history; similarly, users of a Web-based email system need to log in to the system to check their email. In addition, once the users have finished using the system, they need to log out.
 Sessions are a relatively secure way to build login systems because the only piece of information stored in the browser is the hard-to-guess session ID. Although the login username and password need to be sent from the browser when the user logs in, this only occurs during the login process. For every other request, only the session ID is sent by the browser.
 The following script allows the user to log in with a predefined username (“john”) and password (“secret”). It then displays a welcome message, along with the option to logout. Save it as login.php, then run the script in your Web browser. At the login page (Figure 10-4), log in with the username and password to view the welcome message (Figure 10-5), then log out to return to the login form.
 
*/
<?php

// The script starts by creating a new session (or picking up an existing one) with session_start(). Then it defines a couple of constants, USERNAME and PASSWORD, to store the predefined login details. (In a real Web site you would probably store a separate username and password for each user in a database table or text file.)
      session_start();
      define( "USERNAME", "john" );
      define( "PASSWORD", "secret" );

// Next the script calls various functions depending on user input. If the Login button in the login form was clicked, the script attempts to log the user in. Similarly, if the Logout link was clicked, the user is logged out. If the user is currently logged in, the welcome message is shown; otherwise the login form is displayed.

      if ( isset( $_POST["login"] ) ) {
        login();
      } 
      elseif ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
        logout();
      } 
      elseif ( isset( $_SESSION["username"] ) ) {
        displayPage();
      } 
      else {
        displayLoginForm();
      }

// The login() function validates the username and password and, if correct, sets a session variable, $_SESSION[“username“], to the logged-in user’s username. This serves two purposes: it indicates to the rest of the script that the user is currently logged in, and it also stores the user’s identity in the form of the username. (In a multi-user system this would allow the site to identify which user is logged in.) The function then reloads the page. However, if an incorrect username or password was entered, the login form is redisplayed with an error message.
      function login() {

        if ( isset( $_POST["username"] ) and isset( $_POST["password"] ) ) {

          if ( $_POST["username"] == USERNAME and $_POST["password"] == PASSWORD ) { $_SESSION["username"] = USERNAME;
            
            session_write_close();
            header( "Location: login.php" );
          } 
          else {
            displayLoginForm( "Sorry, that username/password could not be found. Please try again." );
          }
        } 
      }

// The logout() function simply deletes the $_SESSION[“username“] element to log the user out, then reloads the page.
      function logout() {

        unset( $_SESSION["username"] );
        session_write_close();
        header( "Location: login.php" );
      }

// The final three functions are fairly self-explanatory. displayPage() displays the welcome message, along with the Logout link. displayLoginForm() displays the login page, optionally displaying an error message. Both these functions use a utility function, displayPageHeader(), to display the markup for the page header that is common to both pages.
      function displayPage() {
        displayPageHeader();
?>

    <p>Welcome, <strong><?php echo $_SESSION["username"] ?></strong>! You are currently logged in.</p>
    <p><a href="login.php?action=logout">Logout</a></p>
  </body>
</html>

<?php 
  }
  function displayLoginForm( $message="" ) {
    displayPageHeader();
?>

    <?php if ( $message ) echo '<p class="error">' . $message . '</p>' ?>
    
      <form action="login.php" method="post">

        <div style="width: 30em;">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="" />
          <label for="password">Password</label>
          <input type="password" name="password" id="password" value="" />
        
            <div style="clear: both;">
                <input type="submit" name="login" value="Login" />
            </div>
        </div>
      </form>
  </body>
</html>

<?php 
}

function displayPageHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>A login/logout system</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
    <style type="text/css">
      .error { 
        background: #d33; 
        color: white; 
        padding: 0.2em; 
      }
    </style>
  </head>
  <body>
    <h1>A login/logout system</h1>
<?php
} 
?>


