<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        	<title>Uploading a Photo</title>
          <link rel="stylesheet" type="text/css" href="common.css" />
        </head>

        <body>

          <?php  
/*
The script first checks to see if the form has been submitted by looking for the existence of the sendPhoto submit button field. If the form was submitted, processForm() is called to handle the form; otherwise the form is displayed with displayForm().
*/
            if (isset($_POST["sendPhoto"])) {
              
              processForm();
            }
            else {
              displayForm();
            }

            function processForm()
            {
/*
processForm() handles the uploaded file (if any). First it checks to make sure a file was uploaded,
and that it uploaded without error.
*/
              if (isset($_FILES["photo"]) and $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {

 //If the uploaded file is not a JPEG photo, the function refuses it               
                if ($_FILES["photo"]["type"] != "image/jpeg") {
                   echo "<p>JPEG photos only, thanks!</p>";
                }
// The function then attempts to move the uploaded file from the temporary folder to the photos folder, displaying an error message if there was a problem. If all goes well, the thank-you page is displayed. Note the use of the PHP basename() function. This takes a file path and extracts just the filename portion of the path. Some browsers send the full path of the file when it’s uploaded — not just the filename — so the script uses basename() to make sure that only the filename portion is used for the file in the photos folder. Furthermore, this prevents attackers from inserting malicious characters (for example, “../”) into the filename.
                elseif (!move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . basename($_FILES["photo"]["name"]))) {
                  
                   echo "<p>Sorry, there was a problem uploading that photo.</p>" . $_FILES["photo"]["error"];
                }
                else {
                  displayThanks();
                }             
              }

//The function also displays an error message if no photo was uploaded, or if PHP reported an error in the $_FILES array
              else{
                switch ($_FILES["photo"]["error"]) {
                  case UPLOAD_ERR_INI_SIZE:
                    $message = "The photo is larger than the server allows.";
                    break;
                  
                  case UPLOAD_ERR_FORM_SIZE:
                    $message = "The photo is larger than the script allows.";
                    break;

                  case UPLOAD_ERR_NO_FILE:
                    $message = "No file was uploaded. Make sure you choose a file to upload.";
                    break;

                    default:
                      $message = "Please contact your server administrator for help.";
                }
                echo "<p>Sorry, there was a problem uploading that photo. $message</p>";
              }
            }
//The displayForm() function simply displays the file upload form, with a text field for the visitor’s name and a file select field to allow a file to be uploaded. Finally, the displayThanks() function thanks the user, displaying the user’s name (if supplied) and his photo.
            function displayForm() {
              ?>
        
              <h1>Uploading a Photo</h1>
              <p>Please enter your name and choose a photo to upload, then click Send Photo.</p>
        
              <form action="photo_upload.php" method="post" enctype="multipart/form-data">
          
                <div style="width: 30em;">
                  <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
                  <label for="visitorName">Your name</label>
                    <input type="text" name="visitorName" id="visitorName" value="" />
                  <label for="photo">Your photo</label>
                    <input type="file" name="photo" id="photo" value="" />
            
                  <div style="clear: both;">
                    <input type="submit" name="sendPhoto" value="Send Photo" />
                  </div>
                </div>
              </form>

              <?php 
              }

              function displayThanks() {
              ?>

                <h1>Thank You</h1>
                <p>Thanks for uploading your photo<?php if ( $_POST["visitorName"] )
                echo ", " . $_POST["visitorName"] ?>!</p>
                <p>Here’s your photo:</p>
                <p><img src="photos/<?php echo $_FILES["photo"]["name"] ?>" alt="Photo" /></p>
            
              <?php 

              }
              ?>

        </body>
    </html>














