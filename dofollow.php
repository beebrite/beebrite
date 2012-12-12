<?php
require_once('inc/open_conn.php');
include('inc/func.php');

$strSql = "SELECT strUsrLang FROM cat_users WHERE intId = " . $_POST['uFollow'] . ";";
$rstLang = mysql_query($strSql);
$uGLang = mysql_result($rstLang,0,0);
unset($rstLang);

if ($_POST['action'] == 0)
{
	$strSql = "INSERT INTO tbl_usr_friendship (intUser, intFriend) VALUES (" . $_POST['uId'] . "," . $_POST['uFollow'] . ");";
	mysql_query($strSql);
	$strSql = "INSERT INTO tbl_usr_activity (intType,intUser1,intUser2,intRead,dteTimeStamp) VALUES (2," . $_POST['uId'] . "," . $_POST['uFollow'] . ",0,NOW());";
	mysql_query($strSql);
	$strSql = "INSERT INTO tbl_usr_activity (intType,intUser2,intUser1,intRead,dteTimeStamp) VALUES (6," . $_POST['uId'] . "," . $_POST['uFollow'] . ",0,NOW());";
	mysql_query($strSql);
	$uId = $_POST['uFollow'];
	$vId = $_POST['uId'];
	$strSql = "SELECT * FROM cat_users WHERE intId = " . $uId . ";";
	$rstUsrData = mysql_query($strSql);
	$strSql = "SELECT * FROM cat_users WHERE intId = " . $vId . ";";
	$rstUsrDataV = mysql_query($strSql);
	$uLang = mysql_result($rstUsrData,0,28);
	$arrEmailLang = getLangArray('EMAIL',$uLang);
	$to = mysql_result($rstUsrData,0,1);
	$subject = str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrDataV,0,3))),$arrEmailLang["subject_follow"]);
	$message = '<html>';
	$message .= '<head>';
	$message .= '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
	$message .= '</head>';
	$message .= '<body style=" background-color:#F0F0F0; font-family:Tahoma,Sans-serif; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; ">';
	$message .= '<table style="margin:20px auto 0px auto;border-spacing:0px 0px;">';
	$message .= '<tr><td style="text-align:center;"><img src="http://www.beebrite.com/img/email/header.png" alt="Beebrite" /></td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:28px;">' . $arrEmailLang["follow_01"] . ' '. ucwords(strtolower(mysql_result($rstUsrData,0,3))) . '!</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:13px;"><a style="text-decoration:none; font-weight:bold; color:#666666; " href="http://www.beebrite.com/' . mysql_result($rstUsrDataV,0,5) . '">' . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . ' ' . substr(strtoupper(mysql_result($rstUsrDataV,0,4)),0,1) . '.</a> ' . $arrEmailLang["follow_02"] . ' <a style="text-decoration:none; font-weight:bold; color:#666666; " href="http://www.beebrite.com/' . mysql_result($rstUsrDataV,0,5) . '">' . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . ' ' . substr(strtoupper(mysql_result($rstUsrDataV,0,4)),0,1) . '.</a> ' . $arrEmailLang["follow_03"] . '</td></tr>';
	$message .= '<tr><td style="height:40px;">&nbsp;</td></tr>';
	$message .= '<tr><td style="height:96px; border:1px #C8C8C8 solid; padding:0px 0px 0px 0px;">';
	$message .= '<table style="border:0px;border-spacing:0px 0px;">';
	$message .= '<tr><td style="width:596px;height:94px; border:2px #EBEBEB solid; background-color:#FFFFFF; padding:0px">';
	$message .= '<table style="border:0px;border-spacing:0px 0px;">';
	$message .= '<tr>';
	$message .= '<td style="border:0px;border-spacing:0px 0px; height:94px; padding:0px; vertical-align:top "><img src="' . str_replace('picture?type=large','picture?type=square',mysql_result($rstUsrDataV,0,22)) . '" style="width:94px; height:94px; border:0px; margin-bottom:-10px; "></td>';
	$message .= '<td style="font-size:20px;width:480px;padding-left:20px;">';
	$message .= '<a style="text-decoration:none; font-weight:bold; color:#505050; font-size:13px; " href="http://www.beebrite.com/' . mysql_result($rstUsrDataV,0,5) . '">' . ucwords(strtolower(mysql_result($rstUsrDataV,0,3))) . ' ' . ucwords(strtolower(mysql_result($rstUsrDataV,0,4))) . '</a>';
	$strSql = 'SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = ' . $vId . ';';
	$rstpFollow = mysql_query($strSql);
	$message .= ' <span style="font-size:13px; color:#A0A0A0">' . $arrEmailLang["follow_05"] . ' ' . number_format(mysql_result($rstpFollow, 0, 0),0,'.',',') . ' ' . $arrEmailLang["follow_06"] . ' ';
	unset($rstpFollow);
	$strSql = 'SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = ' . $vId . ';';
	$rstpFollow = mysql_query($strSql);
	$message .= number_format(mysql_result($rstpFollow, 0, 0),0,'.',',') . '<br /></span><div>';
	unset($rstpFollow);
	$message .= '<img src="http://www.beebrite.com/img/email/level.png" valign="middle"> ' . number_format(mysql_result($rstUsrDataV,0,10),0,'.',',') . '&nbsp;&nbsp;&nbsp;';
	$message .= '<img src="http://www.beebrite.com/img/email/bbi.png" valign="middle"> ' . number_format(mysql_result($rstUsrDataV,0,13),0,'.',',') . '&nbsp;&nbsp;&nbsp;';
	$message .= '<img src="http://www.beebrite.com/img/email/ms.png" valign="middle"> ' . number_format(mysql_result($rstUsrDataV,0,12),0,'.',',') . '';
	$message .= '</div></td>';
	$message .= '</tr>';
	$message .= '</table>';
	$message .= '</td></tr>';
	$message .= '</table>';
	$message .= '</td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$strSql = 'SELECT intSticker FROM tbl_usr_stickers WHERE intUser = ' . $vId . ' ORDER BY dteTimeStamp DESC LIMIT 18;';
	$rstStickers = mysql_query($strSql);
	if(mysql_num_rows($rstStickers)!=0){
		$message .= '<tr><td style="text-align:center;font-size:20px;">' . str_replace('&&user&&',ucwords(strtolower(mysql_result($rstUsrDataV,0,3))),$arrEmailLang["follow_04"]) . '</td></tr>';
		$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
		$message .= '<tr><td style="display:inline-block; text-align:center; width:598px; ">';
		$intCStk = 1;
		while($objStickers=mysql_fetch_array($rstStickers)){
			$message .= '<img src="http://www.beebrite.com/img/stickers/' . $objStickers["intSticker"] . '_160.png" style="margin:5px 5px 5px 5px;">';
			if($intCStk<3){
				$intCStk++;
			}else{
				$message .= '<br />';
				$intCStk=1;
			};
		}
		unset($rstStickers);
		$message .= '</td></tr>';
		$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	};
	$message .= '<tr><td style="text-align:center;font-size:17px;">' . $arrEmailLang["footer_00"] . '</td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$message .= '<tr><td style="text-align:center"><a href="http://www.facebook.com/beebrite"><img src="http://www.beebrite.com/img/email/facebook.png" style="border:0px;"></a>&nbsp;<a href="https://twitter.com/beebrite_"><img src="http://www.beebrite.com/img/email/twitter.png" style="border:0px;"></a>&nbsp;<a href="http://pinterest.com/wearebeebrite/"><img src="http://www.beebrite.com/img/email/pinterest.png" style="border:0px;"></a></td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:10px">' . $arrEmailLang["footer_01"] . ' ' . strtolower(mysql_result($rstUsrData,0,1)) . '</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:10px">' . $arrEmailLang["footer_02"] . ' <a href="http://www.beebrite.com" style="color:#505050; font-weight:bold; text-decoration:none">' . $arrEmailLang["footer_03"] . '</a></td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:10px">&copy;2012 Beebrite SL.&nbsp;|&nbsp;' . $arrEmailLang["footer_04"] . '</td></tr>';
	$message .= '<tr><td style="text-align:center;font-size:10px"><a href="http://www.beebrite.com" style="color:#505050; font-weight:bold; text-decoration:none">' . $arrEmailLang["footer_05"] . '</a>&nbsp;|&nbsp;<a href="http://www.beebrite.com" style="color:#505050; font-weight:bold; text-decoration:none">' . $arrEmailLang["footer_06"] . '</a></td></tr>';
	$message .= '<tr><td style="height:20px;">&nbsp;</td></tr>';
	$message .= '</table>';
	$message .= '</body>';
	$message .= '</html>';
	$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
	$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$mail_sent = @mail($to,$subject,$message,$headers);
	unset($arrEmailLang);
	unset($rstUsrData);
	
	$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $_POST['uFollow'] . ";";
	$rstStkF = mysql_query($strSql);
	/*### 149 ###*/
	$strSql = "SELECT COUNT(*), intFriend FROM tbl_usr_friendship WHERE intFriend <> " . $_POST['uFollow'] . " GROUP BY intFriend ORDER BY 1 DESC LIMIT 1;";
	$rstEval = mysql_query($strSql);
	if(mysql_result($rstEval,0,0)<mysql_result($rstStkF,0,0)){addSticker(149,true);};
	unset($rstEval);
	/*### 150 ###*/
	if(mysql_result($rstStkF,0,0)>19){addSticker(150,false);};	
	/*### 151 ###*/
	if(mysql_result($rstStkF,0,0)>99){addSticker(151,false);};	
	/*### 152 ###*/
	if(mysql_result($rstStkF,0,0)>499){addSticker(152,false);};	
	/*### 153 ###*/
	if(mysql_result($rstStkF,0,0)>999){addSticker(153,false);};	
	unset($rstStkF);
}
else
{
	$strSql = "DELETE FROM tbl_usr_friendship WHERE intUser = " . $_POST['uId'] . " AND intFriend = " . $_POST['uFollow'] . ";";
	mysql_query($strSql);
};
mysql_close($con);

	function addSticker($intSticker, $blnPeel){
		global $uGLang;
		$uId = $_POST['uFollow'];
		$uLang = $uGLang;
		$intRecId = -1;
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
		$uId = $_POST['uFollow'];
		global $uGLang;
		$uLang = $uGLang;
		$to = '';
		$subject = '';
		$message = '';
		$headers = '';
		
		if($blnPeel){
			if($intToUser==''){
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
			}else{
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
		}else{
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
	};

	function pushNotification($lintType, $lintUser1, $lintUser2, $lintSticker){
		global $uGLang;
		$uLang = $uGLang;
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