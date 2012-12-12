<?php
include('inc/open_conn.php');
include('inc/sesshandler.php');
include('inc/func.php');
$arrStkLang = getLangArray('STICKERS',$uLang);
$arrLang = getLangArray('stickermodal.php',$uLang);

$sId = $_GET['sId'];

?>			
	<div id="scrollbar1">
		<div class="scrollbar" id="scrollbar"><div class="track" id="track"><div class="thumb" id="thumb"><div class="end" id="end"></div></div></div></div>
		<div class="viewport"><div class="overview">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=147083958733054";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div style=" position:relative; width:500px; height:100%; margin:10px auto 0px auto; background-color:aqua;" onmouseover="$blnClose=false;" onmouseout="$blnClose=true; ">
<?php
$strSql = "SELECT a.intId, a.intUser, a.intSticker, a.dteTimeStamp, b.intId AS intIdS, b.strOrigin, b.intTarget, b.blnPeel FROM tbl_usr_stickers a, cat_stickers b WHERE a.intSticker = " . $sId . " AND a.intSticker = b.intId AND a.intLast = 1;";
$rstModalSticker = mysql_query($strSql);
?>
				<div style="width:500px; height:380px; background-position:center center, center 320px; background-repeat:no-repeat,no-repeat ; background-image:url(img/stickers/<?php echo $sId; ?>_370.png), url(img/stickers/bg_modal.png)"></div>
				<div style="border:1px #C8C8C8 solid; border-top:0px; background-color:#FFFFFF">
					<div id="divSocial" style="position:absolute; left:5px; text-align:left; top:270px; ">
						<a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.beebrite.com%2F&media=http%3A%2F%2Fwww.beebrite.com%2Fimg%2Fstickers%2F<?php echo $sId; ?>_600.png" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>					
						<br />
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.beebrite.com/<?php echo hashEncode(mysql_result($rstModalSticker, 0, 1)); ?>-<?php echo hashEncode($sId); ?>" data-text="ME gane Algo" data-via="beebrite" data-count="none" data-dnt="true">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						<br />
						<div class="fb-like" data-href="http://www.beebrite.com/<?php echo hashEncode(mysql_result($rstModalSticker, 0, 1)); ?>-<?php echo hashEncode($sId); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="tahoma"></div>
					</div>
					<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:38px; color:#505050; text-align:center"><?php echo $arrStkLang[$sId . '_N']; ?></div>
					<div style="font-family:Tahoma; font-weight:300; font-style:normal; font-size:12px; color:#A0A0A0; text-align:center;margin:0px 10px 0px 10px"><?php echo $arrStkLang[$sId . '_D']; ?></div>
					<div id="errChars" style=" padding:5px 0px 5px 0px; width:186px; background-color:#FFFAE6; margin:10px auto 0px; border:solid 1px #FFFFFF; border-bottom:0px; font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050; display:none; outline:#E1E1E1 solid 1px;">
						<img src="img/sign_warning.png" style=" height:13px; border:0px; vertical-align:middle">&nbsp;<?php echo $arrLang['LongTextAlert']; ?>
					</div>
					<div style="padding:15px 0px 5px 0px; margin-top:10px; border-top:1px #EBEBEB solid; background:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$uPic)); ?>') left 15px no-repeat; background-size:50px 50px; text-align:left;margin-left:19px; padding-left:60px; margin-right:19px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#505050;">
						<textarea onblur="hideBnC(); " onfocus="showBnC();" onkeypress="changeCounter(<?php echo $sId; ?>,<?php echo $uId; ?>); " id="txtComm" style="padding:5px 5px 5px 5px; border:1px #E1E1E1 solid;width:388px; height:37px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:12px; color:#A0A0A0; resize:none" placeholder="<?php echo $arrLang['CommentText']; ?>"></textarea>
						<div id="divCnB" style="display:none; text-align:right;padding-top:5px;">
							<span id="txtCounter" style="font-family:Tahoma; font-weight:300; font-style:normal; font-size:11px; color:#A0A0A0;">500</span>
							<input id="btnComm" onclick="valComm(<?php echo $sId; ?>,<?php echo $uId; ?>);" type="button" value="<?php echo $arrLang['CommentButton']; ?>" style="color:#505050; font-family:Tahoma; font-size:11px; margin:0px 0px 0px 10px; padding:3px 10px 3px 10px; background-color:#F0F0F0; border:solid 1px #E1E1E1; text-align:center; border-radius:3px; box-shadow:inset 0px 0px 1px 0px #FFFFFF; text-shadow:0px 1px 0px #FFFFFF; cursor:pointer;" />
						</div>
					</div>
					
					<div id="divCommCont">

			<?php
			$strSql = "SELECT a.*, b.strName, b.strLastName, b.strUsrPic, UNIX_TIMESTAMP(a.dteTimeStamp) as UNIXDate FROM tbl_usr_comments a, cat_users b WHERE a.intSticker = " . $sId . " AND a.intUser = b.intId ORDER BY a.dteTimeStamp DESC;";
			$rstComments = mysql_query($strSql);
			while ($objDataComm = mysql_fetch_array($rstComments))
			{
			?>
						<div style="height:50px; padding :5px 0px 5px 0px; background:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$objDataComm['strUsrPic'])); ?>') left 10px no-repeat; background-size:50px 50px; text-align:left;margin-left:19px; padding-left:60px; margin-right:19px;font-family:Tahoma; font-weight:300; font-style:normal; font-size:12px; color:#505050;">
							<span style="font-weight:bold"><?php echo $objDataComm['strName'] . " " . $objDataComm['strLastName'];?></span>
							<span style="float:right; color:#C8C8C8; font-size:10px;"><?php echo hace($objDataComm['UNIXDate'],$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']); ?></span>
							<br />
							<?php echo substr($objDataComm['strComment'],0,140);?>
						</div>
			<?php
			};
			?>
					</div>
					<input onclick="ShowHC(); " id="btnMHC" type="button" value="See Older Posts" style="display:block; width:460px; height:36px; color:#505050; font-family:Tahoma; font-size:12px; margin:10px 0px 0px 20px; padding:3px 10px 3px 10px; background-color:#F0F0F0; border:solid 1px #E1E1E1; text-align:center; border-radius:3px; box-shadow:inset 0px 0px 1px 0px #FFFFFF; text-shadow:0px 1px 0px #FFFFFF; cursor:pointer;" />
					<div style="width:460px;height:1px;background-color:#EBEBEB;margin:15px auto 15px auto"></div>
					<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:26px; color:#505050; text-align:center">
			<?php
			$strSql = "SELECT strName, strLastName, strNick, strUsrPic, intId FROM cat_users WHERE intId IN (SELECT DISTINCT(intUser) FROM tbl_usr_stickers WHERE intSticker = " . mysql_result($rstModalSticker, 0, 4) . " AND intUser <> " . $uId . " AND intLast = 1);";
			$rstPeople = mysql_query($strSql);
			if (mysql_num_rows($rstPeople) > 0){
			?>
				<?php echo $arrLang['peoplewith']; ?><br />
			<?php
				while ($objPeople = mysql_fetch_array($rstPeople)){
				?>
							<div onclick="GoToProfile(<?php echo $objPeople['intId']; ?>,<?php echo $sId; ?>,<?php echo $sId; ?>);" style=" cursor:pointer; display:inline-block; width:48px; height:48px; background-position:center center; background-repeat:no-repeat; background-size:cover; background-image:url(<?php echo $objPeople['strUsrPic']; ?>);"></div>
				<?php 		
				};
				?>
							<br />
			<?php
			};
			?>					
					</div>
					<div style="height:40px; background-image:url(img/bee_modal.png); background-position:center center; background-repeat:no-repeat;"></div>
				</div>
			</div>

						
<?php
unset($rstModalSticker);
?>

		</div></div>
	</div>
<?php
unset($arrLang);
unset($arrStkLang);
include('inc/close.php');
?>