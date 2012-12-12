<?php
include('inc/open_conn.php');
include('inc/func.php');

$vId = $_POST['vId'];
$uId = $_POST['uId'];
$uLang = $_POST['uLang'];
$arrLang = getLangArray('profile.php',$uLang);

$strSql = "SELECT * FROM cat_users a, cat_countries b WHERE a.intId = " . $vId . " AND a.strCountry = b.strCode;";
$rstUsrProfile = mysql_query($strSql);
?>
				<div style="padding:0px 9px 0px 9px; float:left; width:140px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="background-image:url('img/pr_lv.png');background-position:right center;background-repeat:no-repeat; height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['nivel']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center "><?php echo intVal(mysql_result($rstUsrProfile,0,10),10)?></div>
				</div>
				<div style="float:left; width:78px; height:161px; background-image:url('img/stats_link_ud.png'); background-position:center center; background-repeat:no-repeat"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:190px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="background-image:url('img/pr_bb.png');background-position:right center;background-repeat:no-repeat; height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['bbi']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center "><?php echo number_format(mysql_result($rstUsrProfile,0,13))?></div>
				</div>
				<div style="float:left; width:78px; height:161px; background-image:url('img/stats_link_ud.png'); background-position:center center; background-repeat:no-repeat"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:310px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="background-image:url('img/pr_sp.png');background-position:right center;background-repeat:no-repeat; height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['velocidad']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
					<?php 
					if(mysql_result($rstUsrProfile,0,12)>9999){
						echo "9,999 +";
					}else{
						echo number_format(mysql_result($rstUsrProfile,0,12)) . " ms";
					};
					?>
					</div>
				</div>
				<div style="float:left; width:44px; height:159px; border-top:1px #C8C8C8 solid; "></div>
				<div style="float:left; height:160px;">
<?php
	$strSql = "SELECT strFBScreenmail, strTWScreenName FROM cat_users WHERE intId = " . $vId . ";";
	$rstUSN = mysql_query($strSql);
	if(is_null(mysql_result($rstUSN,0,0)) && is_null(mysql_result($rstUSN,0,1))){
?>
					<div style=" width:39px; height:20px; border-left:1px #C8C8C8 solid; z-index:1; position:relative"></div>
					<div style=""><img src="img/pr_hl.png" style="border:0px; margin-left:-11px; cursor:pointer" onclick="window.location='about_help.php#areastats'"></div>
<?php	
	}elseif(!is_null(mysql_result($rstUSN,0,0)) && is_null(mysql_result($rstUSN,0,1))){
?>
					<div style=" text-align:center;width:40px;height:33px; padding-top:8px; background-image:url(img/pr_sn_01.png); background-position:center center; background-repeat:no-repeat; background-size:cover"><a href="http://www.facebook.com/<?php echo mysql_result($rstUSN,0,0); ?>" target="_blank"><img src="img/pr_fb.png" style="border:0px;"></a></div>
					<div style=" width:39px; height:20px; border-right:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=" text-align:right;width:40px;height:0px; border-bottom:1px #C8C8C8 solid;"></div>
					<div style=" width:39px; height:20px; border-left:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=""><img src="img/pr_hl.png" style="border:0px; margin-left:-11px; cursor:pointer" onclick="window.location='about_help.php#areastats'"></div>
<?php	
	}elseif(is_null(mysql_result($rstUSN,0,0)) && !is_null(mysql_result($rstUSN,0,1))){
?>
					<div style=" text-align:center;width:40px;height:33px; padding-top:8px; background-image:url(img/pr_sn_01.png); background-position:center center; background-repeat:no-repeat; background-size:cover"><a href="http://www.twitter.com/<?php echo mysql_result($rstUSN,0,1); ?>" target="_blank"><img src="img/pr_tw.png" style="border:0px;"></a></div>
					<div style=" width:39px; height:20px; border-right:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=" text-align:right;width:40px;height:0px; border-bottom:1px #C8C8C8 solid;"></div>
					<div style=" width:39px; height:20px; border-left:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=""><img src="img/pr_hl.png" style="border:0px; margin-left:-11px; cursor:pointer" onclick="window.location='about_help.php#areastats'"></div>
<?php	
	}elseif(!is_null(mysql_result($rstUSN,0,0)) && !is_null(mysql_result($rstUSN,0,1))){
?>
					<div style=" text-align:center;width:40px;height:33px; padding-top:8px; background-image:url(img/pr_sn_01.png); background-position:center center; background-repeat:no-repeat; background-size:cover"><a href="http://www.facebook.com/<?php echo mysql_result($rstUSN,0,0); ?>" target="_blank"><img src="img/pr_fb.png" style="border:0px;"></a></div>
					<div style=" width:39px; height:20px; border-right:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=" text-align:center;width:40px;height:33px; padding-top:8px; background-image:url(img/pr_sn_02.png); background-position:center center; background-repeat:no-repeat; background-size:cover"><a href="http://www.twitter.com/<?php echo mysql_result($rstUSN,0,1); ?>" target="_blank"><img src="img/pr_tw.png" style="border:0px;"></a></div>
					<div style=" width:39px; height:20px; border-left:1px #C8C8C8 solid; margin-top:-1px;z-index:1; position:relative"></div>
					<div style=""><img src="img/pr_hl.png" style="border:0px; margin-left:-11px; cursor:pointer" onclick="window.location='about_help.php#areastats'"></div>
<?php	
	};
	unset($rstUSN);
