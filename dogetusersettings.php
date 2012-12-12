<?php
include('inc/open_conn.php');
include('inc/func.php');

$strSql = "SELECT ";
switch ($_REQUEST['strSettings']){
	case 'Share':
		$strSql .= "intShare01, intShare02, intShare03, intShare04, intShare05, intShare06 FROM tbl_usr_settings WHERE intUser = ";
		break;
	case 'Privacy':
		$strSql .= "intPrivacy01, intPrivacy02, intPrivacy03, intPrivacy04 FROM tbl_usr_settings WHERE intUser = ";
		break;
	case 'Notifications':
		$strSql .= "intNotifications01, intNotifications02, intNotifications03, intNotifications04, intNotifications05, intNotifications06, intNotifications07, intNotifications08, intNotifications09, intNotifications10, intNotifications11, intNotifications12, intNotifications13 FROM tbl_usr_settings WHERE intUser = ";
		break;
	case 'Others':
		$strSql .= "intOthers01 FROM tbl_usr_settings WHERE intUser = ";
		break;
}
$strSql .= $_REQUEST['uId'] . ";";
$rstSett = mysql_query($strSql);
$jsnDataR = new ArrayObject();
for ($intIx=1; $intIx<=mysql_num_fields($rstSett); $intIx++){
	$jsnDataR->append(mysql_result($rstSett,0,$intIx-1));
};
echo json_encode($jsnDataR);
unset($rstSett);
mysql_close($con);