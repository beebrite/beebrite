<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');

$arrLang = getLangArray('custom02.php',$uLang);

$strSql = "UPDATE cat_users SET ";
$arrVals = explode("||",$_POST['uVals']);
$strSql .= "intuVals00 = " . $arrVals[4] . ", ";
$strSql .= "intuVals01 = " . $arrVals[2] . ", ";
$strSql .= "intuVals02 = " . $arrVals[1] . ", ";
$strSql .= "intuVals03 = " . $arrVals[3] . ", ";
$strSql .= "intuVals04 = " . $arrVals[0] . " WHERE intId = " . $_POST['sId'] . ";";
mysql_query($strSql);
?>
<!DOCTYPE HTML>
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="googlebot" content="noarchive, nosnippet, noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<title>Beebrite</title>

<?php require('inc/typekit.php'); ?>

<link href="css/login.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="bar_login">
		<div style="float:right; height:39px; line-height:39px; vertical-align:middle; padding-right:20px; font-family:Tahoma; font-size:12px; font-weight:normal; color:#FFFFFF; text-shadow:0px 1px #FF9B00; ">
			<img src="img/cust_1_on.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<strong><?php echo $arrLang['customizetag']; ?></strong>
			<img src="img/cust_2_on.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<strong><?php echo $arrLang['peopletag']; ?></strong>
			<img src="img/cust_3_off.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<?php echo $arrLang['starttag']; ?>
		</div>
		<br style="clear:both" />
	</div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:44px; color:#505050; text-align:center; margin-bottom:30px"><?php echo $arrLang['title']; ?></div>
	<div class="root_box">
	
<?php
$strAlready = "";
$strCount = 0;
$strOnFB = "";