?>				
				</div>
				
				<br style="clear:both" />
				<div style="height:40px; width:939px; border-left:1px #C8C8C8 solid; margin-top:-1px; z-index:10; position:relative "></div>
				<div style="padding:0px 9px 0px 9px; width:920px; height:222px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-right-radius: 10px; -webkit-border-bottom-left-radius: 10px; -moz-border-radius-topright: 10px; -moz-border-radius-bottomleft: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; ">
						<div style="float:left; position:relative"><?php echo $arrLang['lblBrainWork']; ?></div>
						<div style="float:right; font-family:Tahoma; font-size:12px; color:#A0A0A0; position:relative">
							<img src="img/p_val_1.png" style=" border:none; width:12px; height:12px; margin-left:10px; margin-right:5px;"><?php echo $arrLang['lblBrain01']; ?>
							<img src="img/p_val_2.png" style=" border:none; width:11px; height:11px; margin-left:10px; margin-right:5px;"><?php echo $arrLang['lblBrain02']; ?>
							<img src="img/p_val_3.png" style=" border:none; width:11px; height:11px; margin-left:10px; margin-right:5px;"><?php echo $arrLang['lblBrain03']; ?>
							<img src="img/p_val_4.png" style=" border:none; width:11px; height:11px; margin-left:10px; margin-right:5px;"><?php echo $arrLang['lblBrain04']; ?>
							<img src="img/p_val_5.png" style=" border:none; width:11px; height:11px; margin-left:10px; margin-right:5px;"><?php echo $arrLang['lblBrain05']; ?>
						</div>
						<br style="clear:both" />
					</div>
					<div style="width:900px;height:68px;margin:26px auto 1px auto; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:34px; color:#FFFFFF; line-height:68px;">
					<?php
					$arrStats = array();
					$intTotal = 0;
					for($intAix=1;$intAix<=5;$intAix++){
						$strSql = "SELECT COUNT(a.intGame) FROM tbl_usr_trainings a, cat_games b WHERE a.intUser = " . $vId . " AND a.intStatus = 1 AND a.intGame = b.intId AND b.intMainArea = " . $intAix . ";";
						$rstStats = mysql_query($strSql);
						$arrStats[$intAix - 1] = mysql_result($rstStats,0,0);
						$intTotal = $intTotal + mysql_result($rstStats,0,0);
						unset($rstStats);
					};
					for($intAix=0;$intAix<=4;$intAix++){
						$arrStats[$intAix] = ($arrStats[$intAix] / $intTotal) * 100;
					};
					if($intTotal==0){
					?>
						<div style="background-color:#C8C8C8;text-align:center"><?php echo mysql_result($rstUsrProfile,0,3) ?> <?php echo $arrLang['nostats']; ?></div>
					<?php
					}else{
					?>
						<?php if($arrStats[0]!=0){?><div style="float:left; width:<?php echo ((900*($arrStats[0]/100))-0);?>px;height:68px;background-color:#AB4770;padding-left:0px"><div style="padding-left:10px"><?php echo round($arrStats[0]); ?>%</div></div><?php };?>
						<?php if($arrStats[1]!=0){?><div style="float:left; width:<?php echo ((900*($arrStats[1]/100))-0);?>px;height:68px;background-color:#90B36B;padding-left:0px"><div style="padding-left:10px"><?php echo round($arrStats[1]); ?>%</div></div><?php };?>
						<?php if($arrStats[2]!=0){?><div style="float:left; width:<?php echo ((900*($arrStats[2]/100))-0);?>px;height:68px;background-color:#E6BA2E;padding-left:0px"><div style="padding-left:10px"><?php echo round($arrStats[2]); ?>%</div></div><?php };?>
						<?php if($arrStats[3]!=0){?><div style="float:left; width:<?php echo ((900*($arrStats[3]/100))-0);?>px;height:68px;background-color:#FF8F0A;padding-left:0px"><div style="padding-left:10px"><?php echo round($arrStats[3]); ?>%</div></div><?php };?>
						<?php if($arrStats[4]!=0){?><div style="float:left; width:<?php echo ((900*($arrStats[4]/100))-0);?>px;height:68px;background-color:#268596;padding-left:0px"><div style="padding-left:10px"><?php echo round($arrStats[4]); ?>%</div></div><?php };?>
						<br style="clear:both" />
					<?php
					};
					?>
					</div>
					
					<div style="width:900px;height:50px;margin:0px auto 1px auto; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:24px; color:#FFFFFF; line-height:50px;">
						<div style="float:left; width:<?php echo ((900*(mysql_result($rstUsrProfile,0,23)/100))-10);?>px;height:50px;background-color:#A0A0A0;padding-left:10px"><?php echo mysql_result($rstUsrProfile,0,23); ?>%</div>
						<div style="float:left; width:<?php echo ((900*(mysql_result($rstUsrProfile,0,24)/100))-10);?>px;height:50px;background-color:#C8C8C8;padding-left:10px"><?php echo mysql_result($rstUsrProfile,0,24); ?>%</div>
						<div style="float:left; width:<?php echo ((900*(mysql_result($rstUsrProfile,0,25)/100))-10);?>px;height:50px;background-color:#A0A0A0;padding-left:10px"><?php echo mysql_result($rstUsrProfile,0,25); ?>%</div>
						<div style="float:left; width:<?php echo ((900*(mysql_result($rstUsrProfile,0,26)/100))-10);?>px;height:50px;background-color:#C8C8C8;padding-left:10px"><?php echo mysql_result($rstUsrProfile,0,26); ?>%</div>
						<div style="float:left; width:<?php echo ((900*(mysql_result($rstUsrProfile,0,27)/100))-10);?>px;height:50px;background-color:#A0A0A0;padding-left:10px"><?php echo mysql_result($rstUsrProfile,0,27); ?>%</div>
						<br style="clear:both" />
					</div>
				</div>
				<div style="height:40px; width:939px; border-right:1px #C8C8C8 solid; margin-top:-1px; position:relative "></div>
				<div style="padding:0px 9px 0px 9px; width:920px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="float:left">
						<div style="width:240px; height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; ">
						<?php
						if($uId==$vId){
							echo $arrLang['lblEvolution']; 
						}else{
							echo   str_replace("&&user&&",$vName . " " . substr($vLast,0,1) . ".",$arrLang['lblEvolution2']);
						};
						
						
						
						 
						?>
						</div>
						<div style="width:240px; height:109px; font-family:'Tahoma'; font-size:12px; color:#505050; line-height:36px; text-align:left ">
