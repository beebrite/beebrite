<?php
require_once('inc/open_conn.php');
	$strSql = "SELECT COUNT(DISTINCT(intTraining)) FROM tbl_usr_trainings WHERE intUser = " . $_POST['uId'] . " AND intStatus = 0 AND intType = 0;";
	$rstCTr = mysql_query($strSql);
	if (mysql_result($rstCTr,0,0) >= 4)
	{
		echo "X";
	}
	else
	{
		$strSql = "SELECT IFNULL(MAX(intTrainingId),0) FROM tbl_usr_trainings;";
		$rstTrId = mysql_query($strSql);
		$strSql = "SELECT * FROM cat_t_s_g WHERE intTraining = " . $_POST['intTraining'] . " ORDER BY intSession, intGame;";
		$rstTrainigs = mysql_query($strSql);
		$strInsTime = date("Y/m/d H:i:s");
		while ($objTrainigs = mysql_fetch_array($rstTrainigs))
		{
			$strSql = "INSERT INTO tbl_usr_trainings (intTrainingId, intUser, intTraining, intSession, intGame, dteSubscribed, intStatus, intType) VALUES (";
			$strSql .= (mysql_result($rstTrId,0,0) + 1) . ",";
			$strSql .= $_POST['uId'] . ",";
			$strSql .= $objTrainigs['intTraining'] . ",";
			$strSql .= $objTrainigs['intSession'] . ",";
			$strSql .= $objTrainigs['intGame'] . ",";
			$strSql .= "'" . $strInsTime . "', 0, 0);";
			mysql_query($strSql);
		}
		$strSql = "SELECT MAX(intSession) FROM cat_sessions WHERE intTrain = " . $_POST['intTraining'] . ";";
		$rstMaxSession = mysql_query($strSql);
		echo mysql_result($rstMaxSession,0,0);
		unset($rstTrId);
		unset($rstMaxSession);
		unset($rstTrainigs);
	}
	unset($rstCTr);
mysql_close($con);
?>