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
<link href="css/activity.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/beebrite.js"></script>
</head>
<!--body-->
<body>


	<!--USER BAR-->
<?php include('inc/user_bar.php'); ?>
	<!--USER BAR-->
	<!--STATS BAR-->
<?php include('inc/user_stats.php'); ?>
	<!--STATS BAR-->
<?php
$arrLang = getLangArray('games.php',$uLang);
?>
	<!--WORK AREA-->
	<div style=" width:100%;margin:0px auto 0px auto" id="divMainWA">
		<div style="width:958px; border:1px #E1E1E1 solid; margin:0px auto 0px auto;background-color:#FFFFFF;padding:0px 0px 0px 0px">
<?php
$strSql = "SELECT * FROM cat_areas ORDER BY intId;";
$rstAreas = mysql_query($strSql);
while ($objAreas = mysql_fetch_array($rstAreas))
{
?>
			<div style=" border-bottom:1px #E1E1E1 solid; height:auto; padding:0px 15px 0px 15px; ">
				<div style=" border-bottom:1px #E1E1E1 solid; padding:19px 0px 19px 0px; margin-bottom:30px; ">
					<div style=" position:relative; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; height:28px; line-height:28px; padding-left:15px; float:left; "><?php echo $arrLang[$objAreas['strTag'] . 'tag']; ?></div>
					<div style=" position:relative; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; height:28px; line-height:28px; padding-right:15px; float:right; "><?php echo $arrLang[$objAreas['strTag'] . 'desc']; ?></div>
					<br style="clear:both; " />
				</div>
	<?php
	$strSql = "SELECT * FROM cat_games WHERE intMainArea = " . $objAreas['intId'] . " ORDER BY intId DESC;";
	$rstGames = mysql_query($strSql);
	while ($objGames = mysql_fetch_array($rstGames))
	{

	?>
				<div style=" position:relative; width:434px; float:left; padding:0px 15px 0px 15px; margin-bottom:48px; ">
					<div style=" width:138px; height:138px; background-color:#FFFFFF; background-image:url('games/img/gm<?php echo $objGames['intId']; ?>_big.png'); background-position:center center; background-repeat:no-repeat; background-size: 140px 140px; padding:5px 5px 5px 5px; border:1px #E1E1E1 solid; float:left; cursor:pointer; " onclick="OpenGame(<?php echo $objGames['intId']; ?>); "></div>
					<div style=" width:269px; float:left; padding:0px 0px 0px 15px; ">
						<div style=" font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:23px; color:#505050; margin:15px 0px 5px 0px; "><?php echo $objGames['strName']; ?></div>
						<div style=" margin-bottom:5px; "><input class=" playnowbutton " onclick="OpenGame(<?php echo $objGames['intId']; ?>); " type="button" value="<?php echo $arrLang['playnowbutton']; ?>" style=" margin-bottom:5px;" /></div>
						<div style=" font-size:11px; color:#A0A0A0; margin-bottom:5px; "><?php echo $arrLang['gamedesc' . $objGames['intId']]; ?></div>
						<div style=" font-size:11px; color:#A0A0A0; " >
							<div style="position:relative;float:left" class="gameareadesc">
								<div class="areainfo">
									<img src="img/area1.png" style=" border:0px; vertical-align:middle; ">
									<div class="round invisible btn_area_info" style="color:#FFF; font-family:Tahoma, Geneva, sans-serif; font-size:10px; background-color:#505050; line-height:normal; position:absolute; text-shadow:0px -1px 0px #1E1E1E; padding:5px; top:-30px; left:-5px;">
										<?php echo $arrLang['calculationtag']; ?><img style="margin:0px; position:absolute; top:22px; left:9px;" src="img/infostatarrow.png" />
									</div>
									&nbsp;<?php echo $objGames['intArea01']; ?>%&nbsp;&nbsp;
								</div>
							</div>
							<div style="position:relative;float:left" class="gameareadesc">
								<div class="areainfo">
									<img src="img/area2.png" style=" border:0px; vertical-align:middle; ">
									<div class="round invisible btn_area_info" style="color:#FFF; font-family:Tahoma, Geneva, sans-serif; font-size:10px; background-color:#505050; line-height:normal; position:absolute; text-shadow:0px -1px 0px #1E1E1E; padding:5px; top:-30px; left:-5px;">
										<?php echo $arrLang['memorytag']; ?><img style="margin:0px; position:absolute; top:22px; left:9px;" src="img/infostatarrow.png" />
									</div>
									&nbsp;<?php echo $objGames['intArea02']; ?>%&nbsp;&nbsp;
								</div>
							</div>
							<div style="position:relative;float:left" class="gameareadesc">
								<div class="areainfo">
									<img src="img/area3.png" style=" border:0px; vertical-align:middle; ">
									<div class="round invisible btn_area_info" style="color:#FFF; font-family:Tahoma, Geneva, sans-serif; font-size:10px; background-color:#505050; line-height:normal; position:absolute; text-shadow:0px -1px 0px #1E1E1E; padding:5px; top:-30px; left:-5px;">
										<?php echo $arrLang['speedtag']; ?><img style="margin:0px; position:absolute; top:22px; left:9px;" src="img/infostatarrow.png" />
									</div>
									&nbsp;<?php echo $objGames['intArea03']; ?>%&nbsp;&nbsp;
								</div>
							</div>
							<div style="position:relative;float:left" class="gameareadesc">
								<div class="areainfo">
									<img src="img/area4.png" style=" border:0px; vertical-align:middle; ">
									<div class="round invisible btn_area_info" style="color:#FFF; font-family:Tahoma, Geneva, sans-serif; font-size:10px; background-color:#505050; line-height:normal; position:absolute; text-shadow:0px -1px 0px #1E1E1E; padding:5px; top:-30px; left:-5px;">
										<?php echo $arrLang['languagetag']; ?><img style="margin:0px; position:absolute; top:22px; left:9px;" src="img/infostatarrow.png" />
									</div>
									&nbsp;<?php echo $objGames['intArea04']; ?>%&nbsp;&nbsp;
								</div>
							</div>
							<div style="position:relative;float:left" class="gameareadesc">
								<div class="areainfo">
									<img src="img/area5.png" style=" border:0px; vertical-align:middle; ">
									<div class="round invisible btn_area_info" style="color:#FFF; font-family:Tahoma, Geneva, sans-serif; font-size:10px; background-color:#505050; line-height:normal; position:absolute; text-shadow:0px -1px 0px #1E1E1E; padding:5px; top:-30px; left:-5px;">
										<?php echo $arrLang['concentrationtag']; ?><img style="margin:0px; position:absolute; top:22px; left:9px;" src="img/infostatarrow.png" />
									</div>
									&nbsp;<?php echo $objGames['intArea05']; ?>%
								</div>
							</div>
							<br style="clear:both" />
						</div>
					</div>
				</div>
	<?php
	}
	?>
				<br style="clear:both; " />
			</div>
<?php
}
?>
		</div>
	</div>
	<form action="play.php" method="post" id="frmPlay">
		<input id="idGame" name="idGame" type="hidden" value="" />
		<input id="idTrGame" name="idTrGame" type="hidden" value="" />
	</form>
	<script>
	function OpenGame($intGame){
		$.post("dogamesubscription.php", {uId: ""+<?php echo $uId; ?>+"", idGame: ""+$intGame+""}, function(data){
			if(data.length > 0) {
				$('#idTrGame').val(data);
				$('#frmPlay').submit();
			}
		});
	}
	</script>
	<!--WORK AREA-->
<?php
unset($arrLang);
?>
	<!--FOOTER-->
<?php include('inc/footer.php'); ?>
	<!--FOOTER-->
	<script>
	changeStats(<?php echo $uId; ?>);
	</script>
</body>
</html>
<?php
include('inc/close.php');
?>


