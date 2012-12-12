<?php
	include('inc/open_conn.php');
	include('inc/func.php');
	
	$arrLang = getLangArray('index.php',$_GET['uLang']);
				
	$strSql = "SELECT intType, intUser1, intUser2, intSticker, dteTimeStamp, UNIX_TIMESTAMP(dteTimeStamp) as UNIXDate, intId FROM tbl_usr_activity WHERE intType IN (1,2,3,4,5) AND intId > " . $_GET['iLast'] . " ORDER BY dteTimeStamp DESC LIMIT 1;";
	$rstAct = mysql_query($strSql);
	if(mysql_num_rows($rstAct)==0){
		$iLastAct = $_GET['iLast'];
		$strLI = "";
	}else{
		$iLastAct = mysql_result($rstAct,0,6);
		$strSql = "SELECT strUsrPic, CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as strName, strNick FROM cat_users WHERE intId = " . mysql_result($rstAct,0,1) . ";";
		$rstUsr1 = mysql_query($strSql);
		$strSql = "SELECT " . $uLang . " FROM cat_lang WHERE strPage = 'STICKERS' AND strTag = '" . mysql_result($rstAct,0,3) . "_N';";
		$rstStk = mysql_query($strSql);
	    $strLI = "<li id=\"actfee_" . 10 . "\">";
		switch(mysql_result($rstAct,0,0)){
			case 1:
	            $strLI .= "<a class=\"cont\" href=\"" . mysql_result($rstUsr1,0,2) . "\" style=\"background-image: url('" . mysql_result($rstUsr1,0,0) . "');\"></a>";
	            $strLI .= "<span class=\"hout\"><a href=\"" . mysql_result($rstUsr1,0,2) . "\">" . mysql_result($rstUsr1,0,1) . "</a> " . $arrLang['1_1'];
	            $strLI .= "<span class=\"time\"> " . hace(mysql_result($rstAct,0,5),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
				$strLI .= "</span>";
				$strLI .= "<img src=\"http://www.beebrite.com/img/bee_act.png\" width=\"48\" height=\"48\" style=\"margin:1px;\" />";
				break;
			case 2:
	            $strLI .= "<a class=\"cont\" href=\"" . mysql_result($rstUsr1,0,2) . "\" style=\"background-image: url('" . mysql_result($rstUsr1,0,0) . "');\"></a>";
	            $strLI .= "<span class=\"hout\"><a href=\"" . mysql_result($rstUsr1,0,2) . "\">" . mysql_result($rstUsr1,0,1) . "</a>";
				$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as strName, strNick, strUsrPic FROM cat_users WHERE intId = " . mysql_result($rstAct,0,2) . ";";
				$rstUsr2 = mysql_query($strSql);
				$strLI .= " " . str_replace("&&user&&","<a href=\"" . mysql_result($rstUsr2,0,1) . "\">" . mysql_result($rstUsr2,0,0) . "</a>",$arrLang['2_1']);
	            $strLI .= "<span class=\"time\"> " . hace(mysql_result($rstAct,0,5),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
	            $strLI .= "</span>";
	            $strLI .= "<a class=\"cont\" href=\"" . mysql_result($rstUsr2,0,1) . "\" style=\"background-image: url('" . mysql_result($rstUsr2,0,2) . "');\"></a>";
				unset($rstUsr2);
				break;
			case 3:
	            $strLI .= "<a class=\"cont\"  href=\"" . mysql_result($rstUsr1,0,2) . "\" style=\"background-image: url('" . mysql_result($rstUsr1,0,0) . "');\"></a>";
	            $strLI .= "<span class=\"hout\"><a href=\"" . mysql_result($rstUsr1,0,2) . "\">" . mysql_result($rstUsr1,0,1) . "</a> " . str_replace("&&sticker&&"," <a href=\"" . mysql_result($rstUsr1,0,2) . "=" . mysql_result($rstAct,0,3) . "\">" . mysql_result($rstStk,0,0) . "</a>",$arrLang['3_1']);
	            $strLI .= "<span class=\"time\"> " . hace(mysql_result($rstAct,0,5),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
				$strLI .= "</span>";
				$strLI .= "<a class=\"cont\" href=\"" . mysql_result($rstUsr1,0,2) . "=" . mysql_result($rstAct,0,3) . "\" style=\"background-image: url('http://beebrite.com/img/stickers/" . mysql_result($rstAct,0,3) . "_48.png');\"></a>";
				break;
			case 4:
				$strLI .= "<a class=\"cont\"  href=\"" . mysql_result($rstUsr1,0,2) . "\" style=\"background-image: url('" . mysql_result($rstUsr1,0,0) . "');\"></a>";
				$strLI .= "<span class=\"hout\"><a href=\"" . mysql_result($rstUsr1,0,2) . "\">" . mysql_result($rstUsr1,0,1) . "</a> " . str_replace("&&sticker&&"," <a href=\"" . mysql_result($rstUsr1,0,2) . "=" . mysql_result($rstAct,0,3) . "\">" . mysql_result($rstStk,0,0) . "</a>",$arrLang['3_1']);
				if(!is_null(mysql_result($rstAct,0,2))){
					$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as strName, strNick FROM cat_users WHERE intId = " . mysql_result($rstAct,0,2) . ";";
					$rstUsr2 = mysql_query($strSql);
					$strLI .= " " . str_replace("&&user&&","<a href=\"" . mysql_result($rstUsr2,0,1) . "\">" . mysql_result($rstUsr2,0,0) . "</a>",$arrLang['4_2']);
					unset($rstUsr2);
				}
	            $strLI .= "<span class=\"time\"> " . hace(mysql_result($rstAct,0,5),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
				$strLI .= "</span>";
				$strLI .= "<a  class=\"cont\" href=\"" . mysql_result($rstUsr1,0,2) . "=" . mysql_result($rstAct,0,3) . "\" style=\"background-image: url('http://beebrite.com/img/stickers/" . mysql_result($rstAct,0,3) . "_48.png');\"></a>";
				break;
			case 5:
				break;
		};
		$strLI .= "</li>";
		unset($rstUsr1);
		unset($rstStk);
	};
	unset($rstAct);
	unset($arrLang);
	mysql_close($con);
	$jsnDataR = array('iLast'=>$iLastAct,'sLi'=>$strLI);
	echo json_encode($jsnDataR);
?>