<?php
require_once('inc/open_conn.php');
include('inc/func.php');

	$intTrId = urldecode($_POST['tId']);
	$uId = urldecode($_POST['uId']);
	$uLang = urldecode($_POST['uLang']);
	$gId = urldecode($_POST['gId']);
	$jsnDataR = array(
		'uData'=>array(
			'uId'=>'',
			'uPic'=>'',	
			'uName'=>'',
			'uLast'=>'',
			'uNick'=>'',
			'uLang'=>'',
			'uSound'=>'',
			'uLevel'=>'',
			'uPoints'=>'',
			'uMs'=>'',
			'uBBi'=>''),
		'tData'=>array(
			'tId'=>'',
			'tName'=>'',
			'tType'=>'',
			'tSession'=>''),
		'gData'=>array(
			'gPlay'=>'',
			'gId'=>'',
			'gName'=>'',
			'gTuto'=>'1',
			'gRecPoints'=>'',
			'gRecMs'=>''),
		'nData'=>'',
		'sData'=>array()
		);

	$strSql = "SELECT intUsrType FROM cat_users WHERE intId = " . $uId . ";";
	$rstDUT = mysql_query($strSql);
	if(mysql_result($rstDUT,0,0)==0){
		$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intStatus = 1 AND intGame = " . $gId . " AND dteFinished >= CURDATE() - INTERVAL 12 HOUR;";
		$rstLimited = mysql_query($strSql);
		if((mysql_result($rstLimited,0,0)+1)>3){
			$blnGoPlay = 0;
		}else{
			$blnGoPlay = 1;
		};
		unset($rstLimited);
	}else{
		$blnGoPlay = 1;
	};
	unset($rstDUT);
	$jsnDataR['gData']['gPlay'] = $blnGoPlay;

	$strSql = "SELECT DISTINCT(intType) FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . ";";
	$rstData = mysql_query($strSql);
	$tType = mysql_result($rstData,0,0);
	unset($rstData);
	$strSql = "SELECT DISTINCT(intTraining) FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . ";";
	$rstData = mysql_query($strSql);
	$tId = mysql_result($rstData,0,0);
	unset($rstData);
	switch($tType){
		case 0:
			$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'TRAININGS' AND strTag = '" . $tId . "_N';";
			$rstData = mysql_query($strSql);
			$tName = mysql_result($rstData,0,0);
			unset($rstData);
			break;
		case 1:
			$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'beebrite.php' AND strTag = 'dailytrainingstag';";
			$rstData = mysql_query($strSql);
			$tName = mysql_result($rstData,0,0);
			unset($rstData);
			break;
		case 2:
			$tName = "";
			break;
	};
	switch($tType){
		case 0:
			$strSql = "SELECT MIN(intSession), MAX(intSession) FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . " AND intStatus = 0 ORDER BY intSession, intId;";
			$rstData = mysql_query($strSql);
			$tSessionD = mysql_result($rstData,0,0) . " / " . mysql_result($rstData,0,1);
			$sId = mysql_result($rstData,0,0);
			$tSessionT = mysql_result($rstData,0,1);
			unset($rstData);
			break;
		case 1:
			$strSql = "SELECT MIN(intSession) FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . " AND intStatus = 0 ORDER BY intSession, intId;";
			$rstData = mysql_query($strSql);
			$tSessionD = "No. " . mysql_result($rstData,0,0);
			$sId = mysql_result($rstData,0,0);
			$tSessionT = 0;
			unset($rstData);
			break;
		case 2:
			$tSessionD = "";
			$sId = 0;
			$tSessionT = 0;
			break;
	};
	$arrData = explode("|", urldecode($_POST['strArr']));
	$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
	$rstData = mysql_query($strSql);
	$jsnDataR['uData']['uId'] = $uId;
	$jsnDataR['uData']['uPic'] = mysql_result($rstData,0,22);
	$jsnDataR['uData']['uName'] = mysql_result($rstData,0,3);
	$jsnDataR['uData']['uLast'] = mysql_result($rstData,0,4);
	$jsnDataR['uData']['uNick'] = mysql_result($rstData,0,5);
	$jsnDataR['uData']['uLang'] = mysql_result($rstData,0,28);
	$jsnDataR['uData']['uSound'] = mysql_result($rstData,0,26);
	unset($rstData);
	$jsnDataR['tData']['tId'] = $tId;
	$jsnDataR['tData']['tName'] = $tName;
	$jsnDataR['tData']['tType'] = $tType;
	$jsnDataR['tData']['tSession'] = $tSessionD;
	$jsnDataR['gData']['gId'] = $gId;
	$strSql = "SELECT strName FROM cat_games WHERE intId = " . $gId . ";";
	$rstData = mysql_query($strSql);
	$jsnDataR['gData']['gName'] = mysql_result($rstData,0,0);
	unset($rstData);
	$strSql = "SELECT intId FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . " AND intStatus = 0 ORDER BY intSession, intId LIMIT 1;";
	$rstData = mysql_query($strSql);
	$intRecId = mysql_result($rstData,0,0);
	unset($rstData);

	$strSql = "SELECT intLevels FROM cat_games WHERE intId = " . $gId . ";";
	$rstLevGame = mysql_query($strSql);
	if(mysql_result($rstLevGame,0,0)==1){
		$arrDataLevelRuntime = explode("*", $arrData[4]);
		$arrDataLevelPoints = explode("*", $arrData[7]);
		$arrDataLevelSpeed = explode("*", $arrData[10]);
		for($intIxLvl=1;$intIxLvl<=$arrData[3];$intIxLvl++){
			$strSql = "INSERT INTO tbl_usr_game_levels (intGame,intLevel,intRuntime,intPoints,intSpeed) VALUES (";
			$strSql .= $intRecId . ",";
			$strSql .= $intIxLvl . ",";
			$strSql .= $arrDataLevelRuntime[$intIxLvl] . ",";
			$strSql .= $arrDataLevelPoints[$intIxLvl] . ",";
			$strSql .= $arrDataLevelSpeed[$intIxLvl] . ");";
			mysql_query($strSql);
		};
	};
	unset($rstLevGame);

	$strSql = "SELECT intId FROM cat_games ORDER BY 1;";
	$rstGames = mysql_query($strSql);
	$dblAvg = 0;
	while ($objGames = mysql_fetch_array($rstGames)){
		$strSql = "SELECT IFNULL(MIN(intStats04),'X') FROM tbl_usr_trainings WHERE intGame = " . $objGames['intId'] . " AND intUser = " . $uId . " AND intstatus = 1;";
		$rstMS = mysql_query($strSql);
		if($gId==$objGames['intId']){
			if(mysql_result($rstMS,0,0)=='X'){
				$dblAvg = $dblAvg + $arrData[8];
			}else{
				if(mysql_result($rstMS,0,0)<$arrData[8]){
					$dblAvg = $dblAvg + mysql_result($rstMS,0,0);
				}else{
					$dblAvg = $dblAvg + $arrData[8];
				};
			};
		}else{
			if(mysql_result($rstMS,0,0)=='X'){
				$dblAvg = $dblAvg + 9999;
			}else{
				$dblAvg = $dblAvg + mysql_result($rstMS,0,0);
			};
		};
		unset($rstMS);
	};
	$dblAvg = $dblAvg / mysql_num_rows($rstGames);
	unset($rstGames);
	$strSql = "SELECT intPoints FROM cat_users WHERE intId = " . $uId . ";";
	$rstPoints = mysql_query($strSql);
	$intPoints = mysql_result($rstPoints,0,0) + $arrData[5];
	unset($rstPoints);
	$dblLevel = (5 * (log($intPoints / 5000)));
	if($dblLevel<0){
		$dblLevel = 0;
	};
	
	$strSql = "SELECT IFNULL(AVG(tbl_usr_trainings.intStats04),'X') ";
	$strSql .= "FROM (SELECT intId, intStats04 FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intStatus = 1 AND intGame = " . $gId . " ORDER BY dteFinished ASC LIMIT 7) b ";
	$strSql .= "JOIN  tbl_usr_trainings ";
	$strSql .= "ON tbl_usr_trainings.intId = b.intId;";
	
	$rstTH = mysql_query($strSql);
	if(mysql_result($rstTH,0,0)==='X'){
		$intBBI = 0;
	}else{
		$strSql = "SELECT IFNULL(MIN(intStats04),9999) FROM tbl_usr_trainings WHERE intGame = " . $gId . ";";
		$rstTG = mysql_query($strSql);
		$intBBI = ( ( 1 / ( $arrData[8] / mysql_result($rstTG,0,0) ) ) + ( ( mysql_result($rstTH,0,0) - $arrData[8] ) / mysql_result($rstTH,0,0) ) ) * 1000;
		unset($rstTG);
	};
	unset($rstTH);

	if($intBBI<0){
		$intBBI = 0;
	};
	
	$strSql = "SELECT intId FROM cat_games WHERE intId <> " . $gId . " ORDER BY 1;";
	$rstGames = mysql_query($strSql);
	$intUBBI = 0;
	while ($objGames = mysql_fetch_array($rstGames)){
		$strSql = "SELECT intStats00 FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intStatus = 1 AND intGame = " . $objGames['intId'] . " ORDER BY dteFinished DESC LIMIT 1;";
		$rstUB = mysql_query($strSql);
		if(mysql_num_rows($rstUB)!=0){
			$intUBBI = $intUBBI + mysql_result($rstUB,0,0);
		};
	};
	$intUBBI = ($intUBBI + $intBBI) / (mysql_num_rows($rstGames) + 1);
	unset($rstGames);
	
	/*### 171 ###*/
	$strSql = "SELECT IFNULL(MAX(intLevel),0) FROM cat_users;";
	$rstEval = mysql_query($strSql);
	if(mysql_result($rstEval,0,0)<$dblLevel){addSticker(171,true);};
	unset($rstEval);
	/*### 172 ###*/
	if($dblLevel>=10){addSticker(172,false);};	
	/*### 173 ###*/
	if($dblLevel>=25){addSticker(173,false);};	
	/*### 174 ###*/
	if($dblLevel>=50){addSticker(174,false);};	
	/*### 175 ###*/
	if($dblLevel>=100){addSticker(175,false);};	
	/*### 176 ###*/
	$strSql = "SELECT IFNULL(MAX(intBBI),0) FROM cat_users;";
	$rstEval = mysql_query($strSql);
	if(mysql_result($rstEval,0,0)<$intUBBI){addSticker(176,true);};
	unset($rstEval);
	/*### 177 ###*/
	if($intUBBI>=100){addSticker(177,false);};	
	/*### 178 ###*/
	if($intUBBI>=250){addSticker(178,false);};	
	/*### 179 ###*/
	if($intUBBI>=500){addSticker(179,false);};	
	/*### 180 ###*/
	if($intUBBI>=1000){addSticker(180,false);};	
	/*### 181 ###*/
	$strSql = "SELECT IFNULL(MIN(intTime),0) FROM cat_users WHERE intTime > 0;";
	$rstEval = mysql_query($strSql);
	if(mysql_result($rstEval,0,0)>$dblAvg){addSticker(181,true);};
	unset($rstEval);
	/*### 182 ###*/
	if($dblAvg<7500){addSticker(182,false);};	
	/*### 183 ###*/
	if($dblAvg<5000){addSticker(183,false);};	
	/*### 184 ###*/
	if($dblAvg<2500){addSticker(184,false);};	
	/*### 185 ###*/
	if($dblAvg<1000){addSticker(185,false);};	

	$strSql = "UPDATE cat_users SET intLevel = " . $dblLevel . ", intPoints = " . $intPoints . ", intTime = " . $dblAvg . ", intBBI = " . $intUBBI . " WHERE intId = " . $uId . ";";
	mysql_query($strSql);
	$jsnDataR['uData']['uLevel'] = 0;
	$jsnDataR['uData']['uPoints'] = $arrData[5];
	$jsnDataR['uData']['uMs'] = $arrData[2];
	$jsnDataR['uData']['uBBi'] = 0;
	$strSql = "UPDATE tbl_usr_trainings SET intBBi = " . $intUBBI . ", intStatus = 1, dteFinished = NOW(), intStats00 = " . $intBBI . ", intStats01 = " . ($arrData[1] - 1) . ", intStats02 = " . $arrData[2] . ", intStats03 = " . $arrData[5] . ", intStats04 = " . $arrData[8] . " WHERE intId = " . $intRecId . ";";
	mysql_query($strSql);

	$strSql = "SELECT IFNULL(MAX(intStats03),0), IFNULL(MAX(intStats04),0) FROM tbl_usr_trainings WHERE intGame = " . $gId . " AND intStatus = 1;";
	$rstData = mysql_query($strSql);
	if(mysql_result($rstData,0,0)<=$arrData[5]){
		$jsnDataR['gData']['gRecPoints'] = intval($arrData[5]);
	}else{
		$jsnDataR['gData']['gRecPoints'] = '';
	};
	if(mysql_result($rstData,0,1)<=$arrData[8]){
		$jsnDataR['gData']['gRecMs'] = intval($arrData[8]);
	}else{
		$jsnDataR['gData']['gRecMs'] = '';
	};
	unset($rstData);
	switch ($gId){
		case 1:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_1();
			break;
		case 2:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_2();
			break;
		case 3:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . ", intStats12 = " . $arrData[18] . ", intStats13 = " . $arrData[19] . ", intStats14 = " . $arrData[20] . ", intStats15 = " . $arrData[21] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_3();
			break;
		case 4:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_4();
			break;
		case 5:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . ", intStats12 = " . $arrData[18] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_5();
			break;
		case 6:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . ", intStats12 = " . $arrData[18] . ", intStats13 = " . $arrData[19] . ", intStats14 = " . $arrData[20] . ", intStats15 = " . $arrData[21] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_6();
			break;
		case 7:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . ", intStats12 = " . $arrData[18] . ", intStats13 = " . $arrData[19] . ", intStats14 = " . $arrData[20] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_7();
			break;
		case 8:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . ", intStats11 = " . $arrData[17] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_8();
			break;
		case 9:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_9();
			break;
		case 10:
			$strSql = "UPDATE tbl_usr_trainings SET intStats05 = " . $arrData[11] . ", intStats06 = " . $arrData[12] . ", intStats07 = " . $arrData[13] . ", intStats08 = " . $arrData[14] . ", intStats09 = " . $arrData[15] . ", intStats10 = " . $arrData[16] . " WHERE intId = " . $intRecId . ";";
			mysql_query($strSql);
			evalStickers_10();
			break;
	};
	if(count($jsnDataR['sData'])==0){
		unset($jsnDataR['sData']);
	};


	$intCTr =  0;
	$strSql = "SELECT DISTINCT(intTrainingId) FROM tbl_usr_trainings WHERE intUser = " . $uId . " and intType IN (0,1);";
	$rstDataT = mysql_query($strSql);
	while($objDataT = mysql_fetch_array($rstDataT)){
		$strSql = "SELECT DISTINCT(intSession) FROM tbl_usr_trainings WHERE intTrainingId = " . $objDataT['intTrainingId'] . ";";
		$rstDataSC = mysql_query($strSql);
		while($objDataS = mysql_fetch_array($rstDataSC)){
			$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intTrainingId = " . $objDataT['intTrainingId'] . " AND intSession = " . $objDataS['intSession'] . " AND intStatus <> 1;;";
			$rstDataTC = mysql_query($strSql);
			if(mysql_result($rstDataTC,0,0)==0){
				$intCTr++;
			};
			unset($rstDataTC);
		};
		unset($rstDataSC);
	};
	unset($rstDataT);

	/*### 164 ###*/
	$strSql = "SELECT IFNULL(MAX(intSessions),0) FROM cat_users;";
	$rstEval = mysql_query($strSql);
	if(mysql_result($rstEval,0,0)<$intCTr){addSticker(164,true);};
	unset($rstEval);
	/*### 165 ###*/
	if($intCTr>0){addSticker(165,false);};	
	/*### 166 ###*/
	if($intCTr>29){addSticker(166,false);};	
	/*### 167 ###*/
	if($intCTr>89){addSticker(167,false);};	
	/*### 168 ###*/
	if($intCTr>359){addSticker(168,false);};	
	/*### 169 ###*/
	if($intCTr>499){addSticker(169,false);};	
	/*### 170 ###*/
	if($intCTr>999){addSticker(170,false);};	

	$strSql = "UPDATE cat_users SET intSessions = " . $intCTr . " WHERE intId = " . $uId . ";";
	mysql_query($strSql);
	
	switch($tType){
		case 0:
			$strSql = "SELECT * FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . " AND intStatus = 0 order by intSession, intId;";
			$rstTrId = mysql_query($strSql);
			if(mysql_num_rows($rstTrId)!=0){
				$jsnDataR['nData'] = $intTrId;
			}else{
				$jsnDataR['nData'] = -1;
			};
			break;
			break;
		case 1:
			$strSql = "SELECT * FROM tbl_usr_trainings WHERE intTrainingId = " . $intTrId . " AND intStatus = 0 AND intSession = " . $sId . " order by intSession, intId;";
			$rstTrId = mysql_query($strSql);
			if(mysql_num_rows($rstTrId)!=0){
				$jsnDataR['nData'] = $intTrId;
			}else{
				$jsnDataR['nData'] = -1;
			};
			break;
		case 2:
			$strInsTime = date("Y/m/d H:i:s");
			$strSql = "SELECT IFNULL(MAX(intTrainingId),0) FROM tbl_usr_trainings;";
			$rstTrId = mysql_query($strSql);
			$strSql = "INSERT INTO tbl_usr_trainings (intTrainingId, intUser, intTraining, intSession, intGame, dteSubscribed, intStatus, intType, intStats05) VALUES (";
			$strSql .= (mysql_result($rstTrId,0,0) + 1) . ",";
			$strSql .= $uId . ",";
			$strSql .= "0,";
			$strSql .= "0,";
			$strSql .= $gId . ",";
			$strSql .= "'" . $strInsTime . "', 0, 2, -1);";
			mysql_query($strSql);
			$strSql = "UPDATE tbl_usr_trainings SET intStatus = 2 WHERE intUser = " . $uId . " AND intType = 2 and intTrainingId <> " . (mysql_result($rstTrId,0,0) + 1) . " AND intStatus = 0;";
			mysql_query($strSql);
			$jsnDataR['nData'] = mysql_result($rstTrId,0,0) + 1;
			unset($rstTrId);
			break;
	};

	echo json_encode($jsnDataR);
	mysql_close($con);

	function evalStickers_1(){
		global $arrData, $uId;
		$lgId = 1;
		### 1 ###*/
		if($arrData[5]>99){addSticker(1,false);};
		/*### 2 ###*/
		if($arrData[5]>499){addSticker(2,false);};		
		/*### 3 ###*/
		if($arrData[5]>4999){addSticker(3,false);};	
		/*### 4 ###*/
		if($arrData[5]>19999){addSticker(3,false);};	
		/*### 5 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[4]){addSticker(5,true);};
		unset($rstEval);
		/*### 6 ###*/
		if($arrData[2]>149999){addSticker(6,false);};
		/*### 7 ###*/
		if($arrData[2]>179999){addSticker(7,false);};
		/*### 8 ###*/
		if($arrData[2]>209999){addSticker(8,false);};
		/*### 9 ###*/
		if($arrData[11]==1){addSticker(9,false);};
		/*### 10 ###*/
		if($arrData[14]==1){addSticker(10,false);};
		/*### 11 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats01),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[1]){addSticker(11,true);};
		unset($rstEval);
		/*### 12 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats04),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[8]){addSticker(12,true);};
		unset($rstEval);
		/*### 13 ###*/
		if($arrData[13]==1){addSticker(13,false);};
		/*### 14 ###*/
		if($arrData[12]==1){addSticker(14,false);};
		/*### 15 ###*/
		if($arrData[2]>=599999){addSticker(15,false);};
	};

	function evalStickers_2(){
		global $arrData, $uId;
		$lgId = 2;
		/*### 16 ###*/
		if($arrData[16]>99){addSticker(16,false);};
		/*### 17 ###*/
		if($arrData[16]>499){addSticker(17,false);};		
		/*### 18 ###*/
		if($arrData[16]>999){addSticker(18,false);};	
		/*### 19 ###*/
		if(($arrData[1]-1)>49){addSticker(19,false);};
		/*### 20 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(20,true);};
		unset($rstEval);
		/*### 21 ###*/
		if($arrData[14]>=5){addSticker(21,false);};
		/*### 22 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats08),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[14]){addSticker(22,true);};
		unset($rstEval);
		/*### 23 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats11),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[17]){addSticker(23,true);};
		unset($rstEval);
		/*### 24 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[15]){addSticker(24,true);};
		unset($rstEval);
		/*### 25 ###*/
		if($arrData[14]>0 && $arrData[17]>0){addSticker(25,false);};
		/*### 26 ###*/
		if($arrData[14]>0 && $arrData[15]>0){addSticker(26,false);};
		/*### 27 ###*/
		if($arrData[14]>0 && $arrData[15]>0 && $arrData[17]>0){addSticker(27,false);};
		/*### 28 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[11]){addSticker(28,true);};
		unset($rstEval);
		/*### 29 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats06),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[12]){addSticker(29,true);};
		unset($rstEval);
		/*### 30 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[13]){addSticker(30,true);};
		unset($rstEval);
	};

	function evalStickers_3(){
		global $arrData, $uId;
		$lgId = 3;
		/*### 31 ###*/
		if($arrData[12]>99){addSticker(31,false);};
		/*### 32 ###*/
		if($arrData[12]>499){addSticker(32,false);};
		/*### 33 ###*/
		if($arrData[12]>999){addSticker(33,false);};
		/*### 34 ###*/
		if($arrData[12]>1749){addSticker(34,false);};
		/*### 35 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats06),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[12]){addSticker(35,true);};
		unset($rstEval);
		/*### 36 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[11]){addSticker(36,true);};
		unset($rstEval);
		/*### 37 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[13]){addSticker(37,true);};
		unset($rstEval);
		/*### 38 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats11),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[17]){addSticker(38,true);};
		unset($rstEval);
		/*### 39 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[15]){addSticker(39,true);};
		unset($rstEval);
		/*### 40 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats08),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[14]){addSticker(40,true);};
		unset($rstEval);
		/*### 41 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(41,true);};
		unset($rstEval);
		/*### 42 ###*/
		if($arrData[18]==1){addSticker(42,false);};
		/*### 43 ###*/
		if($arrData[19]==1){addSticker(43,false);};
		/*### 44 ###*/
		if($arrData[20]==1){addSticker(44,false);};
		/*### 45 ###*/
		if($arrData[21]==1){addSticker(45,false);};
	};

	function evalStickers_4(){
		global $arrData, $uId;
		$lgId = 4;
		/*### 46 ###*/
		if($arrData[5]>99){addSticker(46,false);};
		/*### 47 ###*/
		if($arrData[5]>999){addSticker(47,false);};
		/*### 48 ###*/
		if($arrData[5]>9999){addSticker(48,false);};
		/*### 49 ###*/
		if($arrData[5]>49999){addSticker(49,false);};
		/*### 50 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[5]){addSticker(50,true);};
		unset($rstEval);
		/*### 51 ###*/
		if($arrData[2]>149999){addSticker(51,false);};
		/*### 52 ###*/
		if($arrData[2]>179999){addSticker(52,false);};
		/*### 53 ###*/
		if($arrData[2]>209999){addSticker(53,false);};
		/*### 54 ###*/
		if($arrData[15]==1){addSticker(54,false);};
		/*### 55 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats06),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[12]){addSticker(55,true);};
		unset($rstEval);
		/*### 56 ###*/
		if($arrData[16]==1){addSticker(56,false);};
		/*### 57 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[11]){addSticker(55,true);};
		unset($rstEval);
		/*### 58 ###*/
		if($arrData[14]==1){addSticker(58,false);};
		/*### 59 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats02),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[2]){addSticker(59,true);};
		unset($rstEval);
		/*### 60 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[7]){addSticker(60,true);};
		unset($rstEval);
	};

	function evalStickers_5(){
		global $arrData, $uId;
		$lgId = 5;
		/*### 61 ###*/
		if($arrData[17]>29){addSticker(61,false);};
		/*### 62 ###*/
		if($arrData[17]>99){addSticker(62,false);};
		/*### 63 ###*/
		if($arrData[17]>499){addSticker(63,false);};
		/*### 64 ###*/
		if($arrData[17]>999){addSticker(64,false);};
		/*### 65 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats11),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[17]){addSticker(65,true);};
		unset($rstEval);
		/*### 66 ###*/
		if($arrData[18]==1){addSticker(66,false);};
		/*### 67 ###*/
		if($arrData[13]==1){addSticker(67,false);};
		/*### 68 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[11]){addSticker(68,true);};
		unset($rstEval);
		/*### 69 ###*/
		if($arrData[12]==1){addSticker(69,false);};
		/*### 70 ###*/
		if($arrData[14]==1){addSticker(70,false);};
		/*### 71 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(71,true);};
		unset($rstEval);
		/*### 72 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[15]){addSticker(72,true);};
		unset($rstEval);
		/*### 73 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats02),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[2]){addSticker(73,true);};
		unset($rstEval);
	};

	function evalStickers_6(){
		global $arrData, $uId;
		$lgId = 6;
		/*### 74 ###*/
		if($arrData[17]>9999){addSticker(74,false);};
		/*### 75 ###*/
		if($arrData[17]>24999){addSticker(75,false);};
		/*### 76 ###*/
		if($arrData[17]>49999){addSticker(76,false);};
		/*### 77 ###*/
		if($arrData[17]>99999){addSticker(77,false);};
		/*### 78 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats11),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[17]){addSticker(78,true);};
		unset($rstEval);
		/*### 79 ###*/
		if($arrData[20]==1){addSticker(79,false);};
		/*### 80 ###*/
		if($arrData[21]==1){addSticker(80,false);};
		/*### 81 ###*/
		if($arrData[19]==1){addSticker(81,true);};
		/*### 82 ###*/
		if($arrData[13]==1){addSticker(82,false);};
		/*### 83 ###*/
		if($arrData[14]==1){addSticker(83,true);};
		/*### 84 ###*/
		if($arrData[16]==1){addSticker(84,false);};
		/*### 85 ###*/
		if($arrData[11]==1){addSticker(85,true);};
		/*### 86 ###*/
		if($arrData[15]==1){addSticker(86,false);};
		/*### 87 ###*/
		if($arrData[11]==1){addSticker(87,true);};
		/*### 88 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats12),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[18]){addSticker(88,true);};
		unset($rstEval);
	};

	function evalStickers_7(){
		global $arrData, $uId;
		$lgId = 7;
		/*### 104 ###*/
		if($arrData[1]>4){addSticker(104,false);};
		/*### 105 ###*/
		if($arrData[1]>9){addSticker(105,false);};
		/*### 106 ###*/
		if($arrData[1]>11){addSticker(106,false);};
		/*### 107 ###*/
		if($arrData[12]==1){addSticker(107,false);};
		/*### 108 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[11]){addSticker(108,true);};
		unset($rstEval);
		/*### 109 ###*/
		if($arrData[17]==1){addSticker(109,false);};
		/*### 110 ###*/
		if($arrData[18]==1){addSticker(110,false);};
		/*### 111 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[16]){addSticker(111,true);};
		unset($rstEval);
		/*### 112 ###*/
		if($arrData[11]>199){addSticker(112,false);};
		/*### 113 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[13]){addSticker(113,true);};
		unset($rstEval);
		/*### 114 ###*/
		if($arrData[11]>249){addSticker(114,false);};
		/*### 115 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[15]){addSticker(115,true);};
		unset($rstEval);
		/*### 116 ###*/
		if($arrData[19]==1){addSticker(116,false);};
		/*### 117 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats14),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[20]){addSticker(117,true);};
		unset($rstEval);
		/*### 118 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[5]){addSticker(118,true);};
		unset($rstEval);
	};

	function evalStickers_8(){
		global $arrData, $uId;
		$lgId = 8;
		/*### 119 ###*/
		if($arrData[11]>99){addSticker(119,false);};
		/*### 120 ###*/
		if($arrData[11]>199){addSticker(120,false);};
		/*### 121 ###*/
		if($arrData[11]>499){addSticker(121,false);};
		/*### 122 ###*/
		if($arrData[11]>999){addSticker(122,false);};
		/*### 123 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[11]){addSticker(123,true);};
		unset($rstEval);
		/*### 124 ###*/
		if($arrData[1]>1){addSticker(124,false);};
		/*### 125 ###*/
		if($arrData[1]>3){addSticker(125,false);};
		/*### 126 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats05),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[3]){addSticker(126,true);};
		unset($rstEval);
		/*### 127 ###*/
		if($arrData[1]>5){addSticker(127,false);};
		/*### 128 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats06),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[12]){addSticker(128,true);};
		unset($rstEval);
		/*### 129 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[15]){addSticker(129,true);};
		unset($rstEval);
		/*### 130 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[13]){addSticker(130,true);};
		unset($rstEval);
		/*### 131 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(131,true);};
		unset($rstEval);
		/*### 132 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats08),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[14]){addSticker(132,true);};
		unset($rstEval);
		/*### 133 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats11),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[17]){addSticker(133,true);};
		unset($rstEval);
	};

	function evalStickers_9(){
		global $arrData, $uId;
		$lgId = 9;
		/*### 89 ###*/
		if($arrData[11]==1){addSticker(89,false);};
		/*### 90 ###*/
		if($arrData[12]==1){addSticker(90,false);};
		/*### 91 ###*/
		if($arrData[16]>249){addSticker(91,false);};
		/*### 92 ###*/
		if($arrData[16]>499){addSticker(92,false);};
		/*### 93 ###*/
		if($arrData[1]>4){addSticker(93,false);};
		/*### 94 ###*/
		if($arrData[11]>99){addSticker(94,false);};
		/*### 95 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[13]){addSticker(95,true);};
		unset($rstEval);
		/*### 96 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats08),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[14]){addSticker(96,true);};
		unset($rstEval);
		/*### 97 ###*/
		if($arrData[1]>9){addSticker(97,false);};
		/*### 98 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[5]){addSticker(98,true);};
		unset($rstEval);
		/*### 99 ###*/
		if($arrData[1]>14){addSticker(99,false);};
		/*### 100 ###*/
		$strSql = "SELECT IFNULL(MIN(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)>$arrData[15]){addSticker(100,true);};
		unset($rstEval);
		/*### 101 ###*/
		if($arrData[1]>19){addSticker(101,false);};
		/*### 102 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(102,true);};
		unset($rstEval);
		/*### 103 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats01),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[1]){addSticker(103,true);};
		unset($rstEval);
	};

	function evalStickers_10(){
		global $arrData, $uId;
		$lgId = 10;
		/*### 134 ###*/
		if($arrData[5]>9999){addSticker(134,false);};
		/*### 135 ###*/
		if($arrData[5]>19999){addSticker(135,false);};
		/*### 136 ###*/
		if($arrData[5]>49999){addSticker(136,false);};
		/*### 137 ###*/
		if($arrData[5]>99999){addSticker(137,false);};
		/*### 138 ###*/
		if($arrData[1]>9){addSticker(138,false);};
		/*### 139 ###*/
		if($arrData[1]>19){addSticker(139,false);};
		/*### 140 ###*/
		if($arrData[1]>29){addSticker(140,false);};
		/*### 141 ###*/
		if($arrData[11]==1){addSticker(141,false);};
		/*### 142 ###*/
		if($arrData[12]==1){addSticker(142,false);};
		/*### 143 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats07),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[13]){addSticker(143,true);};
		unset($rstEval);
		/*### 144 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[5]){addSticker(144,true);};
		unset($rstEval);
		/*### 145 ###*/
		if($arrData[14]!=-1){
			$strSql = "SELECT IFNULL(MIN(intStats08),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
			$rstEval = mysql_query($strSql);
			if(mysql_result($rstEval,0,0)>$arrData[14]){addSticker(145,true);};
			unset($rstEval);
		};
		/*### 146 ###*/
		if($arrData[15]!=-1){
			$strSql = "SELECT IFNULL(MIN(intStats09),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
			$rstEval = mysql_query($strSql);
			if(mysql_result($rstEval,0,0)>$arrData[15]){addSticker(146,true);};
			unset($rstEval);
		};
		/*### 147 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats01),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[1]){addSticker(147,true);};
		unset($rstEval);
		/*### 148 ###*/
		$strSql = "SELECT IFNULL(MAX(intStats10),0) FROM tbl_usr_trainings WHERE intGame = " . $lgId . " AND intStatus = 1 AND intUser <> " . $uId . ";";
		$rstEval = mysql_query($strSql);
		if(mysql_result($rstEval,0,0)<$arrData[16]){addSticker(148,true);};
		unset($rstEval);
	};

	function addSticker($intSticker, $blnPeel){
		global $uId, $uLang, $jsnDataR, $intRecId;
		if($blnPeel){
			$strSql = "DELETE FROM tbl_usr_activity WHERE intSticker = " . $intSticker . ";";
			mysql_query($strSql);
			$strSql = "SELECT intUser FROM tbl_usr_stickers WHERE intSticker = " . $intSticker . " ORDER BY dteTimeStamp DESC LIMIT 1;";
			$rstStk = mysql_query($strSql);
			if(mysql_num_rows($rstStk)==0){
				$strSql = "INSERT INTO tbl_usr_stickers (intUser, intSticker, dteTimeStamp, intGame, intLast) VALUES (" . $uId . "," . $intSticker . ",NOW()," . $intRecId . ",1);";
				insertSticker($strSql);
				$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'STICKERS' AND strTag LIKE ('" . $intSticker . "\_%') ORDER BY strTag DESC;";
				$rstLang = mysql_query($strSql);
				array_push($jsnDataR['sData'], array('sId'=>$intSticker, 'sName'=>mysql_result($rstLang,0,0), 'sDesc'=>mysql_result($rstLang,1,0), 'sPic'=>'img/stickers/' . $intSticker . '_160.png', 'sPeel'=>'1'));
				pushNotification(4, $uId, 'none', $intSticker);
				sendEmail($intSticker,true,'');
				sendFBTW($intSticker,true,mysql_result($rstLang,0,0));
				unset($rstLang);
			}else{
				if(mysql_result($rstStk,0,0)!=$uId){
					$strSql = "UPDATE tbl_usr_stickers SET intLast = 0 WHERE intSticker = " . $intSticker . ";";
					mysql_query($strSql);
					$strSql = "INSERT INTO tbl_usr_stickers (intUser, intSticker, dteTimeStamp, intGame, intLast) VALUES (" . $uId . "," . $intSticker . ",NOW()," . $intRecId . ",1);";
					insertSticker($strSql);
					$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'STICKERS' AND strTag LIKE ('" . $intSticker . "\_%') ORDER BY strTag DESC;";
					$rstLang = mysql_query($strSql);
					array_push($jsnDataR['sData'], array('sId'=>$intSticker, 'sName'=>mysql_result($rstLang,0,0), 'sDesc'=>mysql_result($rstLang,1,0), 'sPic'=>'img/stickers/' . $intSticker . '_160.png', 'sPeel'=>'1'));
					pushNotification(4, $uId, mysql_result($rstStk,0,0), $intSticker);
					sendEmail($intSticker,true,mysql_result($rstStk,0,0));
					sendFBTW($intSticker,true,mysql_result($rstLang,0,0));
					unset($rstLang);
				};
				unset($rstStk);
			};
		}else{
			$strSql = "SELECT COUNT(*) FROM tbl_usr_stickers WHERE intUser = " . $uId . " AND intSticker = " . $intSticker . ";";
			$rstStk = mysql_query($strSql);
			if(mysql_result($rstStk,0,0)==0){
				$strSql = "INSERT INTO tbl_usr_stickers (intUser, intSticker, dteTimeStamp, intGame, intLast) VALUES (" . $uId . "," . $intSticker . ",NOW()," . $intRecId . ",1);";
				insertSticker($strSql);
				$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'STICKERS' AND strTag LIKE ('" . $intSticker . "\_%') ORDER BY strTag DESC;";
				$rstLang = mysql_query($strSql);
				array_push($jsnDataR['sData'], array('sId'=>$intSticker, 'sName'=>mysql_result($rstLang,0,0), 'sDesc'=>mysql_result($rstLang,1,0), 'sPic'=>'img/stickers/' . $intSticker . '_160.png', 'sPeel'=>'0'));
				pushNotification(3, $uId, 'none', $intSticker);
				sendEmail($intSticker,false,'');
				sendFBTW($intSticker,false,mysql_result($rstLang,0,0));
				unset($rstLang);
			};
			unset($rstStk);
		};
	}

	function sendFBTW($intSticker,$blnPeel,$strSticker){
		global $uId, $uLang;
		
		$arrTWFBPINLang = getLangArray('FBTWPIN',$uLang);
		
		$strSql = "SELECT a.intTWId, a.strTWUser_Token, a.strTWUser_Secret, b.intShare05, b.intShare06 FROM cat_users a, tbl_usr_settings b WHERE a.intId = " . $uId . " AND a.intId = b.intUser;";
		$rstTW = mysql_query($strSql);
		if(!is_null(mysql_result($rstTW,0,0))){
			if($blnPeel){
				if(mysql_result($rstTW,0,4)==1){
					$tweet_text = str_replace("&&link&&",hashEncode($uId) . "-" . hashEncode($intSticker),str_replace("&&sticker&&",$strSticker,$arrTWFBPINLang['TWEET_PEEL']));
					$result = post_tweet($tweet_text,mysql_result($rstTW,0,1),mysql_result($rstTW,0,2));
				};
			}else{
				if(mysql_result($rstTW,0,3)==1){
					$tweet_text = str_replace("&&link&&",hashEncode($uId) . "-" . hashEncode($intSticker),str_replace("&&sticker&&",$strSticker,$arrTWFBPINLang['TWEET']));
					$result = post_tweet($tweet_text,mysql_result($rstTW,0,1),mysql_result($rstTW,0,2));
				};
			};
			unset($result);
		};
		unset($rstTW);

		$strSql = "SELECT a.intFBId, b.intShare03, b.intShare04, a.strFBToken FROM cat_users a, tbl_usr_settings b WHERE a.intId = " . $uId . " AND a.intId = b.intUser;";
		$rstFB = mysql_query($strSql);
		if(!is_null(mysql_result($rstFB,0,0))){
			if($blnPeel){
				if(mysql_result($rstFB,0,2)==1){
					$dback = post_timeline($uId,$intSticker,mysql_result($rstFB,0,0),mysql_result($rstFB,0,3));
					$strSql = "INSERT INTO tabla VALUES('" . $uId . " - " . $intSticker . $dback . "');";
					mysql_query($strSql);
					unset($dback);
				};
			}else{
				if(mysql_result($rstFB,0,1)==1){
					$dback = post_timeline($uId,$intSticker,mysql_result($rstFB,0,0),mysql_result($rstFB,0,3));
					$strSql = "INSERT INTO tabla VALUES('" . $uId . " - " . $intSticker . $dback . "');";
					mysql_query($strSql);
					unset($dback);
				};
			};
		};
		unset($rstFB);

		unset($arrTWFBPINLang);
	};

	function post_tweet($tweet_text,$user_token,$user_secret) {
		require_once('tw/lib/tmhOAuth.php');
		$connection = new tmhOAuth(array(
		'consumer_key' => 'sEQDGOuOWu1G7p8ZOYrlg',
		'consumer_secret' => 'olMMu7ykDIz590k95o9vcuvdVFXJ3P2sQ98b8QTMvhY',
		'user_token' => $user_token,
		'user_secret' => $user_secret,
		)); 
		$connection->request('POST', 
		$connection->url('1/statuses/update'), 
		array('status' => $tweet_text));
		return $connection->response['code'];
	}
	
	function post_timeline($uId,$sId,$iFBId,$sFBToken){
		$strUrl = "http://www.beebrite.com/opengraph/action.php?uId=" . $uId . "&sId=" . $sId;
		$ch = curl_init('https://graph.facebook.com/me/beebrite:peel_of');
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => array(
		        'access_token' => $sFBToken,
		        'sticker' => $strUrl
		    )
		));
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	};

	function insertSticker($strLSql){
		mysql_query($strLSql);
	};

	function sendEmail($intSticker, $blnPeel, $intToUser){
		global $uId, $uLang;
		$to = '';
		$subject = '';
		$message = '';
		$headers = '';
		
		if($blnPeel){
			if($intToUser==''){
				$strSql = "SELECT intNotifications03 FROM tbl_usr_settings WHERE intUser = " . $uId . ";";
				$rstSend = mysql_query($strSql);
				if(mysql_result($rstSend,0,0)==1){
					$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
					$rstUsrData = mysql_query($strSql);
					$arrEmailLang = getLangArray('EMAIL',$uLang);
					$arrStickerLang = getLangArray('STICKERS',$uLang);
					$to = mysql_result($rstUsrData,0,1);
					$subject = str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_02_subject']);
					$message = "<html>";
					$message .= "<head>";
					$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
					$message .= "<title>Welcome to Beebrite!</title>";
					$message .= "</head>";
					$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
					$message .= "<table style='margin:20px auto 0px auto;border-spacing:0px 0px;'>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:28px;'>" . str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrData,0,3))),$arrEmailLang['sticker_02_01']) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_02_02']) . "</td></tr>";
					$message .= "	<tr><td style='height:40px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/stickers/" . $intSticker . "_370.png'" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . $arrStickerLang[$intSticker . '_D'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:17px;'>" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center'><a href='http://www.facebook.com/beebrite'><img src='http://www.beebrite.com/img/email/facebook.png' style='border:0px;'></a>&nbsp;<a href='https://twitter.com/beebrite_'><img src='http://www.beebrite.com/img/email/twitter.png' style='border:0px;'></a>&nbsp;<a href='http://pinterest.com/wearebeebrite/'><img src='http://www.beebrite.com/img/email/pinterest.png' style='border:0px;'></a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_01'] . " " . strtolower(mysql_result($rstUsrData,0,1)) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_02'] . " <a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_03'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>&copy;2012 Beebrite SL.&nbsp;|&nbsp;" . $arrEmailLang['footer_04'] . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'><a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_05'] . "</a>&nbsp;|&nbsp;<a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_06'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "</table>";
					$message .= "</body>";
					$message .= "</html>";
					$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
					$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					$mail_sent = @mail($to,$subject,$message,$headers);
					unset($arrStickerLang);
					unset($arrEmailLang);
					unset($rstUsrData);
				};
				unset($rstSend);
			}else{
				$strSql = "SELECT intNotifications03 FROM tbl_usr_settings WHERE intUser = " . $uId . ";";
				$rstSend = mysql_query($strSql);
				if(mysql_result($rstSend,0,0)==1){
					$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
					$rstUsrData = mysql_query($strSql);
					$strSql = "SELECT * FROM cat_users WHERE intId = " . $intToUser . ";";
					$rstUsrDataV = mysql_query($strSql);
					$arrEmailLang = getLangArray('EMAIL',$uLang);
					$arrStickerLang = getLangArray('STICKERS',$uLang);
					$to = mysql_result($rstUsrData,0,1);
					$subject = str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrDataV,0,3))),str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_03_subject']));
					$message = "<html>";
					$message .= "<head>";
					$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
					$message .= "<title>Welcome to Beebrite!</title>";
					$message .= "</head>";
					$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
					$message .= "<table style='margin:20px auto 0px auto;border-spacing:0px 0px;'>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:28px;'>" . str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrData,0,3))),$arrEmailLang['sticker_03_01']) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . str_replace("&&user&&", "<a style='text-decoration:none; font-weight:bold; color:#505050; font-size:13px; ' href='http://www.beebrite.com/" . mysql_result($rstUsrDataV,0,5) . "'>" . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . "</a>" ,str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_03_02'])) . "</td></tr>";
					$message .= "	<tr><td style='height:40px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='height:96px; border:1px #C8C8C8 solid; padding:0px 0px 0px 0px;'>";
					$message .= "	<table style='border:0px;border-spacing:0px 0px;'>";
					$message .= "		<tr><td style='width:596px;height:94px; border:2px #EBEBEB solid; background-color:#FFFFFF; padding:0px'>";
					$message .= "			<table style='border:0px;border-spacing:0px 0px;'>";
					$message .= "				<tr>";
					$message .= "					<td style='border:0px;border-spacing:0px 0px; height:94px; padding:0px; vertical-align:top '><img src='" . str_replace("picture?type=large","picture?type=square",mysql_result($rstUsrDataV,0,22)) . "' style='width:94px; height:94px; border:0px; margin-bottom:-10px; '></td>";
					$message .= "					<td style='font-size:20px;width:480px;padding-left:20px;  '>";
					$message .= "						<a style='text-decoration:none; font-weight:bold; color:#505050; font-size:13px; ' href='http://www.beebrite.com/" . mysql_result($rstUsrDataV,0,5) . "'>" . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . " " . ucwords(strtolower(mysql_result($rstUsrDataV,0,4))) . "</a>";
					$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $intToUser . ";";
					$rstpFollow = mysql_query($strSql);
					$message .= "						 <span style='font-size:13px; color:#A0A0A0'>" . $arrEmailLang['sticker_03_03'] . " " . number_format(mysql_result($rstpFollow, 0, 0),0,".",",") . " " . $arrEmailLang['sticker_03_04'] . " ";
					unset($rstpFollow);
					$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $intToUser . ";";
					$rstpFollow = mysql_query($strSql);
					$message .= "						 " . number_format(mysql_result($rstpFollow, 0, 0),0,".",",") . "<br /></span>";
					unset($rstpFollow);
					$message .= "						<img src='http://www.beebrite.com/img/email/level.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,10),0,".",",") . "&nbsp;&nbsp;<img src='http://www.beebrite.com/img/email/bbi.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,13),0,".",",") . "&nbsp;&nbsp;<img src='http://www.beebrite.com/img/email/speed.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,12),0,".",",");
					$message .= "					</td>";
					$message .= "				</tr>";
					$message .= "			</table>";
					$message .= "		</td></tr>";
					$message .= "	</table>";
					$message .= "	</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/stickers/" . $intSticker . "_370.png'" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . $arrStickerLang[$intSticker . '_D'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:17px;'>" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center'><a href='http://www.facebook.com/beebrite'><img src='http://www.beebrite.com/img/email/facebook.png' style='border:0px;'></a>&nbsp;<a href='https://twitter.com/beebrite_'><img src='http://www.beebrite.com/img/email/twitter.png' style='border:0px;'></a>&nbsp;<a href='http://pinterest.com/wearebeebrite/'><img src='http://www.beebrite.com/img/email/pinterest.png' style='border:0px;'></a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_01'] . " " . strtolower(mysql_result($rstUsrData,0,1)) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_02'] . " <a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_03'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>&copy;2012 Beebrite SL.&nbsp;|&nbsp;" . $arrEmailLang['footer_04'] . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'><a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_05'] . "</a>&nbsp;|&nbsp;<a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_06'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "</table>";
					$message .= "</body>";
					$message .= "</html>";
					$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
					$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					$mail_sent = @mail($to,$subject,$message,$headers);
					unset($arrEmailLang);
					unset($rstUsrData);
				};
				unset($rstSend);
				$strSql = "SELECT intNotifications04 FROM tbl_usr_settings WHERE intUser = " . $intToUser . ";";
				$rstSend = mysql_query($strSql);
				if(mysql_result($rstSend,0,0)==1){
					$strSql = "SELECT * FROM cat_users WHERE intId = " . $intToUser . ";";
					$rstUsrData = mysql_query($strSql);
					$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
					$rstUsrDataV = mysql_query($strSql);
					$arrEmailLang = getLangArray('EMAIL',$uLang);
					$arrStickerLang = getLangArray('STICKERS',$uLang);
					$to = mysql_result($rstUsrData,0,1);
					$subject = str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrDataV,0,3))),str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_04_subject']));
					$message = "<html>";
					$message .= "<head>";
					$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
					$message .= "<title>Welcome to Beebrite!</title>";
					$message .= "</head>";
					$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
					$message .= "<table style='margin:20px auto 0px auto;border-spacing:0px 0px;'>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:28px;'>" . str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrData,0,3))),$arrEmailLang['sticker_04_01']) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . str_replace("&&user&&", "<a style='text-decoration:none; font-weight:bold; color:#505050; font-size:13px; ' href='http://www.beebrite.com/" . mysql_result($rstUsrDataV,0,5) . "'>" . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . "</a>" ,str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_04_02'])) . "</td></tr>";
					$message .= "	<tr><td style='height:40px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='height:96px; border:1px #C8C8C8 solid; padding:0px 0px 0px 0px;'>";
					$message .= "	<table style='border:0px;border-spacing:0px 0px;'>";
					$message .= "		<tr><td style='width:596px;height:94px; border:2px #EBEBEB solid; background-color:#FFFFFF; padding:0px'>";
					$message .= "			<table style='border:0px;border-spacing:0px 0px;'>";
					$message .= "				<tr>";
					$message .= "					<td style='border:0px;border-spacing:0px 0px; height:94px; padding:0px; vertical-align:top '><img src='" . str_replace("picture?type=large","picture?type=square",mysql_result($rstUsrDataV,0,22)) . "' style='width:94px; height:94px; border:0px; margin-bottom:-10px; '></td>";
					$message .= "					<td style='font-size:20px;width:480px;padding-left:20px;  '>";
					$message .= "						<a style='text-decoration:none; font-weight:bold; color:#505050; font-size:13px; ' href='http://www.beebrite.com/" . mysql_result($rstUsrDataV,0,5) . "'>" . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . " " . ucwords(strtolower(mysql_result($rstUsrDataV,0,4))) . "</a>";
					$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $intToUser . ";";
					$rstpFollow = mysql_query($strSql);
					$message .= "						 <span style='font-size:13px; color:#A0A0A0'>" . $arrEmailLang['sticker_04_03'] . " " . number_format(mysql_result($rstpFollow, 0, 0),0,".",",") . " " . $arrEmailLang['sticker_04_04'] . " ";
					unset($rstpFollow);
					$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $intToUser . ";";
					$rstpFollow = mysql_query($strSql);
					$message .= "						 " . number_format(mysql_result($rstpFollow, 0, 0),0,".",",") . "<br /></span>";
					unset($rstpFollow);
					$message .= "						<img src='http://www.beebrite.com/img/email/level.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,10),0,".",",") . "&nbsp;&nbsp;<img src='http://www.beebrite.com/img/email/bbi.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,13),0,".",",") . "&nbsp;&nbsp;<img src='http://www.beebrite.com/img/email/speed.png' style='vertical-align:middle'>&nbsp;" . number_format(mysql_result($rstUsrDataV,0,12),0,".",",");
					$message .= "					</td>";
					$message .= "				</tr>";
					$message .= "			</table>";
					$message .= "		</td></tr>";
					$message .= "	</table>";
					$message .= "	</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/stickers/" . $intSticker . "_160_n.png'" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . $arrStickerLang[$intSticker . '_D'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:17px;'>" . $arrEmailLang['footer_00'] . "</td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center'><a href='http://www.facebook.com/beebrite'><img src='http://www.beebrite.com/img/email/facebook.png' style='border:0px;'></a>&nbsp;<a href='https://twitter.com/beebrite_'><img src='http://www.beebrite.com/img/email/twitter.png' style='border:0px;'></a>&nbsp;<a href='http://pinterest.com/wearebeebrite/'><img src='http://www.beebrite.com/img/email/pinterest.png' style='border:0px;'></a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_01'] . " " . strtolower(mysql_result($rstUsrData,0,1)) . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_02'] . " <a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_03'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'>&copy;2012 Beebrite SL.&nbsp;|&nbsp;" . $arrEmailLang['footer_04'] . "</td></tr>";
					$message .= "	<tr><td style='text-align:center;font-size:10px'><a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_05'] . "</a>&nbsp;|&nbsp;<a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_06'] . "</a></td></tr>";
					$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
					$message .= "</table>";
					$message .= "</body>";
					$message .= "</html>";
					$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
					$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					$mail_sent = @mail($to,$subject,$message,$headers);
					unset($arrEmailLang);
					unset($rstUsrData);
				};
				unset($rstSend);
			};
		}else{
			$strSql = "SELECT intNotifications02 FROM tbl_usr_settings WHERE intUser = " . $uId . ";";
			$rstSend = mysql_query($strSql);
			if(mysql_result($rstSend,0,0)==1){
				$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
				$rstUsrData = mysql_query($strSql);
				$arrEmailLang = getLangArray('EMAIL',$uLang);
				$arrStickerLang = getLangArray('STICKERS',$uLang);
				$to = mysql_result($rstUsrData,0,1);
				$subject = str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_01_subject']);
				$message = "<html>";
				$message .= "<head>";
				$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
				$message .= "<title>Welcome to Beebrite!</title>";
				$message .= "</head>";
				$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
				$message .= "<table style='margin:20px auto 0px auto;border-spacing:0px 0px;'>";
				$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:28px;'>" . str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrData,0,3))),$arrEmailLang['sticker_01_01']) . "</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . str_replace("&&sticker&&",$arrStickerLang[$intSticker . '_N'],$arrEmailLang['sticker_01_02']) . "</td></tr>";
				$message .= "	<tr><td style='height:40px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/stickers/" . $intSticker . "_370.png'" . $arrEmailLang['footer_00'] . "</td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . $arrStickerLang[$intSticker . '_D'] . "</td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:17px;'>" . $arrEmailLang['footer_00'] . "</td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center'><a href='http://www.facebook.com/beebrite'><img src='http://www.beebrite.com/img/email/facebook.png' style='border:0px;'></a>&nbsp;<a href='https://twitter.com/beebrite_'><img src='http://www.beebrite.com/img/email/twitter.png' style='border:0px;'></a>&nbsp;<a href='http://pinterest.com/wearebeebrite/'><img src='http://www.beebrite.com/img/email/pinterest.png' style='border:0px;'></a></td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_01'] . " " . strtolower(mysql_result($rstUsrData,0,1)) . "</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:10px'>" . $arrEmailLang['footer_02'] . " <a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_03'] . "</a></td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:10px'>&copy;2012 Beebrite SL.&nbsp;|&nbsp;" . $arrEmailLang['footer_04'] . "</td></tr>";
				$message .= "	<tr><td style='text-align:center;font-size:10px'><a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_05'] . "</a>&nbsp;|&nbsp;<a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>" . $arrEmailLang['footer_06'] . "</a></td></tr>";
				$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
				$message .= "</table>";
				$message .= "</body>";
				$message .= "</html>";
				$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
				$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=utf-8\r\n";
				$mail_sent = @mail($to,$subject,$message,$headers);
				unset($arrStickerLang);
				unset($arrEmailLang);
				unset($rstUsrData);
			};
			unset($rstSend);
		};
	};

	function pushNotification($lintType, $lintUser1, $lintUser2, $lintSticker){
		global $uLang;
		$strDate = date("Y/m/d H:i:s");
		if($lintUser2=="none"){
			$lintUser2 = "NULL";
			$strSql = "INSERT INTO tbl_usr_activity (intType, intUser1, intUser2, intSticker, intRead, dteTimeStamp) VALUES (" . $lintType . "," . $lintUser1 . "," . $lintUser2 . "," . $lintSticker . ",0,'" . $strDate . "');";
		}else{
			$strSql = "INSERT INTO tbl_usr_activity (intType, intUser1, intUser2, intSticker, intRead, dteTimeStamp) VALUES (" . 7 . "," . $lintUser2 . "," . $lintUser1 . "," . $lintSticker . ",0,'" . $strDate . "');";
		};
		mysql_query($strSql);
	};
?>