<?php

$strSql = "SELECT MAX(dteFinished), IFNULL(intBBi,-1) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1 AND dteFinished < CURDATE() - INTERVAL 30 DAY;";
$rstGdata = mysql_query($strSql);
$intGDef = mysql_result($rstGdata,0,0);
unset($rstGdata);

$intIxC = 1;
$strGData = "";
for($intIxG=29;$intIxG>=0;$intIxG--){
	$strSql = "SELECT IFNULL(MAX(intBBi),-1) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1 AND DATE(dteFinished) = CURDATE() - INTERVAL " . $intIxG . " DAY ORDER BY dteFinished DESC LIMIT 1;";
	$rstGdata = mysql_query($strSql);
	$intGVal = intval(mysql_result($rstGdata,0,0),10);
	if($intGDef!=-1 && $intGVal!=-1 ){
		if($intGVal==-1){
			$strGData .= "[" . $intIxC . "," . $intGDef. "]";
			
		}else{
			$strGData .= "[" . $intIxC . "," . $intGVal . "]";
			$intGDef = $intGVal;
		};
		$intIxC++;
		if($intIxG!=0){
			$strGData .= ",";
		}else{
			$strGData .= "";
		};
	}
	unset($rstGdata);
};
if($intIxC>2){
	$strGDataAux = str_replace("]","",$strGData);
	$strGDataAux = str_replace("[","",$strGDataAux);
	$arrGData = explode(",",$strGDataAux);
};
if($intIxC>2){
	$strSql = "SELECT AVG(intBBi) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1 AND DATE(dteFinished) > CURDATE() - INTERVAL 30 DAY;";
	$rstDataD2 = mysql_query($strSql);
	$intSB = ceil(( (mysql_result($rstDataD2,0,0) - $arrGData[1] )/ mysql_result($rstDataD2,0,0) ) * 100);
	unset($rstDataD2);
}else{
	$intSB = 0;
};
?>
							<strong><?php echo $intSB; ?> %</strong>&nbsp;<?php echo $arrLang['lblEvol01']; ?><br />
