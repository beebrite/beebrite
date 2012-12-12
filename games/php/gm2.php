<?php
$strSql = "SELECT intLevel, intPoints, intTime, intBBI FROM cat_users WHERE intId = " . $uId . ";";
$rstJsonData = mysql_query($strSql);
?>
			"uData":{
				"uId": "<?php echo $uId; ?>", 
				"uPic": "<?php echo $uPic; ?>",	
				"uName": "<?php echo $uName; ?>",
				"uLast": "<?php echo $uLast; ?>",
				"uNick": "<?php echo $uNick; ?>",
				"uLang": "<?php echo $uLang; ?>",
				"uLevel": "<?php echo mysql_result($rstJsonData,0,0); ?>",
				"uPoints": "<?php echo mysql_result($rstJsonData,0,1); ?>",
				"uMs": "<?php echo mysql_result($rstJsonData,0,2); ?>",
				"uBBi": "<?php echo mysql_result($rstJsonData,0,3); ?>"},
<?php
unset($rstJsonData);
?>
			"tData":{
				"tId": "<?php echo $tId; ?>",
				"tName": "<?php echo $tName; ?>",
				"tType": "<?php echo $tType; ?>",
				"tSession": "<?php echo $tSession; ?>"},
<?php
$strSql = "SELECT strName FROM cat_games WHERE intId = " . $idGame . ";";
$rstJsonData = mysql_query($strSql);
?>
			"gData":{
				"gId": <?php echo $idGame; ?>,
				"gName": "<?php echo mysql_result($rstJsonData,0,0); ?>",
				"gType": "0",
<?php
unset($rstJsonData);
$strSql = "SELECT IFNULL(MAX(intStats01),0), IFNULL(MAX(intStats02),0), IFNULL(MAX(intStats03),0), IFNULL(MAX(intStats04),0) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intGame = " . $idGame . " AND intStatus = 1;";
$rstJsonData = mysql_query($strSql);
?>
				"gRecLevel": "<?php echo mysql_result($rstJsonData,0,0); ?>",
				"gRecPoints": "<?php echo mysql_result($rstJsonData,0,1); ?>",
				"gRecMs": "<?php echo mysql_result($rstJsonData,0,2); ?>",
				"gRecBBi": "<?php echo mysql_result($rstJsonData,0,3); ?>",
				"gArray" : [
<?php
unset($rstJsonData);

if ($tId == 0){
?>
							{"gPic": "games/img/gm<?php echo $idGame; ?>_big.png", gStatus:"1"},
<?php
} else {
	$strSql = "SELECT intGame FROM cat_t_s_g a WHERE a.intTraining = " . $tId . " AND a.intSession = " . $idTmpSess . " ORDER BY intId;";
	$rstJsonData = mysql_query($strSql);
	while ($objJsonData = mysql_fetch_array($rstJsonData))
	{
		if ($objJsonData['intGame'] == $idGame){
			$intTmpGStatus = 1;
		} else {
			$intTmpGStatus = 0;
		};
	?>
							{"gPic": "games/img/gm<?php echo $objJsonData['intGame']; ?>_big.png", gStatus:"<?php echo $intTmpGStatus; ?>"},
	<?php
	}
	unset($rstJsonData);
};
	?>
							{"gPic": "-1", gStatus:"-1"}]},
			"sData":[
<?php
$strSql = "SELECT intId FROM cat_stickers WHERE strOrigin = 'G' AND intTarget = " . $idGame . " AND blnPeel = 1 ORDER BY intId;";
$rstJsonData = mysql_query($strSql);
while ($objJsonData = mysql_fetch_array($rstJsonData))
{
?>
				{"sId": <?php echo $objJsonData['intId']; ?>, "sName": "<?php echo $arrStickersLang[$objJsonData['intId'] . '_N']; ?>", "sDesc": "<?php echo $arrStickersLang[$objJsonData['intId'] . '_D']; ?>", "sPic": "img/stickers/<?php echo $objJsonData['intId']; ?>_48.png", "sPeel": "1", "sUserName": "Gonzalo", "sUserLast": "Morales", "sPoints": "1000"},
<?php
}
unset($objDataFollow);
unset($rstJsonData);
?>
				{"sId": -1, "sName": "-1", "sDesc": "-1", "sPic":"-1", "sPeel":"-1", "sUserName": "-1", "sUserLast": "-1", "sPoints": "-1"}
				]