$strSql = "SELECT * FROM cat_users WHERE intlevel = (SELECT MAX(intlevel) FROM cat_users) AND intId <> " . $_POST['sId'] . " ORDER BY RAND() LIMIT 1;";
$rstFollow = mysql_query($strSql);
while ($objDataFollow = mysql_fetch_array($rstFollow))
{
	$strAlready .= $objDataFollow['intId'] . ",";
	$strCount++;
	if (!is_null($objDataFollow['intFBId']))
	{
		$strOnFB .= $objDataFollow['intFBId'] . ",";
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowers = $objDataFriend[0];
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowing = $objDataFriend[0];
	};
?>
	<div class="cont_box">
		<div>
			<div class="usr_photo" style="background-image:url(<?php echo $objDataFollow['strUsrPic']; ?>); background-size:cover;"></div>
			<div class="usr_data">
				<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intLevel']); ?>
				<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intBBI']); ?>
				<br />
				<img src="img/follow_02.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intTime']); ?>&nbsp;ms
				<div class="usr_foll"><?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>&nbsp;&middot;&nbsp;<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?></div>
			</div>
			<br style="clear:both" />
	        <div style="float:right;"><input id="btn<?php echo $objDataFollow['intId']; ?>" class="clear_36px" type="button" value="<?php echo $arrLang['btnFollow']; ?>" onclick="tglBtn(<?php echo $objDataFollow['intId']; ?>);" /></div>
			<div class="usr_name"><?php echo $objDataFollow['strName'] . " " . substr($objDataFollow['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objDataFollow['strNick']; ?></span></div>
	  	</div>
	</div>
	
	
<?php
};

$strSql = "SELECT * FROM cat_users WHERE intTime = (SELECT MIN(intTime) FROM cat_users) AND intId NOT IN (" . $strAlready . $_POST['sId'] . ") ORDER BY RAND() LIMIT 1;";
$rstFollow = mysql_query($strSql);
while ($objDataFollow = mysql_fetch_array($rstFollow))
{
	$strAlready .= $objDataFollow['intId'] . ",";
	$strCount++;
	if (!is_null($objDataFollow['intFBId']))
	{
		$strOnFB .= $objDataFollow['intFBId'] . ",";
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowers = $objDataFriend[0];
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowing = $objDataFriend[0];
	};
?>
	<div class="cont_box">
		<div>
			<div class="usr_photo" style="background-image:url(<?php echo $objDataFollow['strUsrPic']; ?>); background-size:cover;"></div>
			<div class="usr_data">
				<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intLevel']); ?>
				<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intBBI']); ?>
				<br />
				<img src="img/follow_02.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intTime']); ?>&nbsp;ms
				<div class="usr_foll"><?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>&nbsp;&middot;&nbsp;<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?></div>
			</div>
			<br style="clear:both" />
	        <div style="float:right;"><input id="btn<?php echo $objDataFollow['intId']; ?>" class="clear_36px" type="button" value="<?php echo $arrLang['btnFollow']; ?>" onclick="tglBtn(<?php echo $objDataFollow['intId']; ?>);" /></div>
			<div class="usr_name"><?php echo $objDataFollow['strName'] . " " . substr($objDataFollow['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objDataFollow['strNick']; ?></span></div>
	  	</div>
	</div>
<?php
};

$strSql = "SELECT * FROM cat_users WHERE intBBI = (SELECT MAX(intBBI) FROM cat_users) AND intId NOT IN (" . $strAlready . $_POST['sId'] . ") ORDER BY RAND() LIMIT 1;";
$rstFollow = mysql_query($strSql);
while ($objDataFollow = mysql_fetch_array($rstFollow))
{
	$strAlready .= $objDataFollow['intId'] . ",";
	$strCount++;
	if (!is_null($objDataFollow['intFBId']))
	{
		$strOnFB .= $objDataFollow['intFBId'] . ",";
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowers = $objDataFriend[0];
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowing = $objDataFriend[0];
	};
?>
	<div class="cont_box">
		<div>
			<div class="usr_photo" style="background-image:url(<?php echo $objDataFollow['strUsrPic']; ?>); background-size:cover;"></div>
			<div class="usr_data">
				<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intLevel']); ?>
				<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intBBI']); ?>
				<br />
				<img src="img/follow_02.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intTime']); ?>&nbsp;ms
				<div class="usr_foll"><?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>&nbsp;&middot;&nbsp;<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?></div>
			</div>
			<br style="clear:both" />
	        <div style="float:right;"><input id="btn<?php echo $objDataFollow['intId']; ?>" class="clear_36px" type="button" value="<?php echo $arrLang['btnFollow']; ?>" onclick="tglBtn(<?php echo $objDataFollow['intId']; ?>);" /></div>
			<div class="usr_name"><?php echo $objDataFollow['strName'] . " " . substr($objDataFollow['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objDataFollow['strNick']; ?></span></div>
	  	</div>
	</div>
<?php
};

$strSql = "SELECT * FROM cat_users WHERE intId NOT IN (" . $strAlready . $_POST['sId'] . ") AND (";
$strSql .= "intuVals00 BETWEEN " . ($arrVals[4] - 10) . " AND " . ($arrVals[4] + 10) . " ";
$strSql .= "AND ";
$strSql .= "intuVals01 BETWEEN " . ($arrVals[2] - 10) . " AND " . ($arrVals[2] + 10) . " ";
$strSql .= "AND ";
$strSql .= "intuVals02 BETWEEN " . ($arrVals[1] - 10) . " AND " . ($arrVals[1] + 10) . " ";
$strSql .= "AND ";
$strSql .= "intuVals03 BETWEEN " . ($arrVals[3] - 10) . " AND " . ($arrVals[3] + 10) . " ";
$strSql .= "AND ";
$strSql .= "intuVals04 BETWEEN " . ($arrVals[0] - 10) . " AND " . ($arrVals[0] + 10) . " ";
$strSql .= ") ORDER BY RAND() LIMIT 7; ";
$rstFollow = mysql_query($strSql);
while ($objDataFollow = mysql_fetch_array($rstFollow))
{
	$strAlready .= $objDataFollow['intId'] . ",";
	$strCount++;
	if (!is_null($objDataFollow['intFBId']))
	{
		$strOnFB .= $objDataFollow['intFBId'] . ",";
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowers = $objDataFriend[0];
	};
	$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objDataFollow['intId'] . ";";
	$rstFriend = mysql_query($strSqlF);
	while ($objDataFriend = mysql_fetch_array($rstFriend))
	{
		$intFollowing = $objDataFriend[0];
	};
?>
	<div class="cont_box">
		<div>
			<div class="usr_photo" style="background-image:url(<?php echo $objDataFollow['strUsrPic']; ?>); background-size:cover;"></div>
			<div class="usr_data">
				<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intLevel']); ?>
				<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intBBI']); ?>
				<br />
				<img src="img/follow_02.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intTime']); ?>&nbsp;ms
				<div class="usr_foll"><?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>&nbsp;&middot;&nbsp;<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?></div>
			</div>
			<br style="clear:both" />
	        <div style="float:right;"><input id="btn<?php echo $objDataFollow['intId']; ?>" class="clear_36px" type="button" value="<?php echo $arrLang['btnFollow']; ?>" onclick="tglBtn(<?php echo $objDataFollow['intId']; ?>);" /></div>
			<div class="usr_name"><?php echo $objDataFollow['strName'] . " " . substr($objDataFollow['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objDataFollow['strNick']; ?></span></div>
	  	</div>
	</div>
<?php
};
if ($strCount < 10)
{
	$strSql = "SELECT * FROM cat_users WHERE intId NOT IN (" . $strAlready . $_POST['sId'] . ",0) ORDER BY RAND() LIMIT " . (10- $strCount). ";";
	
	$rstFollow = mysql_query($strSql);
	while ($objDataFollow = mysql_fetch_array($rstFollow))
	{
		$strAlready .= $objDataFollow['intId'] . ",";
		$strCount++;
		if (!is_null($objDataFollow['intFBId']))
		{
			$strOnFB .= $objDataFollow['intFBId'] . ",";
		};
		$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objDataFollow['intId'] . ";";
		$rstFriend = mysql_query($strSqlF);
		while ($objDataFriend = mysql_fetch_array($rstFriend))
		{
			$intFollowers = $objDataFriend[0];
		};
		$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objDataFollow['intId'] . ";";
		$rstFriend = mysql_query($strSqlF);
		while ($objDataFriend = mysql_fetch_array($rstFriend))
		{
			$intFollowing = $objDataFriend[0];
		};
	?>
	<div class="cont_box">
		<div>
			<div class="usr_photo" style="background-image:url(<?php echo $objDataFollow['strUsrPic']; ?>); background-size:cover;"></div>
			<div class="usr_data">
				<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intLevel']); ?>
				<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intBBI']); ?>
				<br />
				<img src="img/follow_02.png">&middot;&nbsp;<?php echo number_format($objDataFollow['intTime']); ?>&nbsp;ms
				<div class="usr_foll"><?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>&nbsp;&middot;&nbsp;<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?></div>
			</div>
			<br style="clear:both" />
	        <div style="float:right;"><input id="btn<?php echo $objDataFollow['intId']; ?>" class="clear_36px" type="button" value="<?php echo $arrLang['btnFollow']; ?>" onclick="tglBtn(<?php echo $objDataFollow['intId']; ?>);" /></div>
			<div class="usr_name"><?php echo $objDataFollow['strName'] . " " . substr($objDataFollow['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objDataFollow['strNick']; ?></span></div>
	  	</div>
	</div>
	<?php
	};
};
?>
	</div>
	<br style="clear:both" />
	<div style="text-align:center;">
		<input id="btnGo" class="dark_54px" style="font-family:'myriad-pro'; font-weight:300; font-style:normal;" type="button" value="<?php echo $arrLang['btnGo']; ?>" onclick="startTr('<?php echo $strAlready; ?>',<?php echo $_POST['sId']; ?>);" />
	</div>
	<div id="copyright">
		<img src="img/cr.png" class="img_b0">
		<br />
		©2012 BeeBrite. All Rights Reserved
	</div>
<?php
mysql_close($con);
?>
<script>
function tglBtn(intBtn)
{
	if ($('#btn' + intBtn).val() == '<?php echo $arrLang['btnFollow']; ?>')
	{
		$('#btn' + intBtn).val('<?php echo $arrLang['btnUnFollow']; ?>');
		$('#btn' + intBtn).addClass('dark_36px');
		$('#btn' + intBtn).removeClass('clear_36px');
	}
	else
	{
		$('#btn' + intBtn).val('<?php echo $arrLang['btnFollow']; ?>');
		$('#btn' + intBtn).addClass('clear_36px');
		$('#btn' + intBtn).removeClass('dark_36px');
	};
};

function startTr(strIds,intUId)
{
	$arrIds = strIds.split(",");
	$strFollow = "";
	for ($intIx=0; $intIx<$arrIds.length; $intIx++)
	{
		if ($('#btn' + $arrIds[$intIx]).val() == '<?php echo $arrLang['btnFollow']; ?>')
		{
			$strFollow += $arrIds[$intIx] + ",";
		};
	};
	$('#uid').val(intUId);
	$('#arrfollowers').val($strFollow);
	$('#frmFollowers').submit();
};


</script>
<form id="frmFollowers" name="frmFollowers" method="post" action="custom03.php">
	<input id="uid" name="uid" type="hidden" />
	<input id="arrfollowers" name="arrfollowers" type="hidden" />
</form>
</body>
</html>
<?php
unset($arrLang);
include('inc/close.php');
?>