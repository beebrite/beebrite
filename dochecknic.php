<?php
require_once('inc/open_conn.php');

$strSql = "SELECT COUNT(*) FROM cat_users WHERE strNick = '" . $_POST['sNick'] . "';";
$rstExisting = mysql_query($strSql);
if(mysql_result($rstExisting,0,0)==0){
	$strResponse = "0";
}else{
	$strResponse = "X";
};
unset($rstExisting);
echo $strResponse;
mysql_close($con);
?>