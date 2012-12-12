<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');

if($_GET['fbaccess_token']){
	$strSql = "UPDATE cat_users SET strFBToken = '" . $_GET['fbaccess_token'] . "' WHERE intId = " . $uId . ";";
	mysql_query($strSql);
};

$strSql = "SELECT intFBId, strFBToken from cat_users WHERE intId = " . $uId . ";";
$rstFBVal = mysql_query($strSql);
if(!is_null(mysql_result($rstFBVal,0,0)) && is_null(mysql_result($rstFBVal,0,1))){
	header("Location: https://graph.facebook.com/oauth/authorize?type=user_agent&client_id=147083958733054&redirect_uri=http%3A%2F%2Fwww%2Ebeebrite%2Ecom%2Fdofbtoken%2Ephp");
};
unset($rstFBVal);


$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 1 AND intStatus = 0 UNION SELECT COUNT(*) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 1;";
$rstWR = mysql_query($strSql);

if(mysql_result($rstWR,0,0)==0 && mysql_result($rstWR,1,0)!=0){
	unset($rstWR);
	header("Location: weeklyresume.php");
	exit(0);
};
unset($rstWR);

$strCoin = GetCurrency();

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
<script type="text/javascript" src="js/jquery-ui-1.8.22.min.js"></script>
<script type="text/javascript" src="js/beebrite.js"></script>

<style>
#sortable { list-style-type: none; margin: 0; padding: 0; }
.ui-state-highlight { height: 0px; line-height: 0px; background-color:#E1E1E1; margin:0px 0px 0px 0px }
</style>

<script>

position_y = 0;

$(function() {
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		axis: "y"
	});
	$( "#sortable" ).disableSelection();
	$("#sortable").sortable({
		start: function(event, ui) {
			ui.item.css('margin-top',position_y + 'px');
			ui.item.show();
		},
		beforeStop: function(event, ui) {
			ui.item.css('margin-top','0px');
		},
	    stop: function(event, ui) {
    		for ($intIxC=0;$intIxC<$("#sortable").children().length;$intIxC++)
    		{
	    		$('#divFull_' + $intIxC).hide();
	    		$('#divResume_' + $intIxC).show();
    		};
    		$('#divFull_' + $("#sortable").children(0).attr('trid')).show();
    		$('#divResume_' + $("#sortable").children(0).attr('trid')).hide();
	    }
	});
	
});

function ShowTrCont($objTrDiv){
	var currentPos = $($objTrDiv).position();
	position_y = currentPos.top - 10 - ($('html').scrollTop() + $('body').scrollTop());
	$('#divResume_' + $("#sortable").children(0).attr('trid')).show();
	$($objTrDiv).css('display','none');

}

function HideTrCont(){
	$('#divResume_' + $("#sortable").children(0).attr('trid')).hide();
	for ($intIxC=1;$intIxC<$("#sortable").children().length;$intIxC++)
	{
		$('#divResume_' + $intIxC).show();
	};
}
</script>

</head>
<body>
	<!--USER BAR-->
<?php include('inc/user_bar.php'); ?>
	<!--USER BAR-->
	<!--STATS BAR-->
<?php include('inc/user_stats.php'); ?>
	<!--STATS BAR-->
	<!--MAIN WORK AREA-->
	<div style=" width:100%;margin:0px auto 0px auto" id="divMainWA">
		<div style="width:958px; border:1px #E1E1E1 solid; margin:0px auto 0px auto;background-color:#FFFFFF;padding:0px 0px 0px 0px">
			<!--NEWS-->
			<div id="notice1" class="notices" style="display:none; border-bottom:1px #E1E1E1 solid ">NOTICIAS</div>
			<!--NEWS-->
			<!--WORK AREA-->
			<div style="margin:0px auto 0px auto;background-color:#FFFFFF;padding:0px 0px 0px 0px; ">
				<!--TRAININGS-->
				<div style=" height:697px; width:658px; float:left; ">
