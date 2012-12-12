<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');

$arrLang = getLangArray('custom03.php',$uLang);

$arrFollowers = explode(",",$_POST['arrfollowers']);

for ($intIx=0; $intIx<count($arrFollowers) - 1; $intIx++)
{
	$strSql = "INSERT INTO tbl_usr_friendship (intUser, intFriend) VALUES (" . $_POST['uid'] . "," . $arrFollowers[$intIx] . ");";
	mysql_query($strSql);
};

$strSql = "SELECT * FROM cat_users WHERE intId = " . $_POST['uid'] . ";";
$rstUVals = mysql_query($strSql);
while ($objDataUVals = mysql_fetch_array($rstUVals))
{
	$intUVals00 = $objDataUVals['intuVals00'];
	$intUVals01 = $objDataUVals['intuVals01'];
	$intUVals02 = $objDataUVals['intuVals02'];
	$intUVals03 = $objDataUVals['intuVals03'];
	$intUVals04 = $objDataUVals['intuVals04'];
};
mysql_close($con);
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
			<img src="img/cust_3_on.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<strong><?php echo $arrLang['starttag']; ?></strong>
		</div>
		<br style="clear:both" />
	</div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:44px; color:#505050; text-align:center"><?php echo $arrLang['title']; ?></div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; text-align:center; margin-top:40px"><?php echo $arrLang['subtitle']; ?></div>
	<div style="margin:24px auto 0px auto; width:900px">
		<div class="brainvals br_white" style="width:<?php echo ($intUVals00 * 9) - 15;?>px;"><img src="img/vals_2.png"><?php echo $intUVals00; ?>%</div>
		<div class="brainvals br_dark" style="width:<?php echo ($intUVals01 * 9) - 15;?>px;"><img src="img/vals_5.png"><?php echo $intUVals01; ?>%</div>
		<div class="brainvals br_white" style="width:<?php echo ($intUVals02 * 9) - 15;?>px;"><img src="img/vals_4.png"><?php echo $intUVals02; ?>%</div>
		<div class="brainvals br_dark" style="width:<?php echo ($intUVals03 * 9) - 15;?>px;"><img src="img/vals_3.png"><?php echo $intUVals03; ?>%</div>
		<div class="brainvals br_white" style="width:<?php echo ($intUVals04 * 9) - 15;?>px;"><img src="img/vals_1.png"><?php echo $intUVals04; ?>%</div>
		<br style="clear:both">
	</div>	
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; text-align:center; margin-top:70px">
		<?php echo $arrLang['subtitle2']; ?>
		<img src="img/resume_graphic_<?php echo $uLang; ?>.png" style="display:block;margin:15px auto">
	</div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; text-align:center;margin-top:70px">
		<?php echo $arrLang['subtitle3']; ?>
		<img src="img/resume_fast.png" style="display:block;margin:15px auto">
		<span style="font-size:22px;margin-top:15px"><?php echo $arrLang['subtitle4']; ?></span>
		<br />
		<span style="font-family:Tahoma; font-size:12px; color:#A0A0A0;">*ms = <?php echo $arrLang['mslabel']; ?></span>
	</div>
	<div style="text-align:center;margin-top:22px">
		<input id="btnNext" name="btnNext" type="button" value="<?php echo $arrLang['btnNext']; ?>" onclick="goNext(<?php echo $_POST['uid']; ?>); " style="background: transparent url('img/signup_btn.png') no-repeat;width:147px;height:47px;border:0px; font-size:16px;color:#FFFFFF; cursor:pointer" />
	</div>
	<br style="clear:both"/>
	<div id="copyright">
		<img src="img/cr.png" class="img_b0">
		<br />
		©2012 BeeBrite. All Rights Reserved
	</div>
	<form name="frmLogin" id="frmLogin" method="post" action="games.php">
		<input id="uId" name="uId" type="hidden" value="" />
	</form>
	<script>
	function goNext($intId)
	{
		$('#uId').val($intId);
		$('#frmLogin').submit();
	};
	</script>
</body>
</html>
<?php
unset($arrLang);
include('inc/close.php');
?>