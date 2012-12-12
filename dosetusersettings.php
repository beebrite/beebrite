<?php
require_once('inc/open_conn.php');

	switch ($_POST['strSettings']){
		case 'Share':
			$strSql = "UPDATE tbl_usr_settings SET ";
			$strSql .= "intShare01 = " . substr($_POST['strSettValues'],0,1) . ", ";
			$strSql .= "intShare02 = " . substr($_POST['strSettValues'],1,1) . ", ";
			$strSql .= "intShare03 = " . substr($_POST['strSettValues'],2,1) . ", ";
			$strSql .= "intShare04 = " . substr($_POST['strSettValues'],3,1) . ", ";
			$strSql .= "intShare05 = " . substr($_POST['strSettValues'],4,1) . ", ";
			$strSql .= "intShare06 = " . substr($_POST['strSettValues'],5,1) . " ";
			$strSql .= "WHERE intUser = " . $_POST['uId'] . ";";
			break;
		case 'Privacy':
			$strSql = "UPDATE tbl_usr_settings SET ";
			$strSql .= "intPrivacy01 = " . substr($_POST['strSettValues'],0,1) . ", ";
			$strSql .= "intPrivacy02 = " . substr($_POST['strSettValues'],1,1) . ", ";
			$strSql .= "intPrivacy03 = " . substr($_POST['strSettValues'],2,1) . ", ";
			$strSql .= "intPrivacy04 = " . substr($_POST['strSettValues'],3,1) . " ";
			$strSql .= "WHERE intUser = " . $_POST['uId'] . ";";
			break;
		case 'Notifications':
			$strSql = "UPDATE tbl_usr_settings SET ";
			$strSql .= "intNotifications01 = " . substr($_POST['strSettValues'],0,1) . ", ";
			$strSql .= "intNotifications02 = " . substr($_POST['strSettValues'],1,1) . ", ";
			$strSql .= "intNotifications03 = " . substr($_POST['strSettValues'],2,1) . ", ";
			$strSql .= "intNotifications04 = " . substr($_POST['strSettValues'],3,1) . ", ";
			$strSql .= "intNotifications05 = " . substr($_POST['strSettValues'],4,1) . ", ";
			$strSql .= "intNotifications06 = " . substr($_POST['strSettValues'],5,1) . ", ";
			$strSql .= "intNotifications07 = " . substr($_POST['strSettValues'],6,1) . ", ";
			$strSql .= "intNotifications08 = " . substr($_POST['strSettValues'],7,1) . ", ";
			$strSql .= "intNotifications09 = " . substr($_POST['strSettValues'],8,1) . ", ";
			$strSql .= "intNotifications10 = " . substr($_POST['strSettValues'],9,1) . ", ";
			$strSql .= "intNotifications11 = " . substr($_POST['strSettValues'],10,1) . ", ";
			$strSql .= "intNotifications12 = " . substr($_POST['strSettValues'],11,1) . ", ";
			$strSql .= "intNotifications13 = " . substr($_POST['strSettValues'],12,1) . " ";
			$strSql .= "WHERE intUser = " . $_POST['uId'] . ";";
			break;
		case 'Others':
			$strSql = "UPDATE tbl_usr_settings SET ";
			$strSql .= "intOthers01 = " . substr($_POST['strSettValues'],0,1) . " ";
			$strSql .= "WHERE intUser = " . $_POST['uId'] . ";";
			break;
		case 'User':
			$strSql = "UPDATE cat_users SET ";
			$strPhoto = str_replace('url(','',strtolower($_POST['sPic']));
			$strPhoto = str_replace(')','',$strPhoto);
			$strPhoto = str_replace('"','',$strPhoto);
			$strPhoto = str_replace("'","",$strPhoto);
			$strSql .= "strUsrPic = '" . $strPhoto . "', ";
			$strSql .= "strName = '" . ucwords(strtolower($_POST['sName'])) . "', ";
			$strSql .= "strLastName = '" . ucwords(strtolower($_POST['sLastName'])) . "', ";
			$strSql .= "strEmail = '" . strtolower($_POST['sEmail']) . "', ";
			$strSql .= "strGender = '" . $_POST['sGender'] . "', ";
			$strSql .= "strCity = '" . strtolower($_POST['sCity']) . "', ";
			$strSql .= "strCountry = '" . $_POST['sCountry'] . "' ";
			$strSql .= "WHERE intId = " . $_POST['uId'] . ";";
			break;
		case 'Nick':
			$strSql = "UPDATE cat_users SET ";
			$strSql .= "strNick = '" . strtolower($_POST['sNick']) . "' ";
			$strSql .= "WHERE intId = " . $_POST['uId'] . ";";
			break;
		case 'Pwd':
			$strSql = "UPDATE cat_users SET ";
			$strSql .= "strPassword = '" . strtolower($_POST['sPwd']) . "' ";
			$strSql .= "WHERE intId = " . $_POST['uId'] . ";";
			break;
	}
	mysql_query($strSql);
	mysql_close($con);
?>