<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');

$strSql = "UPDATE cat_users SET ";
$arrVals = explode("||",$_POST['uVals']);
$strSql .= "intuVals00 = " . $arrVals[4] . ", ";
$strSql .= "intuVals01 = " . $arrVals[2] . ", ";
$strSql .= "intuVals02 = " . $arrVals[1] . ", ";
$strSql .= "intuVals03 = " . $arrVals[3] . ", ";
$strSql .= "intuVals04 = " . $arrVals[0] . " WHERE intId = " . $uId . ";";
mysql_query($strSql);

$strSql = "UPDATE tbl_usr_trainings SET intStatus = 3 WHERE intUser = " . $uId . " AND intType = 1 AND dteSubscribed < '" . date("Y/m/d") . "' AND intStatus = 0";
mysql_query($strSql);

$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 1 AND intStatus = 0";
$rstDailyTr = mysql_query($strSql);
if (mysql_result($rstDailyTr,0,0) == 0)
{
	$strSql  = "SELECT 1 AS 'Area', intuVals00 AS 'Value' FROM cat_users WHERE intid = " . $uId . " ";
	$strSql .= "UNION ";
	$strSql .= "SELECT 2 AS 'Area', intuVals01 AS 'Value' FROM cat_users WHERE intid = " . $uId . " ";
	$strSql .= "UNION ";
	$strSql .= "SELECT 3 AS 'Area', intuVals02 AS 'Value' FROM cat_users WHERE intid = " . $uId . " ";
	$strSql .= "UNION ";
	$strSql .= "SELECT 4 AS 'Area', intuVals03 AS 'Value' FROM cat_users WHERE intid = " . $uId . " ";
	$strSql .= "UNION ";
	$strSql .= "SELECT 5 AS 'Area', intuVals04 AS 'Value' FROM cat_users WHERE intid = " . $uId . " ";
	$strSql .= "ORDER BY 2 DESC, 1;";
	$rstVals = mysql_query($strSql);
	$intTo35 = 0;
	for ($intIx = 4; $intIx >= 0; $intIx--)
	{
		if ($intIx == 0)
		{
			$arrAreas[mysql_result($rstVals,$intIx,0)]= 35 - $intTo35;
		}
		else
		{
			$intTo35 = $intTo35 + floor(35*(mysql_result($rstVals,$intIx,1)/100));
			$arrAreas[mysql_result($rstVals,$intIx,0)]= floor(35*(mysql_result($rstVals,$intIx,1)/100));
		}
	}
	unset($rstVals);
	arsort($arrAreas);
	foreach($arrAreas as $key => $value)
	{
		$strSql = "SELECT (" . $value . " / COUNT(*)) AS 'strCGames', COUNT(*) as 'intCount' FROM cat_games WHERE intMainArea = " . $key . ";";
		$rstCGames = mysql_query($strSql);
		$intCGames = mysql_result($rstCGames,0,0);
		$intCount = mysql_result($rstCGames,0,1);
		unset($rstCGames);
		$strSql = "SELECT intId, strName FROM cat_games WHERE intMainArea = " . $key . " ORDER BY intId;";
		$rstCGames = mysql_query($strSql);
		$intDiff = 0;
		for($intIx = 0; $intIx < $intCount - 1; $intIx++)
		{
			$arrGames[mysql_result($rstCGames,$intIx,0)] = floor($intCGames);
			$intDiff = $intDiff + floor($intCGames);
		}
		$arrGames[mysql_result($rstCGames,$intCount - 1,0)] = $value - $intDiff;
		unset($rstCGames);
	}
	arsort($arrGames);
	$intDay = 0;
	$todayDate = date("Y/m/d");
	$strSql = "SELECT IFNULL(MAX(intTraining),0) + 1, IFNULL(MAX(intSession),0) + 1 FROM tbl_usr_trainings WHERE intUser = " . $uId . " and intType = 1";
	$rstMaxTr = mysql_query($strSql);
	$strSql = "SELECT IFNULL(MAX(intTrainingId),0) FROM tbl_usr_trainings;";
	$rstTrId = mysql_query($strSql);
	foreach($arrGames as $key => $value)
	{
		for ($intIx = 1; $intIx <= $value; $intIx++)
		{
			$todayAddedDate = strtotime(date("Y/m/d", strtotime($todayDate)) . "+" . $intDay . " day");
			$strSql = "INSERT INTO tbl_usr_trainings (intTrainingId, intUser, intType, intTraining, intSession, intGame, dteSubscribed, intStatus) VALUES (". (mysql_result($rstTrId,0,0) + 1) . "," . $uId . ",1," . mysql_result($rstMaxTr,0,0) . "," . (mysql_result($rstMaxTr,0,1) + $intDay) . "," . $key . ",'" . date('Y/m/d', $todayAddedDate) . "',0);";
			mysql_query($strSql);
			$intDay++;
			if ($intDay==7)
			{
				$intDay = 0;
			};
		};
	};
	unset($rstTrId);
	unset($rstMaxTr);
}
unset($rstDailyTr);
include('inc/close.php');

header("Location: beebrite.php");
exit(0);
?>