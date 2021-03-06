<?php
    /* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * - Save it as sendnotifications.php and at the command line, run 
     *        php sendnotifications.php
     *
     * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
     *   in a web browser.
     * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
     *   directory to the folder containing this file, and load 
     *   localhost:8888/sendnotifications.php in a web browser.
     */
 
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require 'twilio-php-master/Services/Twilio.php';

    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACfa40595d59fb43559bf67d82b4afa84c";
    $AuthToken = "d092de58760f8176ca77e2c0ec05cf40";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        "+14159631533" => "Doug Singer",
        "+16054154166" => "Ryo"
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "415-801-3228", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            "Hey $name, the secret code is ooh-bee-doo-bee-doo"
        );
 
        // Display a confirmation message on the screen
        echo "Don't worry, Doug.  Your text message(s) to $name was sent";
    }


    // if the sender is known, then greet them by name
    // otherwise, consider them just another monkey
    if(!$name = $people[$_REQUEST['From']]) {
        $name = "Doug Singer";
    }
 
    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message><?php echo $name ?>, thanks for the message!</Message>
</Response>