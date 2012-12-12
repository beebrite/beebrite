<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');
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
<link href="css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/beebrite.js"></script>
<script>
function itemToggle(numItem){
	$("#aboutitem_" + numItem).slideToggle('fast');
}
</script>
<style>
.helpcontainer span { display: block; padding: 10px 0px 5px 0px; cursor: pointer; }
</style>
</head>
<body>
	<!--USER BAR-->
<?php include('inc/user_bar.php'); ?>
	<!--USER BAR-->
	<!--STATS BAR-->
<?php include('inc/user_stats.php'); ?>
	<!--STATS BAR-->
	<!--WORK AREA-->
<?php $arrLang = getLangArray('about.php',$uLang); ?>
	<div style=" width:100%;margin:0px auto 0px auto" id="divMainWA">
		<div id="divInvite" style="width:930px; border:1px #E1E1E1 solid; margin:0px auto 0px auto;background-color:#FFFFFF;padding:22px 14px 22px 14px">
			<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; border-bottom:1px #EBEBEB solid; padding-left:17px; padding-bottom:19px;margin-bottom:18px">
				<?php echo $arrLang['abouttitle']; ?>
			</div>
			<div style="float:left; width:200px; padding-top:18px; z-index:2; position: relative">
				<div onclick="window.location='about.php';" id="btnAbout01" class="button_nonsel" style=" background-image:url(img/about_whatis.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu01']; ?></div>
				<div onclick="window.location='about_help.php';" id="btnAbout02" class="button_sel" style="background-image:url(img/about_help.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu02']; ?></div>
				<div onclick="window.location='about_support.php';" id="btnAbout03" class="button_nonsel" style="background-image:url(img/about_support.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu03']; ?></div>
				<!--div onclick="window.location='about_buttons.php';" id="btnAbout04" class="button_nonsel" style="background-image:url(img/about_buttons.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu04']; ?></div-->
				<div onclick="window.location='about_team.php';" id="btnAbout05" class="button_nonsel" style="background-image:url(img/about_team.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu05']; ?></div>
				<div onclick="window.location='about_careers.php';" id="btnAbout06" class="button_nonsel" style="background-image:url(img/about_job.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu06']; ?></div>
				<div onclick="window.location='about_blog.php';" id="btnAbout07" class="button_nonsel" style="background-image:url(img/about_blog.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu07']; ?></div>
				<div onclick="window.location='about_contact.php';" id="btnAbout08" class="button_nonsel" style="background-image:url(img/about_contact.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu08']; ?></div>
				<div onclick="window.location='about_legal.php';" id="btnAbout09" class="button_nonsel" style="background-image:url(img/about_terms.png);background-position:165px center;background-repeat:no-repeat; border-bottom:1px #E1E1E1 solid"><?php echo $arrLang['menu09']; ?></div>
			</div>
			<div id="divMainSettings" style=" width:670px; display:block; float:left; border-left:1px #E1E1E1 solid; min-height:600px; margin:0px 0px 0px -1px; padding-left:38px; padding-top:23px; z-index:1; position: relative; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; ">
				<div id="divAbout01" class="div_invite" style="display:block; ">
					<?php echo $arrLang['menu02']; ?>
					<div class="helpcontainer" style=" text-align:justify; font-family:Tahoma; line-height:20px; font-size:12px; font-weight:normal; margin:20px 0px 0px 0px; "><?php include('about/' . $uLang . '/02.php'); ?></div>
				</div>
			</div>
			<br style="clear:both" />
		</div>
	</div>
<?php unset($arrLang); ?>
	<!--MAIN WORK AREA-->
	<!--FOOTER-->
<?php include('inc/footer.php'); ?>
	<!--FOOTER-->
<script>
changeStats(<?php echo $uId; ?>);
</script>
</body>
</html>
