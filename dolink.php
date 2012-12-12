<?php
require_once('inc/open_conn.php');
include('inc/func.php');

$strSql = "UPDATE cat_users SET ";
if ($_GET['strNet'] == 'FB')
{
	$strSql .= "intFBId = " . $_GET['nID'] . ", strFBEMail = '" . $_GET['nEmail'] . "', strFBScreenmail = '" . $_GET['nNName'] . "' ";
}
else
{
	$strSql .= "intTWId = " . $_GET['intTWId'] . ", strTWScreenName = '" . $_GET['strTWScreenName'] . "', strTWUser_Token = '" . $_GET['strTWUser_Token'] . "', strTWUser_Secret = '" . $_GET['strTWUser_Secret'] . "' ";
};
$strSql .= "WHERE intID = " . $_GET['uId'] . ";";
mysql_query($strSql);

if ($_GET['strNet'] == 'TW')
{
	$strSql = "SELECT COUNT(*) FROM tbl_usr_stickers WHERE intSticker = 159 AND intUser = " . $_GET['uId'] . ";";
	$rstSticker = mysql_query($strSql);
	if(mysql_result($rstSticker,0,0)==0){
		$strSql = "INSERT INTO tbl_usr_stickers (intUser, intSticker, dteTimeStamp, intGame, intLast) VALUES (" . $_GET['uId'] . ",159,NOW(),-1,1);";
		mysql_query($strSql);
		$strSql = "INSERT INTO tbl_usr_activity (intType, intUser1, intSticker, intRead, dteTimeStamp) VALUES (3," . $_GET['uId'] . ",159,0,'" . date("Y/m/d H:i:s") . "');";
		mysql_query($strSql);
		$strSql = "SELECT intNotifications02 FROM tbl_usr_settings WHERE intUser = " . $_GET['uId'] . ";";
		$rstSend = mysql_query($strSql);
		if(mysql_result($rstSend,0,0)==1){
			$strSql = "SELECT * FROM cat_users WHERE intId = " . $_GET['uId'] . ";";
			$rstUsrData = mysql_query($strSql);
			$arrEmailLang = getLangArray('EMAIL',$_GET['uLang']);
			$arrStickerLang = getLangArray('STICKERS',$_GET['uLang']);
			$to = mysql_result($rstUsrData,0,1);
			$subject = str_replace("&&sticker&&",$arrStickerLang['159_N'],$arrEmailLang['sticker_01_subject']);
			$message = "<html>";
			$message .= "<head>";
			$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
			$message .= "<title>" . str_replace("&&sticker&&",$arrStickerLang['159_N'],$arrEmailLang['sticker_01_subject']) . "</title>";
			$message .= "</head>";
			$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
			$message .= "<table style='margin:20px auto 0px auto;border-spacing:0px 0px;'>";
			$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
			$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
			$message .= "	<tr><td style='text-align:center;font-size:28px;'>" . str_replace("&&user&&",ucwords(strtolower(mysql_result($rstUsrData,0,3))),$arrEmailLang['sticker_01_01']) . "</td></tr>";
			$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . str_replace("&&sticker&&",$arrStickerLang['159_N'],$arrEmailLang['sticker_01_02']) . "</td></tr>";
			$message .= "	<tr><td style='height:40px;'>&nbsp;</td></tr>";
			$message .= "	<tr><td style='text-align:center;'><img src='http://www.beebrite.com/img/stickers/159_370.png'" . $arrEmailLang['footer_00'] . "</td></tr>";
			$message .= "	<tr><td style='height:20px;'>&nbsp;</td></tr>";
			$message .= "	<tr><td style='text-align:center;font-size:13px;'>" . $arrStickerLang['159_D'] . "</td></tr>";
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
	unset($rstSticker);
};

mysql_close($con);
?>