<?php
$arrLang = getLangArray('beebrite.php',$uLang);
$arrTrainingLang = getLangArray('TRAININGS',$uLang);
include('inc/daily.php');
?>
					<div style="border-bottom:1px #EBEBEB solid; margin:0px 15px 0px 15px; padding:15px 0px 15px 15px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; ">
						<?php echo $arrLang['trainingtitle']; ?>
						<a href="trainings.php"><img src="img/trainings_plus.png" style="float:right; margin-top:4px; border:0px; "></a>
					</div>
<?php
$strSql = "SELECT * FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 1 AND dteSubscribed = '" . date("Y/m/d") . "';";
$rstDailyTr = mysql_query($strSql);
$strSql = "SELECT UNIX_TIMESTAMP(MAX(dteFinished)) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 1;";
$rstTTime = mysql_query($strSql);

$arrTrainings[0] = array(	"TYPE" => "1",
							"ID" => mysql_result($rstDailyTr,0,1), 
							"PIC" => "tr0_big.png", 
							"PICRECT" => "tr0_rect.png", 
							"NAME" => $arrLang['dailytrainingstag'], 
							"TIME" => "", 
							"RECYCLE" => "", 
							"SEP" => "", 
							"TRASH" => "", 
							"SESSION" => $arrLang['dailysessionnumber'] . " " . mysql_result($rstDailyTr,0,5), 
							"GAMELIST" => array( 	mysql_result($rstDailyTr,0,6), 
													mysql_result($rstDailyTr,1,6), 
													mysql_result($rstDailyTr,2,6), 
													mysql_result($rstDailyTr,3,6), 
													mysql_result($rstDailyTr,4,6) 
													), 
							"GAMESTATUS" => array( 	mysql_result($rstDailyTr,0,10), 
													mysql_result($rstDailyTr,1,10), 
													mysql_result($rstDailyTr,2,10), 
													mysql_result($rstDailyTr,3,10), 
													mysql_result($rstDailyTr,4,10) 
													) 
							);
							



