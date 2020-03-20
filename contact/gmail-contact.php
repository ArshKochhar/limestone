<?php

/*
THIS FILE USES PHPMAILER INSTEAD OF THE PHP MAIL() FUNCTION
*/

use PHPMailer\PHPMailer\PHPMailer;

require './PHPMailer-master/vendor/autoload.php';

/*
*  CONFIGURE EVERYTHING HERE
*/

// an email address that will be in the From field of the email.
$fromEmail = $_POST['email'];
$fromName = $_POST['name'];

// an email address that will receive the email with the output of the form
$sendToEmail = 'email@gmail.com';
// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name:', 'email' => 'Email:', 'message' => 'Message:');

// message that will be displayed when everything is OK :)
$okMessage = 'Successfully submitted - we will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

/*
*  LET'S DO THE SENDING
*/

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{
    
    if(count($_POST) == 0) throw new \Exception('Form is empty');
    $emailTextHtml .= "<h3>New message from the w3newbie Theme:</h3><hr>";
    $emailTextHtml .= "<table>";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }
    $emailTextHtml .= "</table><hr>";
    $emailTextHtml .= "<p>Have a great day!<br><br>Sincerely,<br><br>w3newbie Theme</p>";
    
    $mail = new PHPMailer;

//************** IMPORTANT

    // write you email configuration below and see the important steps for it to work.

    // IMPORTANT: You must turn off 2 step verification on your google/gmail account:
    // Instructions: https://support.google.com/accounts/answer/1064203?co=GENIE.Platform%3DDesktop&hl=en
    // Security Page: https://myaccount.google.com/security

    // IMPORTANT You must also "Allow less secure apps" on your google/gmail account:
    // https://myaccount.google.com/lesssecureapps

//************** IMPORTANT

$mail->IsSMTP();
                $mail->SMTPAuth='true';
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = "465"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                
                $mail->Username = "email@gmail.com";
                $mail->Password = "password";

                $mail->From = $fromEmail;
                $mail->FromName = $fromName;
                $mail->AddAddress($sendToEmail);
                $mail->AddReplyTo($fromEmail,$fromName);






    // end email configuration












    $mail->Subject = 'New message from contact form';

    $mail->Body = $emailTextHtml;
    $mail->isHTML(true);
    //$mail->msgHTML($emailTextHtml); // this will also create a plain-text version of the HTML email, very handy
    
    
    if(!$mail->send()) {
        throw new \Exception('Email send failed. ' . $mail->ErrorInfo);
    }
    
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    // $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}
?>