<?php
require_once('inc/open_conn.php');
	$strSql = "UPDATE cat_users SET strUsrLang = '" . $_POST['uLang'] . "' WHERE intId = " . $_POST['uId'] . ";";
	mysql_query($strSql);
	echo "OK";
	mysql_close($con);
?>