if (is_null(mysql_result($rstTTime,0,0)))
{
	$arrTrainings[0]["TIME"] = $arrLang['nulltime'];
}
else
{
	$arrTrainings[0]["TIME"] = hace(mysql_result($rstTTime,0,0),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']);
};
unset($rstTTime);
unset($rstDailyTr);

$strSql = "SELECT DISTINCT(intTraining), intTrainingId FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 0 AND intStatus = 0 ORDER BY dteSubscribed DESC;";
$rstTrainings = mysql_query($strSql);
$intContainerId = 0;
while ($objTrainings = mysql_fetch_array($rstTrainings))
{
	$intContainerId++;
	$strSql = "SELECT COUNT(DISTINCT(intSession)) FROM cat_t_s_g WHERE intTraining = " . $objTrainings['intTraining'];
	$strSql .= " UNION ";
	$strSql .= "SELECT COUNT(DISTINCT(intSession)) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intStatus = 0 AND intTrainingId = " . $objTrainings['intTrainingId'] . ";";
	$rstTCounter = mysql_query($strSql);

	if(mysql_num_rows($rstTCounter)==2){
		$strCounter = (mysql_result($rstTCounter,0,0) - mysql_result($rstTCounter,1,0)) + 1 . "/" . mysql_result($rstTCounter,0,0);
	}else{
		$strCounter = "1/" . mysql_result($rstTCounter,0,0);
	};

	$strSql = "SELECT UNIX_TIMESTAMP(MAX(dteFinished)) FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intStatus = 1 AND intTrainingId = " . $objTrainings['intTrainingId'] . " ;";
	$rstTTime = mysql_query($strSql);
	$arrTrainings[$intContainerId] = array(	"TYPE" => "0",
											"ID" => $objTrainings['intTrainingId'], 
											"PIC" => "tr" . $objTrainings['intTraining'] . "_big.png", 
											"PICRECT" => "tr" . $objTrainings['intTraining'] . "_rect.png", 
											"NAME" => $arrTrainingLang[$objTrainings['intTraining'] . '_N'], 
											"TIME" => "", 
											"RECYCLE" => "<img src='img/trainings_recycle.png' style=' border:0px; vertical-align:middle; cursor:pointer; '>", 
											"SEP" => "<img src='img/trainings_sep.png' style=' border:0px; vertical-align:middle; cursor:pointer; '>", 
											"TRASH" => "<img src='img/trainings_trash.png' style=' border:0px; vertical-align:middle; cursor:pointer; '>", 
											"SESSION" => $strCounter, 
											"GAMELIST" => "", 
											"GAMESTATUS" => ""											 
											);
	if (is_null(mysql_result($rstTTime,0,0)))
	{
		$arrTrainings[$intContainerId]["TIME"] = $arrLang['nulltime'];
	}
	else
	{
		$arrTrainings[$intContainerId]["TIME"] = hace(mysql_result($rstTTime,0,0),$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']);
	};
	unset($rstTTime);
	unset($rstTCounter);
	$strSql = "SELECT intGame, intStatus FROM tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 0 AND intTraining = " . $objTrainings['intTraining'] . " AND intSession IN (SELECT MIN(intSession) from tbl_usr_trainings WHERE intUser = " . $uId . " AND intType = 0 AND intTraining = " . $objTrainings['intTraining'] . " AND intStatus = 0);";
	$rstTGame = mysql_query($strSql);
	$intCGame = 0;
	while ($objTGame = mysql_fetch_array($rstTGame))
	{
		$arrTrainings[$intContainerId]["GAMELIST"][$intCGame] = $objTGame['intGame'];
		$arrTrainings[$intContainerId]["GAMESTATUS"][$intCGame] = $objTGame['intStatus'];
		$intCGame++;
	}
	unset($rstTGame);
}
unset($rstTrainings);
unset($arrTrainingLang);
?>
					<div>
<?php
for ($intIx = 0; $intIx < count($arrTrainings); $intIx++)
{
	if ($intIx == 0)
	{
		$strDisplay = "block";
	}
	else
	{
		$strDisplay = "none";
	};

?>
						<div id="divFull_<?php echo $intIx; ?>" style=" display:<?php echo $strDisplay; ?>; border-bottom:1px #EBEBEB solid; margin:0px 15px 0px 15px; padding:15px 0px 15px 15px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; ">
							<div style=" width:188px; height:108px; background-color:#FFFFFF; background-image:url('img/trainings/<?php echo $arrTrainings[$intIx]["PICRECT"]; ?>'); background-position:center center; background-repeat:no-repeat; background-size: 190px 110px; padding:5px 5px 5px 5px; border:1px #E1E1E1 solid; float:left; "></div>
							<div style=" float:left; width:386px; height:120px; margin-left:14px; ">
								<div style=" float:left; ">
									<div style=" height:24px; margin-top:0px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:24px; color:#505050; "><?php echo $arrTrainings[$intIx]["NAME"]; ?></div>
									<div style=" height:11px; margin-top:5px; vertical-align:bottom; font-family:Tahoma; font-size:11px; color:#A0A0A0; "><?php echo $arrTrainings[$intIx]["TIME"]; ?></div>
								</div>
								<div style=" height:40px; vertical-align:middle; float:right; ">
								</div>
								<br style="clear:both" />
								<div style=" float:left; height:80px; line-height:80px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:44px; color:#505050; "><?php echo $arrTrainings[$intIx]["SESSION"]; ?></div>
								<div style=" height:80px; line-height:80px; vertical-align:middle; float:right; ">
<?php
if($arrTrainings[$intIx]["TYPE"]==1){
	if($arrTrainings[$intIx]["GAMESTATUS"][4]==0){
?>
								<input class="dark_34px" type="button" value="<?php echo $arrLang['traingnowbutton']; ?>" onclick="GoTraining(<?php echo $arrTrainings[$intIx]["ID"]; ?>)" >
<?php
	}else{
?>
								<input class="clear_34px" type="button" value="<?php echo $arrLang['finishedbutton']; ?>" disabled="disabled" style="cursor:default" >
<?php
	};
}else{
?>
								<input class="dark_34px" type="button" value="<?php echo $arrLang['traingnowbutton']; ?>" onclick="GoTraining(<?php echo $arrTrainings[$intIx]["ID"]; ?>)" >
<?php
};
?>
								</div>
								<br style="clear:both" />
							</div>
							<br style="clear:both" />
							<div style=" width:598px; height:48px; border:1px #E1E1E1 solid; margin-top:12px; padding:7px 0px 7px 0px; background-color:#F0F0F0; text-align:center; ">
								<div style=" display:inline-block; width:auto; margin:0px auto 0px auto;">
	<?php
	for ($intGIx=0; $intGIx < count($arrTrainings[$intIx]["GAMELIST"]); $intGIx++){
	?>
								<div style="float:left; width:38px; height:38px; margin:0px 10px 0px 10px;background-color:#FFFFFF; background-image:url('games/img/gm<?php echo $arrTrainings[$intIx]["GAMELIST"][$intGIx]; ?>_big<?php if( $arrTrainings[$intIx]["GAMESTATUS"][$intGIx]==1){ echo '_bw'; } ?>.png'); background-position:center center; background-repeat:no-repeat; background-size: 40px 40px; padding:4px 4px 4px 4px; border:1px #E1E1E1 solid; float:left; "></div>
	<?php
	};
	?>
									<br style="clear:both" />
								</div>
							</div>
						</div>					
<?php
};
?>
					</div>
					<div id="sortable" style="">
<?php
for ($intIx = 0; $intIx < count($arrTrainings); $intIx++)
{
	if ($intIx == 0)
	{
		$strDisplay = "none";
	}
	else
	{
		$strDisplay = "block";
	};

?>
						<div id="divResume_<?php echo $intIx; ?>" onmousedown="ShowTrCont(this); " onmouseup="HideTrCont(this);" trid="<?php echo $intIx; ?>" style="background-color:rgba(255,255,255,0.3); display:<?php echo $strDisplay; ?>; cursor:move; " class="ui-state-default ">
							<div style="border-bottom:1px #EBEBEB solid; margin:0px 15px 0px 15px; padding:17px 0px 15px 17px; ">
								<div style=" width:40px; height:40px; background-color:#FFFFFF; background-image:url('img/trainings/<?php echo $arrTrainings[$intIx]["PIC"]; ?>'); background-position:center center; background-repeat:no-repeat; background-size: 40px 40px; padding:3px 3px 3px 3px; border:1px #E1E1E1 solid; float:left; "></div>
								<div style=" width:120px; height:48px; line-height:48px; text-align:center; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:40px; color:#505050; float:left; "><?php echo str_replace($arrLang['dailysessionnumber'] . ' ','',$arrTrainings[$intIx]["SESSION"]); ?></div>
								<div style=" width:395px; height:48px; float:left; ">
									<div style=" height:22px; line-height:22px; margin-top:6px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:22px; color:#505050; "><?php echo $arrTrainings[$intIx]["NAME"]; ?></div>
									<div style=" height:11px; line-height:11px; font-family:Tahoma; font-size:11px; color:#A0A0A0; "><?php echo $arrTrainings[$intIx]["TIME"]; ?></div>
								</div>
								<div style=" width:48px; height:48px; float:left; text-align:center; line-height:48px; " >
									<img src="img/trainings_drag.png" style=" border:0px; vertical-align:middle; ">
								</div>
								<br style="clear:both" />
							</div>
						</div>

<?php
};
?>
					</div>
					<div style=" padding:17px 30px 23px 32px;  ">
						<a href="settings_notifications.php" class=" linktriningsstart "><?php echo $arrLang['reminderslink']; ?></a>
						<a href="trainings.php" class=" linktriningsstart " style="float:right"><?php echo $arrLang['addtrlink']; ?></a>
					</div>
				</div>
				<!--TRAININGS-->
				<div style="max-height:704px; height:704px; min-height:704px; overflow:hidden hidden; width:299px; float:right;border-left:1px #E1E1E1 solid; ">
					<!--PROMOS-->
<?php include('inc/ads.php'); ?>
					<!--PROMOS-->
					<!--ACTIVITY-->
					<div >
						<div>
							<div style=" padding:10px 0px 10px 15px; font-family:'myriad-pro'; font-weight:300;font-style:normal; font-size:28px; color:#505050; " ><?php echo $arrLang['activity']; ?></div>
							<div style="margin:0px 15px 0px 15px;text-align:center;border-bottom:1px #E1E1E1 solid; ">
								<div style="margin:0px auto 0px auto; display:inline-block; position:relative; bottom:-1px;">
									<div id="ActFriends" class=" activitysel " onclick="ActivityChanger('Friends'); " style="width:79px; border-left:1px #E1E1E1 solid; "><?php echo $arrLang['activityfriends']; ?></div>
									<div id="ActMe" class=" activityunsel " onclick="ActivityChanger('Me'); " style="width:78px; border-left:1px #E1E1E1 solid; border-right:1px #E1E1E1 solid; "><?php echo $arrLang['activityyou']; ?></div>
									<div id="ActAll" class=" activityunsel " onclick="ActivityChanger('All'); " style="width:79px; border-right:1px #E1E1E1 solid; "><?php echo $arrLang['activityall']; ?></div>
									<br style="clear:both" />
								</div>
							</div>
							<div id="ActivityArea" style=" text-align:center">
								<ul id="activity_stream" class="ul_friend_act">
								</ul>
							</div>
						</div>
					</div>
					<script>
					$strCurrent = "";
					$intLast = 0;
					function ActivityChanger($strActPage){
						
						if($strCurrent!=$strActPage){
							$intLast = 0;
							$('#activity_stream').html("");
						};
						
						$strCurrent = $strActPage;
						$('#ActFriends').removeClass('activitysel');
						$('#ActFriends').addClass('activityunsel');
						$('#ActMe').removeClass('activitysel');
						$('#ActMe').addClass('activityunsel');
						$('#ActAll').removeClass('activitysel');
						$('#ActAll').addClass('activityunsel');
						$('#Act' + $strActPage).removeClass('activityunsel');
						$('#Act' + $strActPage).addClass('activitysel');
						if($('#divPromo').css('display')=='block'){
							$iRecords = 6;
						}else{
							$iRecords = 9;
						};
						$strD = "uId=<?php echo $uId; ?>&uLang=<?php echo $uLang; ?>&sActPage=" + $strActPage + "&iRecords=" + $iRecords + "&iLast=" + $intLast;
						$.ajax({data: $strD,type: "GET",dataType: "json",url: "dogetactivity.php",success: function(databack){
								$intLast = databack.iLast;
								for($intIxA=databack.sLi.length - 1;$intIxA>=0;$intIxA--){
									if($('#activity_stream').children().length==$iRecords){
										$('#activity_stream').children(':last').slideUp('slow');
										$('#activity_stream').children(':last').remove();
									};
									$('#activity_stream').prepend(databack.sLi[$intIxA]);
									$('#' + $('#activity_stream').children(':first').attr('id')).slideDown('slow');
								};
							}
						});
					};
					</script>
					<!--ACTIVITY-->
				</div>
				<br style="clear:both" />
			</div>
			<!--WORK AREA-->
		</div>
	</div>

	<form action="play.php" method="post" id="frmPlay">
		<input id="idTrGame" name="idTrGame" type="hidden" value="" />
	</form>

	<!--MAIN WORK AREA-->
	<!--FOOTER-->
<?php include('inc/footer.php'); ?>
	<!--FOOTER-->
	<script>
	$(document).ready(function() {
		changeStats(<?php echo $uId; ?>);
		ActivityChanger('Friends');
		setInterval(function() {
			ActivityChanger($strCurrent);
		}, 5000);
	});	

	function OpenProm(){
		window.location="invite_fb.php";
	};
	</script>
</body>
</html>
<?php
unset($arrLang);
include('inc/close.php');
?>