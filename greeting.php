<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
       	<head>
         	<title>Greetings</title>
         	<link rel="stylesheet" type="text/css" href="common.css" />
	   	</head>

	   	<body>
	   		<?php
	   			date_default_timezone_set( 'Europe/London' );

	   			////// passing the string “G” to date() returns the hour in 24-hour clock format
	   			$hour = date( "G" );
	   			////// passing “Y” returns the year.
	   			$year = date( "Y" );

	   			//////////// Greets you based on the time of the day
	   			if ($hour >= 5 && $hour < 12) {
	   				echo "<h1> Good Morning! </h1>";
	   			}
	   			else if ($hour >= 12 && $hour < 18) {
	   				echo "<h1> Good Afternoon! </h1>";
	   			}
	   			else if ($hour >= 18 && $hour < 22) {
	   				echo "<h1> Good Evening! </h1>";
	   			}
	   			else {
	   				echo "<h1> Good Night! </h1>";
	   			}

	   			////////////// Tell you if the year is a leap year
	   			$leapYear = false;
	   			////////// sets $leapYear to true if the current year is divisible by 4 but not by 100, or if it’s divisible by 400. 
	   			if( (($year%4==0) && ($year%100 !=0)) || ($year%400==0)) {
	   				$leapYear = true;
	   			}
	   			///////// The script then outputs a message, using the ternary operator (?) to insert the word “not” into the message if $leapYear is false.
	   			 echo "<p>Did you know that $year is" . ($leapYear ? "": " not") .  " a leap year?</p>";
	   		?>
	   	</body>

	  </html>