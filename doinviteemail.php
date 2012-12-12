<?php
//define the receiver of the email
$to = $_POST['strTo'];
//define the subject of the email
$subject = 'Test email'; 
//define the message to be sent. Each line should be separated with \n
$message = $_POST['strMessage']; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>