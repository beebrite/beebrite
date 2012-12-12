<?php
//define the receiver of the email
$to = 'iron_aleks@hotmail.com; aleks@beebrite.com; ';
//define the subject of the email
$subject = 'Welcome to Beebrite!'; 
//define the message to be sent. Each line should be separated with \n

$message = "<html>";
$message .= "<head>";
$message .= "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>";
$message .= "<title>Welcome to Beebrite!</title>";
$message .= "</head>";
$message .= "<body style=' background-color:#F0F0F0; font-family:Tahoma; font-weight:normal; color:#666666; margin:0px 0px 0px 0px; '>";
$message .= "<table style='margin:20px auto 0px auto;'>";
$message .= "	<tr><td colspan='2' style='text-align:center;'><img src='http://www.beebrite.com/img/email/header.png' alt='Beebrite' /></td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:28px;'>¡Hola Gonzalo!</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:13px;'>Bienvenido a Beebrite. Descubre una forma divertida de ser más inteligente</td></tr>";
$message .= "	<tr><td colspan='2' style='height:40px;'>&nbsp;</td></tr>";
$message .= "	<tr>";
$message .= "		<td style='text-align:right'><img src='http://www.beebrite.com/img/email/welcome_01.png' alt='Beebrite' /></td>";
$message .= "		<td style='padding-left:20px;'>Tu mente más brillante<span style='font-size:12px'><br />Mejora tu rendimiento cerebral<br />con juegos científicamente diseñados</span></td>";
$message .= "	</tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr>";
$message .= "		<td style='text-align:right; padding-right:20px;'>Descubre y Comparte<br />tu Progreso<span style='font-size:12px'><br />Mide tus resultados y compáralos<br />con el perfil cerebral de tus amigos</span></td>";
$message .= "		<td><img src='http://www.beebrite.com/img/email/welcome_02.png' alt='Beebrite' /></td>";
$message .= "	</tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr>";
$message .= "		<td style='text-align:right'><img src='http://www.beebrite.com/img/email/welcome_03.png' alt='Beebrite' /></td>";
$message .= "		<td style='padding-left:20px;'>Desbloquea divertidos logros<span style='font-size:12px'><br />Juega, entrena y hazte con cientos<br />de fantásticos stickers</span></td>";
$message .= "	</tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center'><a href='http://www.beebrite.com' style='height:50px; line-height:50px; text-decoration:none; background-color:#505050; border:1px solid #323232; border-radius:3px; padding:16px 15px 16px 15px; font-size:17px; color:#FFFFFF; box-shadow:inset 0px 0px 1px 1px rgba(255,255,255,0.5); margin:10px 0px 0px 0px; cursor:pointer;'>¡Entrenar Ahora!</a></td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:17px;'>¡Juega y sé brillante!</td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center'><a href='http://www.facebook.com/beebrite'><img src='http://www.beebrite.com/img/email/facebook.png' style='border:0px;'></a>&nbsp;<a href='https://twitter.com/beebrite_'><img src='http://www.beebrite.com/img/email/twitter.png' style='border:0px;'></a>&nbsp;<a href='http://pinterest.com/wearebeebrite/'><img src='http://www.beebrite.com/img/email/pinterest.png' style='border:0px;'></a></td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:10px'>Este correo electrónico se envió a duran@beebrite.com</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:10px'>¿No deseas recibir notificaciones de la actividad? <a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>Cambiar las preferencias de correo electrónico</a></td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:10px'>&copy;2012 Beebrite SL.&nbsp;|&nbsp;Todos los derechos reservados</td></tr>";
$message .= "	<tr><td colspan='2' style='text-align:center;font-size:10px'><a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>Política de privacidad</a>&nbsp;|&nbsp;<a href='http://www.beebrite.com' style='color:#505050; font-weight:bold; text-decoration:none'>Términos y condiciones</a></td></tr>";
$message .= "	<tr><td colspan='2' style='height:20px;'>&nbsp;</td></tr>";
$message .= "</table>";
$message .= "</body>";
$message .= "</html>";

//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: Beebrite <beebritebot@beebrite.com>\r\n";
$headers .= "Reply-To: beebritebot@beebrite.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";

//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>