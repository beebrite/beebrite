<?php
require_once('inc/open_conn.php');

	$strInsTime = date("Y/m/d H:i:s");
	$strSql = "SELECT IFNULL(MAX(intTrainingId),0) FROM tbl_usr_trainings;";
	$rstTrId = mysql_query($strSql);
	$intNTrId = mysql_result($rstTrId,0,0) + 1;
	$strSql = "UPDATE tbl_usr_trainings SET intStatus = 2 WHERE intUser = " . $_POST['uId'] . " AND intType = 2 and intTrainingId <> " . $intNTrId . " AND intStatus = 0;";
	mysql_query($strSql);
	$strSql = "DELETE FROM tbl_usr_trainings WHERE intUser = " . $_POST['uId'] . " AND intType = 2 and intTrainingId <> " . $intNTrId . " AND intStats05 = -1;";
	mysql_query($strSql);
	$strSql = "INSERT INTO tbl_usr_trainings (intTrainingId, intUser, intTraining, intSession, intGame, dteSubscribed, intStatus, intType) VALUES (";
	$strSql .= $intNTrId . ",";
	$strSql .= $_POST['uId'] . ",";
	$strSql .= "0,";
	$strSql .= "0,";
	$strSql .= $_POST['idGame'] . ",";
	$strSql .= "'" . $strInsTime . "', 0, 2);";
	mysql_query($strSql);
	echo $intNTrId;
	unset($rstTrId);
	mysql_close($con);
?>