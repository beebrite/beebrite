<?php
require_once('inc/open_conn.php');

$strSql = "SELECT strPassword FROM cat_users WHERE strEmail = '" . $_GET['uEMail'] . "';";
$rstRecover = mysql_query($strSql);
if(mysql_num_rows($rstRecover)!=0){
	$to = $_GET['uEMail'];
	$subject = "Your Beebrite's password";
	$message = "Your Beebrite's password is: " . mysql_result($rstRecover,0,0);
	$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
	$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$mail_sent = @mail( $to, $subject, $message, $headers );
};
mysql_close($con);
?>