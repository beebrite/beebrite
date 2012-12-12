<?php
require_once('inc/open_conn.php');
$sId = $_GET['sId'];
$uId = $_GET['uId'];
$vId = $_GET['vId'];
$strComment = str_replace("'","´´",$_GET['comment']);
$strSql = "INSERT INTO tbl_usr_comments (intSticker,intStkOwner,intUser,strComment,dteTimeStamp) VALUES (";
$strSql .= $sId . ",";
$strSql .= $vId . ",";
$strSql .= $uId . ",";
$strSql .= "'" . $strComment . "',";
$strSql .= "NOW());";
mysql_query($strSql);
mysql_close($con);
?>