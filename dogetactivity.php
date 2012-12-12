<?php
				include('inc/open_conn.php');
				include('inc/func.php');
				
				$uLang = $_GET['uLang'];
				$arrLang = getLangArray('dogetactivity.php',$uLang);
				$arrLangStk = getLangArray('STICKERS',$uLang);

				$arrIds = "";
				$arrLis = "";				
				
				$strSql = "SELECT a.*, UNIX_TIMESTAMP(a.dteTimeStamp) as UNIXDate FROM tbl_usr_activity a";
				switch ($_GET['sActPage']){
					case 'Friends':
						$strSql .= ", tbl_usr_friendship b WHERE b.intUser = " . $_GET['uId'] . " AND a.intUser1 = b.intFriend AND a.intType IN (1,2,3,4,5) ";
						break;
					case 'Me':
						$strSql .= " WHERE a.intUser1 = " . $_GET['uId'] . " ";
						break;
					case 'All':
						$strSql .= " WHERE a.intUser1 <> " . $_GET['uId'] . " AND intType IN (1,2,3,4,5) ";
						break;
				}
				$strSql .= "AND a.intId > " . $_GET['iLast'] . " ORDER BY dteTimeStamp DESC, intId DESC LIMIT " . $_GET['iRecords'] . ";";
				
				$rstAct = mysql_query($strSql);
				
				$jsnDataR = array(
					'iLast'=>'',
					'sLi'=>array()
					);

				if(mysql_num_rows($rstAct)==0){
					$jsnDataR['iLast'] = $_GET['iLast'];
				}else{
					$jsnDataR['iLast'] = mysql_result($rstAct,0,0);
				};

				for($intIx=0;$intIx<mysql_num_rows($rstAct);$intIx++){
					$strSql = "SELECT strNick FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,2) . ";";
					$rstTmp = mysql_query($strSql);
					$strUser1 = mysql_result($rstTmp,0,0);
					unset($rstTmp);
	
					if(is_null(mysql_result($rstAct,$intIx,3))){
						$strUser2 = "";
					}else{
						$strSql = "SELECT strNick FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,3) . ";";
						$rstTmp = mysql_query($strSql);
						$strUser2 = mysql_result($rstTmp,0,0);
						unset($rstTmp);
					};
					switch(mysql_result($rstAct,$intIx,1)){
						case 1:
							$strActResponse = "<li id='liAct_" . mysql_result($rstAct,$intIx,0) . "' style='display:none'>";
							$strActResponse .= "<div style='height:48px;padding:0px 0px 0px 10px; width:246px;cursor:pointer' onclick='window.location = \"" . $strUser1 . "\"'>";
							$strActResponse .= "<div style='height:48px; width:48px; margin:0px 10px 0px 0px; background-image:url(img/bee_act.png); background-position:center center; background-repeat:no-repeat; background-size:cover; float:left'></div>";
							$strActResponse .= "<div style='float:left; text-align:left; vertical-align:middle; width:188px; font-family:Tahoma; font-size:12px; color:#505050; ' >";
							$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,2) . ";";
							$rstData = mysql_query($strSql);
							if(mysql_result($rstData,0,2)==$_GET['uId']){
								$strActResponse .= $arrLang['1_me'] . " <a href='profile.php?s=1&vId=" . mysql_result($rstData,0,2) . "' style='font-family:Tahoma; font-size:12px; color:#505050; text-decoration:none'>" . mysql_result($rstData,0,0) . "</a>";
							}else{
								$strActResponse .= "<a href='profile.php?s=1&vId=" . mysql_result($rstData,0,2) . "' style='font-family:Tahoma; font-size:12px; color:#505050; text-decoration:none'>" . mysql_result($rstData,0,0) . "</a> " . $arrLang['1_else'];
							};
							unset($rstData);
							$strActResponse .= "		<br />";
							$strActResponse .= "		<span style=' font-family:Tahoma; font-size:10px; color:#A0A0A0'>" . hace(mysql_result($rstAct,$intIx,7),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
							$strActResponse .= "	</div>";
							$strActResponse .= "	<br style='clear:both' />";
							$strActResponse .= "</div>";
							$strActResponse .= "</li>";
							array_push($jsnDataR['sLi'], $strActResponse);
							break;
						case 2:
							$strActResponse = "<li id='liAct_" . mysql_result($rstAct,$intIx,0) . "' style='display:none'>";
							$strActResponse .= "<div style='height:48px;padding:0px 0px 0px 10px; width:246px;cursor:pointer' onclick='window.location = \"" . $strUser1 . "\"'>";
							$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId, strUsrPic FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,2) . ";";
							$rstData = mysql_query($strSql);
							$strActResponse .= "<div style='height:48px; width:48px; margin:0px 10px 0px 0px; background-image:url(" . mysql_result($rstData,0,3) ."); background-position:center center; background-repeat:no-repeat; background-size:cover; float:left'></div>";
							$strActResponse .= "<div style='float:left; text-align:left; vertical-align:middle; width:188px; font-family:Tahoma; font-size:12px; color:#505050; ' >";
							if($_GET['sActPage']=='Me'){
								unset($rstData);
								$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId, strUsrPic FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,3) . ";";
								$rstData = mysql_query($strSql);
								$strActResponse .= $arrLang['2_me'] . " <a href='profile.php?vId=" . mysql_result($rstData,0,2) . "' style='font-family:Tahoma; font-size:12px; color:#505050; text-decoration:none'>" . mysql_result($rstData,0,0) . "</a>";
							}else{
								$strActResponse .= "<a href='profile.php?vId=" . mysql_result($rstData,0,2) . "' style='font-family:Tahoma; font-size:12px; color:#505050; text-decoration:none'>" . mysql_result($rstData,0,0) . "</a> " . $arrLang['2_else'];
								unset($rstData);
								$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId, strUsrPic FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,3) . ";";
								$rstData = mysql_query($strSql);
								$strActResponse .= " <a href='profile.php?vId=" . mysql_result($rstData,0,2) . "' style='font-family:Tahoma; font-size:12px; color:#505050; text-decoration:none'>" . mysql_result($rstData,0,0) . "</a>";
							};
							unset($rstData);
							$strActResponse .= "		<br />";
							$strActResponse .= "		<span style=' font-family:Tahoma; font-size:10px; color:#A0A0A0'>" . hace(mysql_result($rstAct,$intIx,7),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
							$strActResponse .= "	</div>";
							$strActResponse .= "	<br style='clear:both' />";
							$strActResponse .= "</div>";
							$strActResponse .= "</li>";
							array_push($jsnDataR['sLi'], $strActResponse);
							unset($rstData);
							break;
						case 3:
							$strActResponse = "<li id='liAct_" . mysql_result($rstAct,$intIx,0) . "' style='display:none'>";
							$strActResponse .= "<div style='height:48px;padding:0px 0px 0px 10px; width:246px;cursor:pointer' onclick='window.location = \"" . $strUser1 . "=" . mysql_result($rstAct,$intIx,4) . "\"'>";
							$strActResponse .= "<div style='height:48px; width:48px; margin:0px 10px 0px 0px; background-image:url(img/stickers/" . mysql_result($rstAct,$intIx,4) . "_48.png); background-position:center center; background-repeat:no-repeat; background-size:cover; float:left'></div>";
							$strActResponse .= "<div style='float:left; text-align:left; vertical-align:middle; width:188px; font-family:Tahoma; font-size:12px; color:#505050; ' >";
							if($_GET['sActPage']=='Me'){
								$strActResponse .= $arrLang['3_win_me'];
							}else{
								$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,2) . ";";
								$rstData = mysql_query($strSql);
								$strActResponse .= "<strong>" . mysql_result($rstData,0,0) . "</strong> ";
								unset($rstData);
								$strActResponse .= $arrLang['3_win'];
							};
							$strActResponse .= " <strong>" . $arrLangStk[mysql_result($rstAct,$intIx,4) . '_N'] . "</strong>";
							$strActResponse .= "		<br />";
							$strActResponse .= "		<span style=' font-family:Tahoma; font-size:10px; color:#A0A0A0'>" . hace(mysql_result($rstAct,$intIx,7),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
							$strActResponse .= "	</div>";
							$strActResponse .= "	<br style='clear:both' />";
							$strActResponse .= "</div>";
							$strActResponse .= "</li>";
							array_push($jsnDataR['sLi'], $strActResponse);
							break;
						case 4:
							$strActResponse = "<li id='liAct_" . mysql_result($rstAct,$intIx,0) . "' style='display:none'>";
							$strActResponse .= "<div style='height:48px;padding:0px 0px 0px 10px; width:246px;cursor:pointer' onclick='window.location = \"" . $strUser1 . "=" . mysql_result($rstAct,$intIx,4) . "\"'>";
							$strActResponse .= "<div style='height:48px; width:48px; margin:0px 10px 0px 0px; background-image:url(img/stickers/" . mysql_result($rstAct,$intIx,4) . "_48.png); background-position:center center; background-repeat:no-repeat; background-size:cover; float:left'></div>";
							$strActResponse .= "<div style='float:left; text-align:left; vertical-align:middle; width:188px; font-family:Tahoma; font-size:12px; color:#505050; ' >";
							if($_GET['sActPage']=='Me'){
								$strActResponse .= $arrLang['4_peel_me'];
							}else{
								$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,2) . ";";
								$rstData = mysql_query($strSql);
								$strActResponse .= "<strong>" . mysql_result($rstData,0,0) . "</strong> ";
								unset($rstData);
								$strActResponse .= $arrLang['4_peel'];
							};
							$strActResponse .= " <strong>" . $arrLangStk[mysql_result($rstAct,$intIx,4) . '_N'] . "</strong>";
							if(!is_null(mysql_result($rstAct,$intIx,3))){
								$strActResponse .= $arrLang['4_peel2'] . " ";
								$strSql = "SELECT CONCAT(strName,' ',SUBSTR(strLastName,1,1),'.') as User, strNick, intId FROM cat_users WHERE intId = " . mysql_result($rstAct,$intIx,3) . ";";
								$rstData = mysql_query($strSql);
								$strActResponse .= "<strong>" . mysql_result($rstData,0,0) . "</strong> ";
								unset($rstData);
							};
							$strActResponse .= "		<br />";
							$strActResponse .= "		<span style=' font-family:Tahoma; font-size:10px; color:#A0A0A0'>" . hace(mysql_result($rstAct,$intIx,7),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']) . "</span>";
							$strActResponse .= "	</div>";
							$strActResponse .= "	<br style='clear:both' />";
							$strActResponse .= "</div>";
							$strActResponse .= "</li>";
							array_push($jsnDataR['sLi'], $strActResponse);
							break;
						case 5:
							$strActResponse = "<li id='liAct_" . mysql_result($rstAct,$intIx,0) . "' style='display:none'>";
							$strActResponse .= "</li>";
							array_push($jsnDataR['sLi'], $strActResponse);
							break;
					};
				};
				
				echo json_encode($jsnDataR);
				
				unset($rstAct);
				unset($arrLangStk);
				unset($arrLang);
				mysql_close($con);
?>
