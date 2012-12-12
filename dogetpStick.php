<?php
include('inc/open_conn.php');
include('inc/func.php');




$vId = $_POST['vId'];
$uId = $_POST['uId'];
$uLang = $_POST['uLang'];
$blnActions = $_POST['blnActions'];
$uPic = $_POST['uPic'];
$uNick = $_POST['uNick'];
$uName = $_POST['uName'];
$uLast = $_POST['uLast'];
$intVSticker = $_POST['intVSticker'];



$arrLang = getLangArray('profile.php',$uLang);

$strSql = "SELECT * FROM cat_users a, cat_countries b WHERE a.intId = " . $vId . " AND a.strCountry = b.strCode;";
$rstUsrProfile = mysql_query($strSql);
$arrStkLang = getLangArray('STICKERS',$uLang);
?>
		<div id="divModalStickers" onclick="HideModal();" style=" overflow:hidden hidden;position :fixed;top:0px;bottom:0px;left:0px;right:0px;background-color:rgba(255,255,255,0.85); visibility: hidden;z-index:1000;">
			<iframe id="ifrmamemodal" style="overflow:hidden hidden; overflow-x:hidden;overflow-y:hidden; position:absolute; left:50%; width:505px; height:100%; top:0px; bottom:0px; margin:0px 0px 0px -250px; border:0px; "></iframe>
		</div>
		<div id="divPStickers" style="width:100%;margin:26px auto 0px auto; display:none; ">
		<?php
		$strSql = "SELECT a.intId , a.intUser, a.intSticker, a.dteTimeStamp, a.intLast, b.intId AS intIdS, b.strOrigin, b.intTarget, b.blnPeel, UNIX_TIMESTAMP(a.dteTimeStamp) as UNIXDate FROM tbl_usr_stickers a, cat_stickers b WHERE a.intUser = " . $vId . " AND a.intLast = 1 AND a.intSticker = b.intId ORDER BY a.dteTimeStamp DESC;";
		$rstStickers = mysql_query($strSql);
		$intDivStk = 1;
		while ($objDataSts = mysql_fetch_array($rstStickers))
		{
		?>
			<div id="divStk_<?php echo $intDivStk; ?>" attrShow="1" attrPeel="<?php echo $objDataSts['blnPeel'];?>" attrPlatform="<?php echo $objDataSts['strOrigin'];?>" attrGame="<?php echo $objDataSts['intTarget'];?>" style=" display:block; width:210px;">
<?php
if ($objDataSts['blnPeel']==1){
	$strSql = "SELECT a.intUser, a.dteTimeStamp, b.strName, b.strLastName, b.strUsrPic, b.strNick FROM tbl_usr_stickers a, cat_users b WHERE a.intsticker = " . $objDataSts['intIdS'] . " AND a.intUser = b.intId ORDER BY dteTimeStamp DESC;";
	
	$rstOwner = mysql_query($strSql);
	if(mysql_result($rstOwner,0,0) == $vId){
	?>
				<div onclick="ShowModal(<?php echo $objDataSts['intIdS']; ?>);" style="width:210px; height:175px; cursor:pointer; background-position:center bottom, center top, center bottom; background-repeat:no-repeat, no-repeat, no-repeat; background-image:url(img/stickers/bg_stickers_glued.png), url(img/stickers/<?php echo $objDataSts['intIdS']; ?>_160.png), url(img/stickers/bg_stickers.png);"></div>
	<?php
	}else{
	?>
				<div onclick="ShowModal(<?php echo $objDataSts['intIdS']; ?>);" style="width:210px; height:175px; cursor:pointer; background-position:center top, center bottom; background-repeat:no-repeat, no-repeat; background-image:url(img/stickers/<?php echo $objDataSts['intIdS']; ?>_160_n.png), url(img/stickers/bg_stickers_peel.png) ;"></div>
	<?php
	};
?>
				<div style=" border:1px #C8C8C8 solid; background-color:#FFFFFF; border-top:0px; margin-bottom:30px; ">
					<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:22px; color:#505050; text-align:center; margin:0px 10px 0px 10px; "><?php echo $arrStkLang[$objDataSts['intSticker'] . '_N']; ?></div>
					<div style="font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#A0A0A0; text-align:center; margin:0px 10px 0px 10px; "><?php echo $arrStkLang[$objDataSts['intSticker'] . '_D']; ?></div>
					<div style=" margin:9px 9px 0px 8px; height:40px; vertical-align:top; ">
						<div onclick="window.location='<?php echo mysql_result($rstOwner,0,5); ?>'" style=" cursor:pointer; float:left; width:32px; height:32px; background-position: left center; background-repeat: no-repeat; background-size: cover; background-image:url(<?php echo mysql_result($rstOwner,0,4); ?>);"></div>
						<div style=" float:left; width:150px; padding-left:9px; text-align:left; ">
							<a onclick="window.location='<?php echo mysql_result($rstOwner,0,5); ?>'"><?php echo mysql_result($rstOwner,0,2) . " " . substr(mysql_result($rstOwner,0,3),0,1) . "."; ?></a> <?php echo str_replace("&&sticker&&",$arrStkLang[$objDataSts['intSticker'] . '_N'],$arrLang['peel_01']); ?>
		<?php
		if(mysql_num_rows($rstOwner)>1){
		?>		
							<?php echo $arrLang['peel_02']; ?> <a onclick="window.location='<?php echo mysql_result($rstOwner,1,5); ?>'"><?php echo mysql_result($rstOwner,1,2) . " " . substr(mysql_result($rstOwner,1,3),0,1) . "."; ?></a>
		<?php
		};
		?>
						</div>
						<br style="clear:both" />
					</div>
<?php
	unset($rstOwner);
}else{
?>
				<div onclick="ShowModal(<?php echo $objDataSts['intIdS']; ?>);" style="width:210px; height:175px; cursor:pointer;  background-position:center top, center bottom; background-repeat:no-repeat, no-repeat; background-image:url(img/stickers/<?php echo $objDataSts['intIdS']; ?>_160.png), url(img/stickers/bg_stickers.png);"></div>
				<div style=" border:1px #C8C8C8 solid; background-color:#FFFFFF; border-top:0px; margin-bottom:30px;">
					<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:22px; color:#505050; text-align:center; margin:0px 10px 0px 10px; "><?php echo $arrStkLang[$objDataSts['intSticker'] . '_N']; ?></div>
					<div style="font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#A0A0A0; text-align:center; margin:0px 10px 0px 10px; "><?php echo $arrStkLang[$objDataSts['intSticker'] . '_D']; ?></div>
<?php
};
?>
					<div id="divCommCont_<?php echo $objDataSts[0]; ?>">
			<?php
			$strSql = "SELECT a.intId, a.strComment, CONCAT(b.strName,' ',b.strLastName) AS 'Name', b.strNick, b.strUsrPic, UNIX_TIMESTAMP(a.dteTimeStamp) as UNIXDate ";
			$strSql .= "FROM tbl_usr_comments a, cat_users b ";
			$strSql .= "WHERE a.intSticker = " . $objDataSts['intIdS'] . " ";
			if($objDataSts['blnPeel']==0){
				$strSql .= "AND a.intStkOwner = " . $vId . " ";
			};
			$strSql .= "AND a.intUser = b.intId ";
			$strSql .= "ORDER BY a.dteTimeStamp DESC LIMIT 4;";
			$rstComments = mysql_query($strSql);
			$intCntRws = mysql_num_rows($rstComments);
			$intCntRws--;
			for($intIxRev=$intCntRws;$intIxRev>=0;$intIxRev--){
			?>
						<div onclick="window.location='<?php echo mysql_result($rstComments,$intIxRev,3); ?>';" style="cursor:pointer; min-height:30px; padding:10px 0px 10px 0px; border-bottom:1px #EBEBEB solid; background:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,mysql_result($rstComments,$intIxRev,4))); ?>') left 10px no-repeat; background-size:30px 30px; text-align:left;margin-left:9px; padding-left:39px; margin-right:9px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050;">
							<a onclick="window.location='<?php echo mysql_result($rstComments,$intIxRev,3); ?>';"><?php echo mysql_result($rstComments,$intIxRev,2);?></a> <?php echo substr(mysql_result($rstComments,$intIxRev,1),0,140);?>
						</div>
			<?php
			};
			
			

			?>
					</div>
<?php
if($blnActions){
?>

					<div id="errChars_<?php echo $objDataSts[0]; ?>" style=" padding:5px 0px 5px 0px; width:186px; background-color:#FFFAE6; margin:10px auto 0px; border:solid 1px #FFFFFF; border-bottom:0px; font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050; display:none; outline:#E1E1E1 solid 1px;">
						<img src="img/sign_warning.png" style=" height:13px; border:0px; vertical-align:middle">&nbsp;<?php echo $arrLang['LongTextAlert']; ?>
					</div>
					<div style="padding:10px 0px 10px 0px; border-bottom:1px #EBEBEB solid; background:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$uPic)); ?>') left 10px no-repeat; background-size:30px 30px; text-align:left;margin-left:9px; padding-left:39px; margin-right:9px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050;">
						<textarea onblur="hideBnC(<?php echo $objDataSts[0]; ?>);"  onfocus="showBnC(<?php echo $objDataSts[0]; ?>);" onkeypress="changeCounter(<?php echo $objDataSts[0]; ?>,<?php echo $vId; ?>,<?php echo $objDataSts['intSticker']; ?>,<?php echo $uId; ?>); showBnC(<?php echo $objDataSts[0]; ?>); " id="txtComm_<?php echo $objDataSts[0]; ?>" style="padding:5px 5px 5px 5px; border:1px #E1E1E1 solid;width:139px; height:31px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#A0A0A0; resize:none" placeholder="<?php echo $arrLang['CommentText']; ?>"></textarea>
						<div id="divCnB_<?php echo $objDataSts[0]; ?>" style="display:none; text-align:right;padding-top:5px;">
							<span id="txtCounter_<?php echo $objDataSts[0]; ?>" style="font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#A0A0A0;">500</span>
							<input id="btnComm_<?php echo $objDataSts[0]; ?>" onclick="valComm(<?php echo $objDataSts['intSticker']; ?>,<?php echo $uId; ?>,<?php echo $vId; ?>,<?php echo $objDataSts[0]; ?>);"  type="button" value="<?php echo $arrLang['CommentButton']; ?>" style="color:#505050; font-family:Tahoma; font-size:11px; margin:0px 0px 0px 10px; padding:3px 10px 3px 10px; background-color:#F0F0F0; border:solid 1px #E1E1E1; text-align:center; border-radius:3px; box-shadow:inset 0px 0px 1px 0px #FFFFFF; text-shadow:0px 1px 0px #FFFFFF; cursor:pointer;" />
						</div>
					</div>
<?php
};
?>




					<div style=" padding:10px 9px 10px 9px; font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050; text-align:center"><?php echo hace($objDataSts['UNIXDate'],$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']); ?></div>
				</div>
			</div>
		<?php
		$intDivStk++;
		}
		
		$intDivStk--;

?>
	<div id="divstickers" style="width:100%; margin:26px auto 0px auto"></div>
	<script>
	$intDivStk = <?php echo $intDivStk; ?>;
	moveContainers();
	function ShowAll()
	{
		$('#gamesdropdown').hide();
		$('#StkFilterAll').addClass('dark_40px');
		$('#StkFilterAll').removeClass('clear_40px');
		$('#StkFilterPlatform').addClass('clear_40px');
		$('#StkFilterPlatform').removeClass('dark_40px');
		$('#StkFilterPeel').addClass('clear_40px');
		$('#StkFilterPeel').removeClass('dark_40px');
		$('#StkFilterGame').addClass('clear_40px');
		$('#StkFilterGame').removeClass('dark_40px');
		for ($intX = 1; $intX <= $intDivStk; $intX++)
		{
			$('#divStk_' + $intX).attr('attrShow','1');
		};
		moveContainers();
	};

	function ShowPlatform()
	{
		$('#gamesdropdown').hide();
		$('#StkFilterAll').addClass('clear_40px');
		$('#StkFilterAll').removeClass('dark_40px');
		$('#StkFilterPlatform').addClass('dark_40px');
		$('#StkFilterPlatform').removeClass('clear_40px');
		$('#StkFilterPeel').addClass('clear_40px');
		$('#StkFilterPeel').removeClass('dark_40px');
		$('#StkFilterGame').addClass('clear_40px');
		$('#StkFilterGame').removeClass('dark_40px');
		for ($intX = 1; $intX <= $intDivStk; $intX++)
		{
			if($('#divStk_' + $intX).attr('attrPlatform') == 'P')
			{
				$('#divStk_' + $intX).attr('attrShow','1');
			}
			else
			{
				$('#divStk_' + $intX).attr('attrShow','0');
			}
		};
		moveContainers();
	};

	function ShowPeel()
	{
		$('#gamesdropdown').hide();
		$('#StkFilterAll').addClass('clear_40px');
		$('#StkFilterAll').removeClass('dark_40px');
		$('#StkFilterPlatform').addClass('clear_40px');
		$('#StkFilterPlatform').removeClass('dark_40px');
		$('#StkFilterPeel').addClass('dark_40px');
		$('#StkFilterPeel').removeClass('clear_40px');
		$('#StkFilterGame').addClass('clear_40px');
		$('#StkFilterGame').removeClass('dark_40px');
		for ($intX = 1; $intX <= $intDivStk; $intX++)
		{
			if($('#divStk_' + $intX).attr('attrPeel') == '1')
			{
				$('#divStk_' + $intX).attr('attrShow','1');
			}
			else
			{
				$('#divStk_' + $intX).attr('attrShow','0');
			}
		};
		moveContainers();
	};

	function showDropdown()
	{
		$intPaddingL = parseInt($('#StkFilterGame').css('padding-left').replace("px",""),10);
		$intPaddingR = parseInt($('#StkFilterGame').css('padding-right').replace("px",""),10);
		$intBordergL = parseInt(1,10);
		$intBordergR = parseInt(1,10);
		$intBtnWidth = parseInt($('#StkFilterGame').css('width').replace("px",""),10);
		$intDropPosition = $intPaddingL + $intPaddingR + $intBordergL + $intBordergR + $intBtnWidth;
		$('#gamesdropdown').css('left',(($intDropPosition/2)*(-1)) - 100);		
		$('#gamesdropdown').fadeIn('fast');
	};

	function ShowGames($intLocalGame)
	{
		$('#StkFilterAll').addClass('clear_40px');
		$('#StkFilterAll').removeClass('dark_40px');
		$('#StkFilterPlatform').addClass('clear_40px');
		$('#StkFilterPlatform').removeClass('dark_40px');
		$('#StkFilterPeel').addClass('clear_40px');
		$('#StkFilterPeel').removeClass('dark_40px');
		$('#StkFilterGame').addClass('dark_40px');
		$('#StkFilterGame').removeClass('clear_40px');
		if ($intLocalGame =='A')
		{
			for ($intX = 1; $intX <= $intDivStk; $intX++)
			{
				if($('#divStk_' + $intX).attr('attrPlatform') == 'G')
				{
					$('#divStk_' + $intX).attr('attrShow','1');
				}
				else
				{
					$('#divStk_' + $intX).attr('attrShow','0');
				}
			};
		}
		else
		{
			for ($intX = 1; $intX <= $intDivStk; $intX++)
			{
				if($('#divStk_' + $intX).attr('attrPlatform') == 'G' && $('#divStk_' + $intX).attr('attrGame') == $intLocalGame)
				{
					$('#divStk_' + $intX).attr('attrShow','1');
				}
				else
				{
					$('#divStk_' + $intX).attr('attrShow','0');
				}
			};
		}
		moveContainers();
		$('#gamesdropdown').hide();
	};

	function moveContainers(){
		for($intX=1;$intX<=$intDivStk;$intX++){
			$("#divStk_"+$intX).hide();
			$("#divStk_"+$intX).appendTo("#divPStickers");
		}
		$("#divstickers").html("");
		$intAvailW=$("body").width();
		if($intAvailW<=960){
			$intCols=4
		}else if($intAvailW>=960&&$intAvailW<1170){
			$intCols=4
		}else if($intAvailW>=1170&&$intAvailW<1410){
			$intCols=5
		}else if($intAvailW>=1410&&$intAvailW<1650){
			$intCols=6
		}else if($intAvailW>=1650&&$intAvailW<1890){
			$intCols=7
		}else{
			$intCols=8
		};
		$intDivW=($intCols*240)-30;
		$("#divstickers").css("width",$intDivW);
		for($intX=1;$intX<$intCols;$intX++){
			$("#divstickers").append("<div style='position:relative;width:210px;float:left;' id='divCol"+$intX+"'></div>");
			$("#divstickers").append("<div style='width:30px;height:200px;float:left'></div>")
		};
		$("#divstickers").append("<div style='width:210px;float:left;' id='divCol"+$intCols+"'></div>");
		$("#divstickers").append("<br style='clear:both' />");
		$intTCol=1;
		for($intX=1;$intX<=$intDivStk;$intX++){
			if($("#divStk_"+$intX).attr('attrShow') == '1'){
				$("#divStk_"+$intX).appendTo("#divCol"+$intTCol);
				$("#divStk_"+$intX).show();
				$intTCol++;
			};
			if($intTCol>$intCols){
				$intTCol=1
			};
		};
		$('#divPStickers').show();
	};

	function ShowModal($sId){
			var frame = document.getElementById("ifrmamemodal"),
			frameDoc = frame.contentDocument || frame.contentWindow.document;
			frameDoc.removeChild(frameDoc.documentElement);
			$('#gamesdropdown').hide();
			$('body').css('overflow','hidden');
			$('#ifrmamemodal').css('overflow','hidden');
			$('#ifrmamemodal').css('overflow-x','hidden');
			$('#ifrmamemodal').css('overflow-y','hidden');
			$('#ifrmamemodal').attr('src','stickermodal.php?sId=' + $sId + '&uId=<?php echo $uId; ?>&vId=<?php echo $vId; ?>&uLang=<?php echo $uLang; ?>');
			$('#ifrmamemodal').ready(function(){
				$('#divModalStickers').css('visibility','visible');
			});
	};
	
	function HideModal()
	{
		$('#gamesdropdown').hide();
		$('body').css('overflow','	visible');
		$('#divModalStickers').css('visibility','hidden');
	};
	
	function changeCounter($intCommB,$intVid,$intSticker,$intUid)
	{
		$intLCh = 500;
		$intCh = $intLCh - $('#txtComm_' + $intCommB).val().length;
		if ($intCh < 0)
		{
			$('#txtCounter_' + $intCommB).css('color','#ff0000');
		}
		else
		{
			if(event.keyCode == 13){
				$('#txtComm_' + $intCommB).attr('disabled','disabled');
				$('#btnComm_' + $intCommB).attr('disabled','disabled');
				valComm($intSticker,$intUid,$intVid,$intCommB);
			}else{
				$('#txtCounter_' + $intCommB).css('color','#A0A0A0');
			};
		}
		$('#txtCounter_' + $intCommB).html($intCh);
	};

	$intNewComm = 0;
	
	function valComm($sId,$uId,$vId,$intBnc)
	{
		if ($('#txtComm_' + $intBnc).val().length > 500 )
		{
			$('#errChars_' + $intBnc).show();
		}
		else
		{
			$strD = "uId=" + $uId + "&uLang=<?php echo $uLang; ?>&sId=" + $sId + "&vId=" + $vId + "&comment=" + $('#txtComm_' + $intBnc).val();
			$.ajax({data: $strD,type: "GET",dataType: "text",url: "docomment.php",success: function(databack){
					$('#errChars_' + $intBnc).hide();
					$strAppendComm = "<div onclick=\"window.location='<?php echo $uNick; ?>';\" style=\"cursor:pointer; min-height:30px; padding:10px 0px 10px 0px; border-bottom:1px #EBEBEB solid; background:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$uPic)); ?>') left 10px no-repeat; background-size:30px 30px; text-align:left;margin-left:9px; padding-left:39px; margin-right:9px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050;\">";
					$strAppendComm += "<a onclick=\"window.location='<?php echo $uNick; ?>';\"><?php echo $uName . " " . $uLast;?></a> " + $('#txtComm_' + $intBnc).val();
					$strAppendComm += "</div>";
					$('#divCommCont_' + $intBnc).append($strAppendComm);
					$('#newComm_' + $intNewComm).fadeIn('slow');
					$('#txtComm_' + $intBnc).val('');
					$('#divCnB_' + $intBnc).hide();
					$intNewComm++;
					$('#txtComm_' + $intBnc).removeAttr('disabled');
					$('#btnComm_' + $intBnc).removeAttr('disabled');
				}
			});
		};
	};


	function showBnC($intBnc)
	{
		$('#divCnB_' + $intBnc).show();
	};
	
	function hideBnC($intBnc)
	{
		if ($('#txtComm_' + $intBnc).val().length == 0)
		{
			$('#divCnB_' + $intBnc).hide();
		};
	};

<?php
if($intVSticker!=-1){
?>
	$(document).ready(function() {
		ShowModal(<?php echo $intVSticker; ?>);
	});	

<?php
}
?>

	</script>
			<br style="clear:both" />
		</div>
<?php
unset($arrStkLang);
unset($arrLang);
unset($rstUsrProfile);
mysql_close($con);
?>