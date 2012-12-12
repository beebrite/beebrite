<?php
require_once('inc/open_conn.php');
include('inc/func.php');

	$uId = $_GET['uId'];
	$gId = $_GET['gId'];
	$uLang = $_GET['uLang'];
	
	$arrStickersLang = getLangArray('STICKERS',$uLang);

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
			'gRecLevel'=>'',
			'gRecPoints'=>'',
			'gRecPoints'=>'',
			'gRecBBi'=>'',
			'gArray'=>array()),
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




	$strSql = "SELECT a.intId, a.strUsrPic, a.strName, a.strLastName, a.strNick, a.strUsrLang, b.intOthers01, a.intLevel, a.intPoints, a.intTime, a.intBBI FROM cat_users a, tbl_usr_settings b WHERE a.intId = " . $uId . " AND a.intId = b.intUser;";
	$rstJsonData = mysql_query($strSql);
	$jsnDataR['uData']['uId'] = mysql_result($rstJsonData,0,0);
	$jsnDataR['uData']['uPic'] = mysql_result($rstJsonData,0,1);
	$jsnDataR['uData']['uName'] = mysql_result($rstJsonData,0,2);
	$jsnDataR['uData']['uLast'] = mysql_result($rstJsonData,0,3);
	$jsnDataR['uData']['uNick'] = mysql_result($rstJsonData,0,4);
	$jsnDataR['uData']['uLang'] = mysql_result($rstJsonData,0,5);
	$jsnDataR['uData']['uSound'] = mysql_result($rstJsonData,0,6);
	$jsnDataR['uData']['uLevel'] = mysql_result($rstJsonData,0,7);
	$jsnDataR['uData']['uPoints'] = mysql_result($rstJsonData,0,8);
	$jsnDataR['uData']['uMs'] = mysql_result($rstJsonData,0,9);
	$jsnDataR['uData']['uBBi'] = mysql_result($rstJsonData,0,10);
	unset($rstJsonData);

	$jsnDataR['tData']['tId'] = 0;
	$jsnDataR['tData']['tName'] = 0;
	$jsnDataR['tData']['tType'] = 2;
	$jsnDataR['tData']['tSession'] = "";

	$strSql = "SELECT strName FROM cat_games WHERE intId = " . $gId . ";";
	$rstJsonData = mysql_query($strSql);
	$jsnDataR['gData']['tId'] = $gId;
	$jsnDataR['gData']['tId'] = mysql_result($rstJsonData,0,0);
	unset($rstJsonData);
	$strSql = "SELECT IFNULL(MAX(intStats01),0), IFNULL(MAX(intStats02),0), IFNULL(MIN(intStats04),9999), IFNULL(MAX(intStats00),0), IFNULL(MAX(intStats03),0) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intGame = " . $gId . " AND intStatus = 1;";
	$rstJsonData = mysql_query($strSql);
	$jsnDataR['gData']['gRecLevel'] = intval(mysql_result($rstJsonData,0,0));
	$jsnDataR['gData']['gRecPoints'] = intval(mysql_result($rstJsonData,0,4));
	$jsnDataR['gData']['gRecMs'] = intval(mysql_result($rstJsonData,0,2));
	$jsnDataR['gData']['gRecBBi'] = intval(mysql_result($rstJsonData,0,3));
	$jsnDataR['gData']['gRecDur'] = intval(mysql_result($rstJsonData,0,1));
	unset($rstJsonData);
	array_push($jsnDataR['gData']['gArray'], array('gPic'=>'games/img/gm' . $gId . '_big.png', 'gStatus'=>'1'));
	array_push($jsnDataR['gData']['gArray'], array('gPic'=>'-1', 'gStatus'=>'-1'));

	$strSql = "SELECT intId FROM cat_stickers WHERE strOrigin = 'G' AND intTarget = " . $gId . " AND blnPeel = 1 ORDER BY intId;";
	$rstJsonData = mysql_query($strSql);
	while ($objJsonData = mysql_fetch_array($rstJsonData))
	{
		$strSql = "SELECT intGame FROM tbl_usr_stickers WHERE intSticker = " . $objJsonData['intId'] . " ORDER BY dteTimeStamp DESC LIMIT 1;";
		$rstPeel = mysql_query($strSql);
		if(mysql_num_rows($rstPeel)==0){
			array_push($jsnDataR['sData'], array('sID'=>$objJsonData['intId'],'sName'=>$arrStickersLang[$objJsonData['intId'] . '_N'],'sDesc'=>$arrStickersLang[$objJsonData['intId'] . '_D'],'sPic'=>'img/stickers/' . $objJsonData['intId'] . '_48.png','sPeel'=>'1','sUserName'=>'','sUserLast'=>'','sPoints'=>'0'));
		}else{
			$strSql = "SELECT a.strName, a.strLastName, IFNULL(b.intStats03,0) FROM cat_users a, tbl_usr_trainings b WHERE a.intId = b.intUser AND b.intId = " . mysql_result($rstPeel,0,0) . ";";
			$rstOwn = mysql_query($strSql);
			array_push($jsnDataR['sData'], array('sID'=>$objJsonData['intId'],'sName'=>$arrStickersLang[$objJsonData['intId'] . '_N'],'sDesc'=>$arrStickersLang[$objJsonData['intId'] . '_D'],'sPic'=>'img/stickers/' . $objJsonData['intId'] . '_48.png','sPeel'=>'1','sUserName'=>mysql_result($rstOwn,0,0),'sUserLast'=>mysql_result($rstOwn,0,1),'sPoints'=>mysql_result($rstOwn,0,2)));
			unset($rstOwn);
		};
		unset($rstPeel);
	}
	array_push($jsnDataR['sData'], array('sId'=>'-1','sName'=>'-1','sDesc'=>'-1','sPic'=>'-1','sPeel'=>'-1','sUserName'=>'-1','sUserLast'=>'-1','sPoints'=>'-1'));
	unset($rstJsonData);

	echo json_encode($jsnDataR);

?>