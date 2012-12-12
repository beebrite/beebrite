<?php
require_once('inc/open_conn.php');

$strSql = "UPDATE cat_users SET ";
if ($_GET['strNet'] == 'FB')
{
	$strSql .= "intFBId = NULL, strFBEMail = Null, strFBScreenmail = Null ";
}
else
{
	$strSql .= "intTWId = NULL, strTWScreenName = Null, strTWUser_Token = Null, strTWUser_Secret = Null ";
};
$strSql .= "WHERE intID = " . $_GET['uId'] . ";";
mysql_query($strSql);
mysql_close($con);
?>