<?php
$strSql = "SELECT intBBi FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1 AND DATE(dteFinished) = (SELECT MIN(DATE(dteFinished)) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1) ORDER BY dteFInished DESC LIMIT 1;";
$rstDataD = mysql_query($strSql);
if(mysql_num_rows($rstDataD)==0){
	$intSB = 0;
}else{
	$strSql = "SELECT AVG(intBBi) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1;";
	$rstDataD2 = mysql_query($strSql);
	$intSB = ceil(((mysql_result($rstDataD2,0,0) - mysql_result($rstDataD,0,0)) / mysql_result($rstDataD2,0,0)) * 100);
	unset($rstDataD2);
}
?>
							<strong><?php echo $intSB; ?>%</strong>&nbsp;<?php echo $arrLang['lblEvol02']; ?><br />
<?php
unset($rstDataD);
?>

<?php
$strSql = "SELECT IFNULL(MAX(intBBi),0) FROM tbl_usr_trainings WHERE intUser = " . $vId . ";";
$rstDataD = mysql_query($strSql);
?>
							<strong><?php echo number_format(mysql_result($rstDataD,0,0),0,".",","); ?></strong>&nbsp;<?php echo $arrLang['lblEvol03']; ?>
<?php
unset($rstDataD);
?>


						</div>
					</div>


					<div style="float:left;width:664px;height:158px;margin-left:16px;">
