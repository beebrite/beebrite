<?php
require_once('inc/open_conn.php');

	if ($_POST['action'] == 0)
	{
		$strSql = "UPDATE tbl_usr_trainings SET dteSubscribed = NOW(), dteFinished = Null, intStatus = 0, intBBi = NULL, intStats00 = NULL, intStats01 = NULL, intStats02 = NULL, intStats03 = NULL, intStats04 = NULL, intStats05 = NULL, intStats06 = NULL, intStats07 = NULL, intStats08 = NULL, intStats09 = NULL, intStats10 = NULL, intStats11 = NULL, intStats12 = NULL, intStats13 = NULL, intStats14 = NULL, intStats15 = NULL, intStats16 = NULL, intStats17 = NULL, intStats18 = NULL, intStats19 = NULL, intStats20 = NULL WHERE intType = 0 AND intUser = " . $_POST['uId'] . " AND intTraining = " . $_POST['intTraining'] . ";";
	}
	else
	{
		$strSql = "UPDATE tbl_usr_trainings SET dteFinished = Null, intStatus = 2 WHERE intType = 0 AND intUser = " . $_POST['uId'] . " AND intTraining = " . $_POST['intTraining'] . ";";
	};
	mysql_query($strSql);
	echo "OK";
	mysql_close($con);
?>