
Currently editing:
/home2/shanegib/public_html/glenalbynmasters/contact.php
 Encoding:     Switch to Code Editor      Save

<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */


// echo "blah1234567890";
// an email address that will be in the From field of the email.
$from = 'admin@glenalbynmasters.com';

// // an email address that will receive the email with the output of the form
// $sendTo = 'Demo contact form <demo@domain.com>';
// $sendTo = 'blahblah@blah.ie';
//
// // subject of the email
// $subject = 'New message from contact form';
$subject = "Glenalbynmasters.com contact form message";

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
// message that will be displayed when everything is OK :)

$okMessage = 'Contact form successfully submitted to Glenalbyn Masters admin. </br></br>Thank you, </br></br>We will get back to you soon!</br>
</br><a href="http://www.glenalbynmasters.com">Return to home page</a>';

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

    $emailText = "You have a new message from the Glenalbyn Masters contact form\n\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $_POST['email'],
        'Reply-To: ' . $_POST['email'],
        'Return-Path: ' . $_POST['email'],
    );

    // Send email
    mail('carobrennan@yahoo.com , declan.culliton@yahoo.com , doyleei@tcd.ie , gibneysh@tcd.ie , janet@facit.ie ', $subject, $emailText, implode("\n", $headers));
    //mail('gibneysh@tcd.ie , shanegibney@gmail.com ', $subject, $emailText, implode("\n", $headers));

    echo "</br>";
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
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

Success!
