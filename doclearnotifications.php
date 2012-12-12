<?php
require_once('inc/open_conn.php');
	$strSql = "UPDATE tbl_usr_activity SET intRead = 1 WHERE intUser1 = " . $_POST['uId'] . ";";
	mysql_query($strSql);
mysql_close($con);
?>