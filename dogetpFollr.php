<?php
include('inc/open_conn.php');
include('inc/func.php');

$vId = $_POST['vId'];
$uId = $_POST['uId'];
$uLang = $_POST['uLang'];
$blnActions = $_POST['blnActions'];
$arrLang = getLangArray('profile.php',$uLang);

$strSql = "SELECT * FROM cat_users a, cat_countries b WHERE a.intId = " . $vId . " AND a.strCountry = b.strCode;";
$rstUsrProfile = mysql_query($strSql);

	$strSql = "SELECT * FROM cat_users WHERE intId IN (SELECT intUser FROM tbl_usr_friendship WHERE intFriend = " . $vId . ")";
	$rstUsrs = mysql_query($strSql);
	if (mysql_num_rows($rstUsrs) > 0){
		while ($objUsrs = mysql_fetch_array($rstUsrs))
		{
			$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intFriend = " . $objUsrs['intId'] . ";";
			$rstFriend = mysql_query($strSqlF);
			while ($objDataFriend = mysql_fetch_array($rstFriend))
			{
				$intFollowers = $objDataFriend[0];
			};
			$strSqlF = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $objUsrs['intId'] . ";";
			$rstFriend = mysql_query($strSqlF);
			while ($objDataFriend = mysql_fetch_array($rstFriend))
			{
				$intFollowing = $objDataFriend[0];
			};
	?>
					<div class="cont_box">
						<div>
							<div class="usr_photo" onclick="window.location = '<?php echo $objUsrs['strNick']; ?>'; " style=" cursor:pointer; background-image:url(<?php echo $objUsrs['strUsrPic']; ?>); background-position:center center; background-repeat:no-repeat; background-size:cover"></div>
							<div class="usr_data">
								<img src="img/follow_00.png">&middot;&nbsp;<?php echo number_format($objUsrs['intLevel']); ?>
								<img src="img/follow_01.png">&middot;&nbsp;<?php echo number_format($objUsrs['intBBI']); ?>
								<br />
								<img src="img/follow_02.png">&middot;&nbsp;
								<?php
								if($objUsrs['intTime']>9999){
									echo "9,999 +";
								}else{
								 	echo number_format($objUsrs['intTime']) . " ms";
								};
								?>
								<div class="usr_foll">
								<?php echo $arrLang['txtFollowers']; ?>&nbsp;<?php echo number_format($intFollowers); ?>
								&nbsp;&middot;&nbsp;
								<?php echo $arrLang['txtFollowing']; ?>&nbsp;<?php echo number_format($intFollowing); ?>
								</div>
							</div>
							<br style="clear:both" />
					        <div style="float:right; padding-top:6px;">
					        <?php
					        if($blnActions){
					        	if($objUsrs['intId']!=$uId){
									$strSql = "SELECT COUNT(*) FROM tbl_usr_friendship WHERE intUser = " . $uId . " AND intFriend = " . $objUsrs['intId'] . ";";
									$rstToFollow = mysql_query($strSql);
									if(mysql_result($rstToFollow, 0, 0)==0){
									?>
										<input onclick="DoFollow('btnFollow_<?php echo $uId; ?>_<?php echo $objUsrs['intId']; ?>_3', 36,<?php echo $uId; ?>, <?php echo $objUsrs['intId']; ?>, '<?php echo $arrLang['btnFollow']; ?>', '<?php echo $arrLang['btnUnFollow']; ?>');" type="button" id="btnFollow_<?php echo $uId; ?>_<?php echo $objUsrs['intId']; ?>_3" value="<?php echo $arrLang['btnFollow']; ?>" class="dark_36px" style=" display:inline-block; position:relative; margin:0px 0px 0px 0px; ">
									<?php
									}else{
									?>
										<input onclick="DoFollow('btnFollow_<?php echo $uId; ?>_<?php echo $objUsrs['intId']; ?>_3', 36,<?php echo $uId; ?>, <?php echo $objUsrs['intId']; ?>, '<?php echo $arrLang['btnFollow']; ?>', '<?php echo $arrLang['btnUnFollow']; ?>');" type="button" id="btnFollow_<?php echo $uId; ?>_<?php echo $objUsrs['intId']; ?>_3" value="<?php echo $arrLang['btnUnFollow']; ?>" class="clear_36px" style=" display:inline-block; position:relative; margin:0px 0px 0px 0px; ">
									<?php
									};
									unset($rstToFollow);
					        	};
					        };
					        ?>
					        </div>
							<div class="usr_name"><a href="<?php echo $objUsrs['strNick']; ?>"><?php echo $objUsrs['strName'] . " " . substr($objUsrs['strLastName'],0,1); ?>.&nbsp;<span><?php echo $objUsrs['strNick']; ?></span></a></div>
					  	</div>
					</div>
		
	<?php
		};
	?>
				<br style="clear:both" />
	<?php
	}else{
	?>
				<br />
				<img src="img/sadface.png" />
				<br />
				<?php echo $arrLang['nofollowers']; ?>
	<?php
	};

unset($arrLang);
unset($rstUsrProfile);
mysql_close($con);
?>