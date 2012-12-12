<?php
require_once('inc/open_conn.php');
include('inc/func.php');

	$arrLang = getLangArray('stickermodal.php',$_GET['uLang']);
	$strSql = "SELECT COUNT(*) FROM tbl_usr_comments WHERE intSticker = " . $_GET['sId'] . " ";
	if(mysql_result($rstModalSticker,0,7)==0){
		$strSql .= "AND intStkOwner = " . $_GET['vId'] . " ";
	};
	$strSql .= "AND intId < " . $_GET['iLast'] . ";";
	$rstCommC = mysql_query($strSql);
	if(mysql_result($rstCommC,0,0)>0){
		$strSql = "SELECT a.intId, a.strComment, CONCAT(b.strName,' ',b.strLastName) AS 'Name', b.strNick, b.strUsrPic, UNIX_TIMESTAMP(a.dteTimeStamp) as UNIXDate ";
		$strSql .= "FROM tbl_usr_comments a, cat_users b ";
		$strSql .= "WHERE a.intSticker = " . $_GET['sId'] . " ";
		if(mysql_result($rstModalSticker,0,7)==0){
			$strSql .= "AND a.intStkOwner = " . $_GET['vId'] . " ";
		};
		$strSql .= "AND a.intUser = b.intId ";
		$strSql .= "AND a.intId < " . $_GET['iLast'] . " ";
		$strSql .= "ORDER BY a.dteTimeStamp DESC LIMIT 6;";
		$rstComments = mysql_query($strSql);
		while ($objDataComm = mysql_fetch_array($rstComments))
		{
			$intBtnCnt++;
			?>
					<div style="min-height:50px; padding:0px 0px 5px 0px; border-bottom:1px #F1F1F1 solid; margin:5px 19px 0px 19px;">
						<div onclick="window.parent.location='<?php echo $objDataComm['strNick']; ?>'" style=" cursor:pointer; float:left; width:50px; height:50px; background-image:url('<?php echo str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$objDataComm["strUsrPic"])); ?>'); background-position:center center; background-repeat:no-repeat; background-size:cover"></div>
						<div style=" float:left; padding-left:10px; text-align:left; width:399px; ">
							<a onclick="window.parent.location='<?php echo $objDataComm['strNick']; ?>'"><?php echo $objDataComm['Name'];?></a>
							<span style="float:right;color:#C8C8C8; font-size:10px; ">
								<?php echo hace($objDataComm['UNIXDate'],$arrLang['secondsago'],$arrLang['minutesago'],$arrLang['hoursago'],$arrLang['daysago'],$arrLang['monthsago'],$arrLang['yearsago']); ?>
							</span>
							<br />
							<?php echo $objDataComm['strComment'];?>
						</div>
						<br style="clear:both" />
					</div>
			<?php
		};
		if(mysql_result($rstCommC,0,0)>6){
		?>
			<input onclick="ShowHC(<?php echo $_GET['sId']; ?>,<?php echo $_GET['vId']; ?>,<?php echo mysql_result($rstComments,mysql_num_rows($rstComments) - 1,0); ?>); " id="btnMHC_<?php echo mysql_result($rstComments,mysql_num_rows($rstComments) - 1,0); ?>" type="button" value="See Older Posts" style="display:block; width:460px; height:36px; color:#505050; font-family:Tahoma; font-size:12px; margin:10px 0px 0px 20px; padding:3px 10px 3px 10px; background-color:#F0F0F0; border:solid 1px #E1E1E1; text-align:center; border-radius:3px; box-shadow:inset 0px 0px 1px 0px #FFFFFF; text-shadow:0px 1px 0px #FFFFFF; cursor:pointer;" />
		<?php
		};
		unset($rstComments);
	};
	unset($rstCommC);
	unset($arrLang);

mysql_close($con);
?>