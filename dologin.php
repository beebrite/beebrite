<?php
require_once('inc/open_conn.php');
if ($_GET['uFBId'] == '')
{
	$strSql = "SELECT intId FROM cat_users WHERE strEmail = '" . $_GET['uEmail'] . "' AND strPassword = '" . $_GET['uPwd'] . "';";
}
else
{
	$strSql = "SELECT intId FROM cat_users WHERE intFBId = '" . $_GET['uFBId'] . "';";
}
$rstLogin = mysql_query($strSql);
$strLoginResponse = "";
while ($objDataLogin = mysql_fetch_array($rstLogin))
{
	$strLoginResponse = $objDataLogin['intId'];
}
mysql_close($con);
echo $strLoginResponse;
?>