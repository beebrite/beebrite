<?php
include('inc/open_conn.php');
include('inc/func.php');
if($_COOKIE['uLang']){
	$uLang = $_COOKIE['uLang'];
}else{
	$userhttp = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$userlang = explode('-',$userhttp); 
	$uLang = $userlang[0];
	if($uLang != 'es')
	{
		$uLang = "EN";
	}
	else
	{
		$uLang = "ES";
	}
	setcookie('uLang', $uLang , time()+86400, "/");
};
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
<link href="css/landing.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/beebrite.js"></script>
</head>
<?php $arrLang = getLangArray('about.php',$uLang); ?>
<body>
    <div id="header" class="header">
        <div class="center_960">
            <a href="login.php" class="loginbutton border_4" style="font-weight:normal;"><?php echo $arrLang['loginbutton']; ?></a>
            <div id="logo">
                <img src="img/beebrite_logo.png" height="80" width="246" alt="Beebrite.com" />
            </div>
        </div>
    </div>
	<!--WORK AREA-->
	<div style=" width:100%;margin:0px auto 0px auto" id="divMainWA">
		<div id="divInvite" style="width:930px; border:1px #E1E1E1 solid; margin:0px auto 0px auto;background-color:#FFFFFF;padding:22px 14px 22px 14px">
			<div style="font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; border-bottom:1px #EBEBEB solid; padding-left:17px; padding-bottom:19px;margin-bottom:18px">
				<?php echo $arrLang['abouttitle']; ?>
			</div>
			<div style="float:left; width:200px; padding-top:18px; z-index:2; position: relative">
				<div onclick="window.location='iabout.php';" id="btnAbout01" class="button_nonsel" style=" background-image:url(img/about_whatis.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu01']; ?></div>
				<div onclick="window.location='iabout_help.php';" id="btnAbout02" class="button_nonsel" style="background-image:url(img/about_help.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu02']; ?></div>
				<div onclick="window.location='iabout_support.php';" id="btnAbout03" class="button_nonsel" style="background-image:url(img/about_support.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu03']; ?></div>
				<!--div onclick="window.location='iabout_buttons.php';" id="btnAbout04" class="button_nonsel" style="background-image:url(img/about_buttons.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu04']; ?></div-->
				<div onclick="window.location='iabout_team.php';" id="btnAbout05" class="button_nonsel" style="background-image:url(img/about_team.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu05']; ?></div>
				<div onclick="window.location='iabout_careers.php';" id="btnAbout06" class="button_nonsel" style="background-image:url(img/about_job.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu06']; ?></div>
				<div onclick="window.location='iabout_blog.php';" id="btnAbout07" class="button_nonsel" style="background-image:url(img/about_blog.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu07']; ?></div>
				<div onclick="window.location='iabout_contact.php';" id="btnAbout08" class="button_sel" style="background-image:url(img/about_contact.png);background-position:165px center;background-repeat:no-repeat; "><?php echo $arrLang['menu08']; ?></div>
				<div onclick="window.location='iabout_legal.php';" id="btnAbout09" class="button_nonsel" style="background-image:url(img/about_terms.png);background-position:165px center;background-repeat:no-repeat; border-bottom:1px #E1E1E1 solid"><?php echo $arrLang['menu09']; ?></div>
			</div>
			<div id="divMainSettings" style=" width:670px; display:block; float:left; border-left:1px #E1E1E1 solid; min-height:650px; margin:0px 0px 0px -1px; padding-left:38px; padding-top:23px; z-index:1; position: relative; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:28px; color:#505050; ">
				<div id="divAbout01" class="div_invite" style="display:block; ">
					<?php echo $arrLang['menu08']; ?>
					<div style=" text-align:justify; font-family:Tahoma; line-height:20px; font-size:12px; font-weight:normal; margin:20px 0px 0px 0px; ">
					
					<?php if($uLang == 'ES') { ?>
					
					<div style=" text-align:left; font-family:Tahoma; line-height:20px; font-size:12px; font-weight:normal; margin:20px 0px 0px 0px; ">
						¡Gracias por usar Beebrite! Puedes contactar con nosotros sobre cualquier tema general a través de <strong>hello@beebrite.com</strong>. Aquí tienes cómo contactar con nosotros para lo demás:
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_help.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Ayuda</h2>
							<p>¿Tienes alguna pregunta o problema con Beebrite? Si necesitas una respuesta inmediata, visita nuestra sección “Acerca de”, donde compartimos soluciones para todo tipo de problemas comunes y toda la ayuda relativa al juego en el apartado “Help”. Si no encuentras allí tu respuesta, envíanos tus dudas a <strong>support@beebrite.com</strong> o tuitea a <strong>@BeebriteSupport.</strong></p>
						</div>
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_press.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Prensa y Comunicación</h2>
							<p>Si estás escribiendo un artículo sobre Beebrite, un reportaje, o quieres algún tipo de entrevista con algunos de nosotros, este es el sitio para empezar. Puedes acudir a nuestra página “Acerca de”, la cual contiene toda la información sobre la empresa, información sobre los juegos, el enlace a nuestro blog… Creemos que ahí encontrarás todo lo que necesitas, pero si no es así, puedes ponerte en contacto con nosotros a través de este mail: <strong>social@beebrite.com</strong></p>
						</div>
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_jobs.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Trabaja en Beebrite</h2>
							<p>En Beebrite buscamos mejorar continuamente. Por ello, siempre estamos dispuestos a conocer nuevos profesionales y puntualmente ofrecer nuevos puestos de trabajo. Buscamos profesionales simpáticos, divertidos, creativos y brillantes, y con muchas ganas de aportar en el área que necesitemos. Las necesidades de profesionales abarcan todo tipo de áreas. Consulta nuestra página de “Empleo” para obtener una lista de los puestos vacantes en cada momento, o ponte en contacto con nosotros a través de <strong>jobs@beebrite.com</strong></p>
						</div>
					</div>
					<div style="padding:40px 0px 30px 0px">
						<strong>Beebrite SL</strong><br/>
						Paseo del Club Deportivo, 1, Bloque 15A, Pozuelo de Alarcón, 28223, Madrid, Spain<br/>
						Teléfono +34 912 97 97 39.
					</div>
					
					<?php } else { ?>
					
					<div style=" text-align:left; font-family:Tahoma; line-height:20px; font-size:12px; font-weight:normal; margin:20px 0px 0px 0px; ">
						Thanks for using foursquare! You can contact with us for talk about any general topic through <strong>hello@beebrite.com</strong>. Here's how to get in touch with us for the rest of the topics:
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_help.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Help</h2>
							<p>Do you have a question or are you having trouble with Beebrite? If you’re looking for an answer right away, check out our section “About” in the User Menu, wher we share solutions for all sorts of common issues and all the relative help to the game in the section “Help”. If you don’t find your answer there, submit a question to <strong>support@beebrite.com</strong>, or  tweet <strong>@BeebriteSupport</strong>.</p>
						</div>
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_press.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Press and Communication Inquiries</h2>
							<p>If you’re working on a piece about Beebrite, an article, a feature or you are looking for any kind of interview with Beebrite Team, this is the place to get started. You can visit our page “About”, which contains all info about the company, pictures for download, info about the games, link to the Beebrite Blog…We think you can find there all you can need, but if it not, you can get in touch with us through this email: <strong>social@beebrite.com</strong></p>
						</div>
						<div style="padding:0px 40px 0px 160px; margin:40px 0px 0px 0px; background-image:url(../../img/about_contact_jobs.png); background-repeat:no-repeat; background-position:40px center;">
							<h2>Jobs</h2>
							<p>At Beebrite we try to improve constantly. For this, always we´re ready to know new professionals and  possibly offer new jobs. We are always looking for sympa and fun workers, smart and creative people with great wish for contribute at the areas where we need. Check out our “Jobs” page for a list of open positions in each moment, or get in touch with us through <strong>jobs@beebrite.com</strong>!</p>
						</div>
					</div>
					<div style="padding:40px 0px 30px 0px">
						<strong>Beebrite SL</strong><br/>
						Paseo del Club Deportivo, 1, Bloque 15A, Pozuelo de Alarcón, 28223, Madrid, Spain<br/>
						Phone +34 912 97 97 39.
					</div>
					
					<?php }; ?>
					
					</div>
				</div>
			</div>
			<br style="clear:both" />
		</div>
	</div>
	<!--MAIN WORK AREA-->
	<div style="margin:40px 0px 0px 0px; padding:0px 0px 40px 0px;">
        <div >
        	<div style="text-align:center">
					<div style="display:inline; position:relative">
						<a onclick="$('#divChangeLanguage').show();" style="cursor:pointer"><?php echo $arrLang['langlink']; ?></a>
						<div onclick="$('#divChangeLanguage').hide();" id="divChangeLanguage" style="position:absolute; display:none; width:auto; height:auto; top:-80px; left:0px; background-color:#FFFFFF; border:solid 1px #B4B4B4; text-align:left; padding:4px 10px 4px 10px; line-height:28px; font-size:11px; border-radius:3px 3px 3px 3px;">
							<strong><?php echo $arrLang['langlink']; ?></strong>
							<br />
							<a onclick="ChangeLang('<?php echo $arrLang['langchangeval']; ?>')" style=" font-weight:normal; cursor:pointer" ><?php echo $arrLang['langchange']; ?></a>
							<img style="position:absolute; top:64px; left:10px; z-index:21" src="img/notif_down.png" />
						</div>
					</div>
					<script type="text/javascript" src="js/jquery.cookie.js"></script>
					<script>
						function ChangeLang($strNewLang){
							$.cookie("uLang", $strNewLang);
							$strLocation = window.location;
							window.location = $strLocation;
						}
					</script>&nbsp;.&nbsp;
                    <a href="iabout.php"><?php echo $arrLang['aboutlink']; ?></a>&nbsp;.&nbsp;
                    <a href="iabout_blog.php"><?php echo $arrLang['bloglink']; ?></a>&nbsp;.&nbsp;
                    <a href="iabout_contact.php"><?php echo $arrLang['contactlink']; ?>&nbsp;.&nbsp;
                    <a href="/terms-of-service"><?php echo $arrLang['termslink']; ?></a>&nbsp;.&nbsp;
                    <a href="/privacy-policy"><?php echo $arrLang['privacylink']; ?></a>&nbsp;.&nbsp;
                    <strong><?php echo $arrLang['mapslink']; ?></strong>
                <div class="copyright">©2012 Beebrite SL . All Rights Reserved</div>            
            </div>
        </div>
	</div>
<script>
<?php unset($arrLang); ?>
changeStats(<?php echo $uId; ?>);
</script>
</body>
</html>