<?php
if($intIxC>2){
?>
					<!-- Grafica! -->
					
						<script type="text/javascript" src="js/jquery.flot.min.js"></script>
						
						<script>
						$(document).ready(function () {
						
							var graphData = [{
							        data: [ 
									<?php echo $strGData; ?>
							        ],
							        color: '#505050'
							    }
							];
							
							// Lines
							$.plot($('#graph-lines'), graphData, {
							    series: {
							        points: {
							            show: true,
							            radius: 3
							        },
							        lines: {
							            show: true
							        },
							        shadowSize: 0
							    },
							    grid: {
							        color: '#646464',
							        borderColor: 'transparent',
							        borderWidth: 20,
							        hoverable: true
							    },
							    xaxis: {
							        show:false
							    },
							    yaxis: {
							        show:false
							    }
							});	
							
							
							function showTooltip(x, y, contents) {
							    $('<div id="tooltip">' + contents + '</div>').css({
							        top: y - 32,
							        left: x + 8
							    }).appendTo('body').fadeIn();
							}
							 
							var previousPoint = null;
							 
							$('#graph-lines').bind('plothover', function (event, pos, item) {
							    if (item) {
							        if (previousPoint != item.dataIndex) {
							            previousPoint = item.dataIndex;
							            $('#tooltip').remove();
							            var x = item.datapoint[0],
							                y = item.datapoint[1];
							                showTooltip(item.pageX, item.pageY, 'BBi ' + y);
							        }
							    } else {
							        $('#tooltip').remove();
							        previousPoint = null;
							    }
							});

							

						});
						</script>
						
						<style>
						#graph-wrapper { }
						.graph-container,.graph-container div,.graph-container a,.graph-container span { margin: 0;	padding: 0;	text-align: left; }
						.graph-container, #tooltip { background:#FFFFFF; border-radius: 2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; }
						.graph-container { position: relative; width: 664px; height: 120px; padding: 10px 0px 0px 0px;	}
						.graph-container > div { position: absolute; width: inherit; height: inherit; top: 10px; left: 0px;	}
						.graph-container:before, .graph-container:after { content: ''; display: block; clear: both; }
						#tooltip { font-family: Tahoma, sans-serif; font-weight:normal; font-size: 11px; line-height: 22px; color: #A0A0A0;
							       position: absolute; display: none; height: 22px; padding: 0px 10px; border: 1px solid #e1e1e1;	}
						.graph-act { color: #A0A0A0; padding: 0px 20px 0px 20px; }
						</style>
					
						<div id="graph-wrapper">
						    <div class="graph-container">
						        <div id="graph-lines"></div>
						    </div>
						</div>
						
						<div class="graph-act"><strong>BBi <?php echo $arrGData[1];?></strong> hace <?php echo $intIxC - 2; ?> días <span style="float:right;"><strong>BBi <?php echo $arrGData[count($arrGData) - 1];?></strong> hoy</span></div>

					<!-- Grafica! -->

<?php	
}else{
?>
						NO HAY DATOS SUFICIENTES
<?php	
};
?>
					
					

					</div>
					<br style="clear:both" />
				</div>
				<div style="height:40px; width:939px; border-left:1px #C8C8C8 solid; margin-top:-1px; position:relative "></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:241px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-right-radius: 10px; -webkit-border-bottom-left-radius: 10px; -moz-border-radius-topright: 10px; -moz-border-radius-bottomleft: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['lblFinishedS']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
<?php
$intCTr =  0;
$strSql = "SELECT DISTINCT(intTrainingId) FROM tbl_usr_trainings WHERE intUser = " . $vId . " and intType IN (0,1);";
$rstDataT = mysql_query($strSql);
while($objDataT = mysql_fetch_array($rstDataT)){
	$strSql = "SELECT DISTINCT(intSession) FROM tbl_usr_trainings WHERE intTrainingId = " . $objDataT['intTrainingId'] . ";";
	$rstDataSC = mysql_query($strSql);
	while($objDataS = mysql_fetch_array($rstDataSC)){
		$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intTrainingId = " . $objDataT['intTrainingId'] . " AND intSession = " . $objDataS['intSession'] . " AND intStatus <> 1;;";
		$rstDataTC = mysql_query($strSql);
		if(mysql_result($rstDataTC,0,0)==0){
			$intCTr++;
		};
		unset($rstDataTC);
	};
	unset($rstDataSC);
};
unset($rstDataT);
echo $intCTr;
?>					
					</div>
				</div>
				<div style="float:left; width:78px; height:161px; background-image:url('img/stats_link_du.png'); background-position:center center; background-repeat:no-repeat"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:242px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-right-radius: 10px; -webkit-border-bottom-left-radius: 10px; -moz-border-radius-topright: 10px; -moz-border-radius-bottomleft: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['lblFinishedT']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
<?php
$intCTr =  0;
$strSql = "SELECT DISTINCT(intTrainingId) FROM tbl_usr_trainings WHERE intUser = " . $vId . " and intType IN (0,1);";
$rstDataT = mysql_query($strSql);
while($objDataT = mysql_fetch_array($rstDataT)){
	$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intTrainingId = " . $objDataT['intTrainingId'] . " AND intStatus <> 1;";
	$rstDataTC = mysql_query($strSql);
	if(mysql_result($rstDataTC,0,0)==0){
		$intCTr++;
	};
	unset($rstDataTC);
};
unset($rstDataT);
echo $intCTr;
?>					
					</div>
				</div>
				<div style="float:left; width:78px; height:161px; background-image:url('img/stats_link_du.png'); background-position:center center; background-repeat:no-repeat"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:241px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-right-radius: 10px; -webkit-border-bottom-left-radius: 10px; -moz-border-radius-topright: 10px; -moz-border-radius-bottomleft: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['lblFinishedG']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
					<?php
					$strSql = "SELECT COUNT(*) FROM tbl_usr_trainings WHERE intUser = " . $vId . " AND intStatus = 1;";
					$rstStCnt = mysql_query($strSql);
					echo mysql_result($rstStCnt,0,0);
					unset($rstStCnt);
					?>
					</div>
				</div>
				<br style="clear:both" />
				<div style="height:40px; width:939px; border-right:1px #C8C8C8 solid; margin-top:-1px; position:relative "></div>
				<div style="float:left; height:160px; width:299px; text-align:right;"><img src="img/bee_p.png" style="border:0px; margin-top:124px"></div>
				<div style="float:left; height:159px; width:40px; border-bottom:1px #C8C8C8 solid"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:242px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['lblStickersC']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
					<?php
					$strSql = "SELECT COUNT(a.intSticker) FROM tbl_usr_stickers a, cat_stickers b WHERE a.intUser = " . $vId . " AND a.intSticker = b.intId AND b.blnPeel = 0;";
					$rstStCnt = mysql_query($strSql);
					echo mysql_result($rstStCnt,0,0);
					unset($rstStCnt);
					?>
					</div>
				</div>
				<div style="float:left; width:78px; height:161px; background-image:url('img/stats_link_ud.png'); background-position:center center; background-repeat:no-repeat"></div>
				<div style="padding:0px 9px 0px 9px; float:left; width:241px; height:158px; border:1px #C8C8C8 solid; background-color:#FFFFFF; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-right-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomright: 10px; border-top-left-radius: 10px; border-bottom-right-radius: 10px; box-shadow:0px 1px 0px rgba(255,255,255,1); -moz-box-shadow:0px 1px 0px rgba(255,255,255,1); -webkit-box-shadow:0px 1px 0px rgba(255,255,255,1); ">
					<div style="height:48px; border-bottom:1px #E1E1E1 solid; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#A0A0A0; line-height:48px; "><?php echo $arrLang['lblStickersP']; ?></div>
					<div style="height:109px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:76px; color:#505050; line-height:109px; text-align:center ">
					<?php
					$strSql = "SELECT intId FROM cat_stickers WHERE blnPeel = 1;";
					$rstStCnt = mysql_query($strSql);
					$intStCnt = 0;
					while ($objStCnt = mysql_fetch_array($rstStCnt)){
						$strSql = "SELECT intUser FROM tbl_usr_stickers WHERE intSticker = " . $objStCnt['intId'] . " ORDER BY dteTimeStamp DESC LIMIT 1;";
						$rstStCnt2 = mysql_query($strSql);
						if(mysql_num_rows($rstStCnt2)!=0){
							if(mysql_result($rstStCnt2,0,0)==$vId){
								$intStCnt = $intStCnt + 1;
							};
						};
					};
					echo $intStCnt;
					unset($rstStCnt);
					?>
					</div>
				</div>
<?php
unset($arrLang);
unset($rstUsrProfile);
mysql_close($con);
?>