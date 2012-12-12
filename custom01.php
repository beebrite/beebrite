<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');

$arrLang = getLangArray('custom01.php',$uLang);
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
<div style="position:absolute;top:0px;bottom:0px;width:100%">
	<div class="bar_login">
		<div style="float:right; height:39px; line-height:39px; vertical-align:middle; padding-right:20px; font-family:Tahoma; font-size:12px; font-weight:normal; color:#FFFFFF; text-shadow:0px 1px #FF9B00; ">
			<img src="img/cust_1_on.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<strong><?php echo $arrLang['customizetag']; ?></strong>
			<img src="img/cust_2_off.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<?php echo $arrLang['peopletag']; ?>
			<img src="img/cust_3_off.png" style="border:0px; margin-right:7px; vertical-align:middle; margin-left:12px;">
			<?php echo $arrLang['starttag']; ?>
		</div>
		<br style="clear:both" />
	</div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:44px; color:#505050; text-align:center"><?php echo $arrLang['title']; ?></div>
	<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#505050; text-align:center"><?php echo $arrLang['subtitle']; ?></div>
	<div style="text-align:center">
		<object data="graficaPastel.swf" type="application/x-shockwave-flash" width="100%" height="100%" id="flashcontent_embed" name="flashcontent_embed" style="width:960px; height:531px">
			<param name="movie" value ="graficaPastel.swf" />
			<param name="allowScriptAccess" value="always">
		    <param name="allowFullScreen" value="true">
		    <param name="salign" value="tl">
		    <param name="wmode" value="transparent">
		    <param name="play" value="true">
		    <embed src="graficaPastel.swf" width="960px" height="531px" allowScriptAccess="always" allowFullScreen="true" salign="lt" wmode="opaque" play="true" type="application/x-shockwave-flash" />
		</object>
	</div>
	<div style="font-size:13px; color:#505050; text-align:center"><?php echo $arrLang['lblwork']; ?></div>
	<div style="text-align:center;margin-top:22px">
		<input id="btnNext" name="btnNext" type="button" value="<?php echo $arrLang['btnNext']; ?>" onclick="goNext(); " style="background: transparent url('img/signup_btn.png') no-repeat;width:147px;height:47px;border:0px; font-size:16px;color:#FFFFFF; cursor:pointer" />
	</div>
	<br style="clear:both"/>
	<div id="copyright">
		<img src="img/cr.png" class="img_b0">
		<br />
		©2012 BeeBrite. All Rights Reserved
	</div>
	<form id="frmCustom01" name="frmCustom01" method="post" action="custom02.php">
		<input name="sId" id="sId" type="hidden" value="<?php echo $_POST['sId']; ?>"/>
		<input name="uVals" id="uVals" type="hidden" value=""/>
	</form>
</div>
<script>
$(document).ready(function() {
	document.getElementById("flashcontent_embed").focus();
});	

$strUVals = "20||20||20||20||20||";

function setValues(){
	$jsnData = "20||20||20||20||20||<?php echo $uLang; ?>||";
	return $jsnData;
};

function uSetVals(strVals)
{
	var $arrLegend=new Array();
	$arrLegend['54']='<?php echo $arrLang['54']; ?>';
	$arrLegend['53']='<?php echo $arrLang['53']; ?>';
	$arrLegend['52']='<?php echo $arrLang['52']; ?>';
	$arrLegend['51']='<?php echo $arrLang['51']; ?>';
	$arrLegend['50']='<?php echo $arrLang['50']; ?>';
	$arrLegend['43']='<?php echo $arrLang['43']; ?>';
	$arrLegend['42']='<?php echo $arrLang['42']; ?>';
	$arrLegend['41']='<?php echo $arrLang['41']; ?>';
	$arrLegend['40']='<?php echo $arrLang['40']; ?>';
	$arrLegend['32']='<?php echo $arrLang['32']; ?>';
	$arrLegend['31']='<?php echo $arrLang['31']; ?>';
	$arrLegend['30']='<?php echo $arrLang['30']; ?>';
	$arrLegend['21']='<?php echo $arrLang['21']; ?>';
	$arrLegend['20']='<?php echo $arrLang['20']; ?>';
	$arrLegend['10']='<?php echo $arrLang['10']; ?>';
	$arrLegend['00']='<?php echo $arrLang['00']; ?>';
	$strUVals = strVals;
	$arrLV = strVals.split("||");
	if($arrLV[0]==20 && $arrLV[1]==20 && $arrLV[2]==20 && $arrLV[3]==20 && $arrLV[4]==20){
		$intLId = "00";
	}else{
		if($arrLV[0]==60){
			$intLId = "50";
		}else if($arrLV[1]==60){
			$intLId = "40";
		}else if($arrLV[2]==60){
			$intLId = "30";
		}else if($arrLV[3]==60){
			$intLId = "20";
		}else if($arrLV[4]==60){
			$intLId = "10";
		}else{
			$intFArea = 0;
			$intVArea = 0;
			for($intIx=0;$intIx<=4;$intIx++){
				if($arrLV[$intIx]>$intVArea){
					$intVArea = $arrLV[$intIx];
					$intFArea=$intIx + 1;
				};
			};
			$intSArea = 0;
			$intVArea = 0;
			for($intIx=0;$intIx<=4;$intIx++){
				if($arrLV[$intIx]>$intVArea && ($intIx+1)!=$intFArea){
					$intVArea = $arrLV[$intIx];
					$intSArea=$intIx + 1;
				};
			};
			if($intFArea>$intSArea){
				$intLId = $intFArea + "" + $intSArea;
			}else{
				$intLId = $intSArea + "" + $intFArea;
			};
		};
	};
	$('#divLegend').html($arrLegend[$intLId]);
};

function goNext()
{
	$arrVals = $strUVals.split("||");
	if (parseInt($arrVals[0]) + parseInt($arrVals[1]) + parseInt($arrVals[2]) + parseInt($arrVals[3]) + parseInt($arrVals[4]) != 100)
	{
		$arrVals[4] = parseInt(100 - (parseInt($arrVals[0]) + parseInt($arrVals[1]) + parseInt($arrVals[2]) + parseInt($arrVals[3])));
	};
	$('#uVals').val($arrVals[0] + "||" + $arrVals[1] + "||" + $arrVals[2] + "||" + $arrVals[3] + "||" + $arrVals[4] + "||");
	$('#frmCustom01').submit();
};

</script>
</body>
</html>
<?php
unset($arrLang);
include('inc/close.php');
?>