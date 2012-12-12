<?php

if(isset($_GET['a'])){
	$legalarea = $_GET['a'];
}else{
	$legalarea = 1;
};

?>

<style>
.legalspacer { float: left; width: 20px; height: 51px; border-bottom: solid 1px #E1E1E1; }
.legalbuttonon { float:left; height: 50px; text-align: center; line-height: 50px; background-color: #FFFFFF; width:313px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#505050; margin: 0px -1px 20px 0px; cursor: default; border: 1px solid #E1E1E1; border-bottom: none; }
.legalbuttonoff { float:left; height: 50px; text-align: center; line-height: 50px; background-color: #F0F0F0; width:313px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#505050; margin: 0px -1px 20px 0px; cursor: pointer; border: 1px solid #E1E1E1; box-shadow: inset 0px 0px 1px 1px #FFFFFF; }
.legalcontent p { margin: 10px; }
</style>

<script>

var legalactive = <?php echo $legalarea; ?>;

function changeterms(terms){
	if(legalactive != terms){
		$('#legalserviceterms').toggle();
		$('#legalprivacypolitics').toggle();
		$('#legalbuttonterms').toggleClass('legalbuttonoff');
		$('#legalbuttonprivacy').toggleClass('legalbuttonoff');
		legalactive = terms;
	};
};

</script>

<div class="legalspacer"></div>
<div id="legalbuttonterms" class="legalbuttonon <?php if($legalarea == 2){ echo 'legalbuttonoff';} ?>" onclick="changeterms(1);">Términos del Servicio</div>
<div id="legalbuttonprivacy" class="legalbuttonon <?php if($legalarea == 1){ echo 'legalbuttonoff';} ?>" onclick="changeterms(2);">Política de Privacidad</div>
<div class="legalspacer"></div>
<br style="clear:both" />

<div id="legalserviceterms" class="legalcontent" <?php if($legalarea == 2){ echo 'style="display:none;"';} ?>>

<h1>Terminos del Servicio Beebrite</h1>
<p>1.	Al utilizar el sitio web Beebrite.com (el "Servicio"), o cualquiera de los servicios de Beebrite SL ("Beebrite"), usted acepta estar obligado por los siguientes términos y condiciones ("Términos de Servicio"). SI NO SE ACEPTA ESTE ACUERDO EN NOMBRE DE UNA EMPRESA O ENTIDAD LEGAL, MANIFIESTA QUE TIENE LA AUTORIDAD PARA VINCULAR A DICHA ENTIDAD, SUS AFILIADOS Y TODOS LOS USUARIOS QUE ACCEDER A NUESTROS SERVICIOS A TRAVÉS DE SU CUENTA CON ESTOS TÉRMINOS Y CONDICIONES, EN CUYO CASO Los términos "usted" o "suyo" se refiere a esa entidad, SUS AFILIADOS Y USUARIOS asociado a él. SI USTED NO TIENE AUTORIDAD DE TALES, O SI USTED NO ESTÁ DE ACUERDO CON ESTOS TÉRMINOS Y CONDICIONES, NO DEBE ACEPTAR ESTE ACUERDO Y NO PODRÁ UTILIZAR LOS SERVICIOS.
</p>
<p>2.	Beebrite se reserva el derecho de actualizar y modificar los Términos de Servicio de vez en cuando sin previo aviso. Cualquier función nueva que aumente o mejore el Servicio actual, incluyendo el lanzamiento de nuevas herramientas y recursos, estará sujeto a las Condiciones del servicio. El uso continuado del Servicio después de cualquier cambio constituirá su consentimiento a dichos cambios. Usted puede revisar la versión más actualizada de los Términos de Servicio en cualquier momento en: http://www.beebrite.com/terms-of-service/
</p>
<p>3.	La violación de cualquiera de los términos a continuación dará lugar a la cancelación de su cuenta. Mientras Beebrite prohíbe las conductas y Contenido en el Servicio, usted entiende y acepta que Beebrite no puede ser responsable por el Contenido publicado en el Servicio y que sin embargo puede estar expuesto a tales materiales. Usted se compromete a utilizar el Servicio bajo su propio riesgo.
</p>

<h2>A. Términos de Cuenta</h2>
<p>1. Usted debe tener 13 años o más para usar este servicio.
</p>
<p>2. Usted debe ser un ser humano. Cuentas registradas por "robots" u otros métodos automatizados no están permitidos.
</p>
<p>3. Usted debe proporcionar su nombre legal completo, una dirección válida de correo electrónico y cualquier otra información solicitada para completar el proceso de registro.
</p>
<p>4. Su nombre de usuario sólo puede ser utilizado por una sola persona - un inicio de sesión único compartido por varias personas no está permitido. Usted puede crear los inicios de sesión por separado para tantas personas como su plan lo permite.
</p>
<p>5. Usted es responsable de mantener la seguridad de su cuenta y contraseña. Beebrite no puede y no será responsable por cualquier pérdida o daño causado por el incumplimiento de esta obligación de seguridad.
</p>
<p>6. Usted es responsable de todo el Contenido enviado o actividad que ocurra bajo su cuenta (incluso cuando el contenido es publicado por otros que tienen cuentas en su cuenta).
</p>
<p>7. Una persona física o jurídica no podrá mantener más de una cuenta gratuita.
</p>
<p>8. Usted no puede usar el Servicio para cualquier propósito ilegal o no autorizado. Usted no debe, en el uso del Servicio, violar ninguna ley en su jurisdicción (incluyendo pero no limitado a derechos de autor o leyes de marca registrada).
</p>

<h2>B. Pago, Reembolsos, y Términos Referentes a Mejorar o Rebajar el estado de tu Cuenta
</h2>
<p>1. Todos los planes de pago debe introducir una tarjeta de crédito válida. Las cuentas gratuitas no están obligados a proporcionar un número de tarjeta de crédito.
</p>
<p>2. Una actualización de la planta libre al plan Premium inmediatamente le facturará.
</p>
<p>3. El servicio se cobra por adelantado en forma mensual y no es reembolsable. No habrá reembolsos o créditos por meses parciales de servicio, actualizar / downgrade devoluciones, ni reembolsos por meses no utilizados en una cuenta abierta. Con el fin de tratar a todos por igual, no se harán excepciones. Como se considera que el suscriptor tiene la oportunidad de evaluar a fondo el Servicio durante el período de prueba, las suscripciones posteriormente comprados no son reembolsables.
</p>
<p>4. Las tarifas no incluyen todos los impuestos, gravámenes o tasas impuestas por las autoridades fiscales, y usted será responsable del pago de todos los impuestos, tasas o gravámenes, incluido el IVA y / o impuestos sobre las ventas equivalente.
</p>
<p>5. Para cualquier actualización o disminución en el nivel del plan, su tarjeta de crédito que proporciona automáticamente se cargará la nueva tasa en su próximo ciclo de facturación.
</p>
<p>6. Bajar la versión de su servicio puede causar la pérdida de contenido, características o capacidades en su Cuenta. Beebrite no acepta ninguna responsabilidad por dicha pérdida.
</p>

<h2>C. Términos y Condiciones de la Nueva oferta de Prueba Gratuita de 30 Días de Beebrite Premium
</h2>
<p>Esta oferta (la “Nueva oferta de Prueba Gratuita de 30 Días”) que le hace, le legitima a acceder al Servicio Beebrite Premium (según la definición que figura en los Términos y Condiciones de Uso Beebrite) durante un periodo de treinte (30) días a partir del momento en el que usted active dicho periodo de prueba enviando sus datos de pago (el “Periodo de Prueba Gratuita”). Al enviar sus datos de pago, usted acepta la Nueva oferta de Prueba Gratuita de 30 Días y (i) consiente que utilicemos sus datos de pago de conformidad con nuestra Política de Privacidad, (ii) asume y acepta los Términos y Condiciones de Uso de Beebrite y los presentes Términos y Condiciones Generales de la Prueba Gratuita del Servicio Beebrite Premium. En caso de que decida que no quiere convertirse en usuario de pago del Servicio Beebrite Premium una vez acabe el Periodo de Prueba Gratuita, deberá rescindir su Servicio Premium (visita “Configuracion”, y “Suscripcion” en tu pagina de Beebrite) antes de que finalice el Periodo de Prueba Gratuita. Únicamente podrá utilizar esta Oferta de Prueba Gratuita una vez. Beebrite se reserva el derecho, a la entera discreción de Beebrite, de retirar o modificar esta Oferta de Prueba Gratuita y/o los Términos y Condiciones de la Nueva oferta de Prueba Gratuita de 30 Días de Beebrite en cualquier momento sin aviso previo y sin responsabilidad alguna.
</p>

<h2>D. Cancelación y Terminación
</h2>
<p>1. Usted es el único responsable de la correcta cancelación de su cuenta. Una solicitud por correo electrónico o por teléfono para cancelar su cuenta no se considera cancelación. Usted puede cancelar su cuenta en cualquier momento haciendo clic en el menú Configuración y hacer clic en el enlace de Membresía.
</p>
<p>2. Todo su contenido será inmediatamente eliminada a partir del momento de cancelación. Esta información no se puede recuperar una vez que su cuenta se ha cancelado.
</p>
<p>3. Si cancela el servicio antes de que finalice el mes en curso pagado, la cancelación entrará en vigencia inmediatamente y no se le cobrará de nuevo.
</p>
<p>4. Beebrite, a su sola discreción, tiene el derecho de suspender o terminar su cuenta y negarle el uso presente o futuro del Servicio, o cualquier otro servicio Beebrite, por cualquier razón y en cualquier momento. La terminación del Servicio dará lugar a la desactivación o eliminación de su cuenta o su acceso a su cuenta, y el decomiso y la renuncia de todo el contenido en su cuenta. Beebrite se reserva el derecho de rechazar prestar el servicio a cualquier persona por cualquier razón y en cualquier momento.
</p>

	
<h2>E. Modificaciones del Servicio y Precios
</h2>
<p>1. Beebrite se reserva el derecho en cualquier momento y de vez en cuando a modificar o interrumpir, temporal o permanentemente, el Servicio (o cualquier parte del mismo) con o sin previo aviso.
</p>
<p>2. Los precios de todos los servicios, incluyendo pero no limitado a las cuotas de suscripción mensuales del plan al servicio, están sujetas a cambios con 30 días de antelación de nosotros. Dicha notificación se puede proporcionar en cualquier momento mediante la publicación de los cambios en el sitio Beebrite (beebrite.com) o el propio Servicio.
</p>
<p>3. Beebrite no será responsable ante usted ni ante ningún tercero por cualquier modificación, cambio de precio, suspensión o interrupción del Servicio.
</p>


<h2>F. Derechos de Autor y Propiedad del Contenido
</h2>
<p>1. No reclamamos los derechos de propiedad intelectual sobre el material que usted proporcione al Servicio. Su perfil y materiales subidos siguen siendo tuyo. Sin embargo, mediante el establecimiento de sus páginas para ser vistos públicamente, usted se compromete a permitir que otras personas vean su contenido. Al establecer sus repositorios para ser visto en público, usted se compromete a permitir a otros ver y desembolsar sus repositorios.
</p>
<p>2. Beebrite no pre-selecciona el Contenido, pero Beebrite y sus designados tendrán el derecho (pero no la obligación) a su entera discreción, de rechazar o remover cualquier Contenido que esté disponible por medio del Servicio.
</p>
<p>3. Usted defenderá Beebrite en contra de cualquier reclamo, demanda, juicio o procedimiento hecho o presentado contra Beebrite por un tercero alegando que su contenido o su uso del Servicio en violación de este Contrato, infringe o viola los derechos de propiedad intelectual de un tercero o que viole las leyes aplicables, y deberá indemnizar Beebrite de los daños finalmente adjudicados en contra, y los honorarios razonables de abogados incurridos por, Beebrite en relación con cualquier reclamación, demanda, juicio o procedimiento, siempre que, que Beebrite (a) inmediatamente da aviso por escrito de la reclamación, demanda, juicio o procedimiento, (b) le otorga el control exclusivo de la defensa y la resolución de la reclamación, demanda, juicio o procedimiento (siempre y cuando usted no puede resolver cualquier reclamación, demanda, juicio o procedimiento a menos que el acuerdo sin condiciones Beebrite comunicados de toda responsabilidad), y (c) proporciona a usted toda la asistencia razonable, a su cargo.
</p>
<p>4. La mirada y la sensación del Servicio es copyright © 2012 Beebrite SL Todos los derechos reservados. Usted no puede duplicar, copiar, reutilizar o cualquier porción del HTML / CSS, Javascript, o elementos de diseño visual o conceptos sin el permiso expreso por escrito de Beebrite.
</p>

<h2>G. Condiciones Generales
</h2>
<p>1. La utilización del servicio es bajo su propio riesgo. El servicio se proporciona "tal cual" y "según esté disponible".
</p>
<p>2. El soporte técnico sólo se ofrece a pagar los titulares de cuentas y sólo está disponible a través de correo electrónico. El soporte está disponible en Inglés y Español.
</p>
<p>3. Usted entiende que Beebrite utiliza proveedores y partners de hosting para proporcionar el hardware, software, redes, almacenamiento y tecnología necesaria para ejecutar el servicio.
</p>
<p>4. Usted no debe modificar, adaptar o hackear el Servicio o modificar otro sitio web para implicar falsamente que está asociado con el Servicio, Beebrite, o cualquier otro servicio Beebrite.
</p>
<p>5. Usted se compromete a no reproducir, duplicar, copiar, vender, revender o explotar cualquier parte del Servicio, uso del Servicio o acceso al Servicio sin el expreso permiso por escrito por Beebrite.
</p>
<p>6. Podemos, pero no tienen la obligación, a retirar cualquier Contenido y cuentas que contengan contenido que consideremos, según nuestro criterio, delictivo, ofensivo, amenazante, calumnioso, difamatorio, pornográfico, obsceno o de dudosa reputación o viole la propiedad intelectual de cualquiera de las partes o estas Condiciones del servicio .
</p>
<p>7. Verbal, abuso físico, escrito o de otra índole (incluyendo amenazas de abuso o castigo) de cualquier cliente Beebrite, empleado, miembro o funcionario dará lugar a la terminación inmediata de la cuenta.
</p>
<p>8. Usted entiende que el procesamiento técnico y transmisión del Servicio, incluyendo su Contenido, puede ser transferido sin encriptar e involucrar (a) transmisiones a través de varias redes y (b) cambios para conformarse y adaptarse a los requisitos técnicos de conexión de redes o dispositivos.
</p>
<p>9. Beebrite no garantiza que (i) el servicio se adapte a sus necesidades específicas, (ii) el servicio será ininterrumpido, puntual, seguro, o libre de errores, (iii) los resultados que puedan obtenerse del uso del servicio se precisa o fiable, (iv) la calidad de cualquier producto, servicio, información u otro material comprado u obtenido por usted a través del servicio cumpla con sus expectativas, y (v) cualquier error en el servicio serán corregidos.
</p>
<p>10. Usted expresamente entiende y acepta que Beebrite no será responsable de los daños directos, indirectos, incidentales, especiales, consecuenciales o punitivos, incluyendo pero no limitado a, daños por pérdida de ganancias, clientela, uso, datos u otras pérdidas intangibles (incluso si Beebrite ha sido advertido de la posibilidad de tales daños), resultantes de: (i) el uso o la imposibilidad de utilizar el servicio, (ii) el costo de adquisición de bienes y servicios sustitutivos de los bienes, datos, información o servicios adquiridos u obtenidos o mensajes recibidos o transacciones realizadas a través o desde el servicio, (iii) el acceso no autorizado o alteración de sus transmisiones o datos; (iv) declaraciones o conductas de cualquier tercero en el servicio, (v) o cualquier otro cualquier asunto relacionado con el servicio.
</p>
<p>11. El fracaso de Beebrite para ejercer o hacer valer cualquier derecho o disposición de estas Condiciones del servicio no constituirá una renuncia a tal derecho o disposición. Los Términos de Servicio constituyen el acuerdo completo entre usted y Beebrite y gobiernan su uso del Servicio y reemplaza cualquier acuerdo anterior entre usted y Beebrite (incluyendo, pero no limitado a, cualquier versión previa de los Términos de Servicio). Usted acepta que estas Condiciones de servicio y su uso del Servicio se rigen por Madrid (España) la ley.
</p>
<p>12. Las preguntas sobre las Condiciones del servicio deben ser enviadas a support@beebrite.com.
</p>
<p>El servicio es operado y proporcionada por Beebrite SL, Paseo del Club Deportivo, 1, Edif.15A, Pozuelo de Alarcón, 28223, Madrid, España. Teléfono +34 912 97 97 39.
</p>

	
<h5>Versión: Octubre 2012
</h5>

</div>

<div id="legalprivacypolitics" class="legalcontent" <?php if($legalarea == 1){ echo 'style="display:none;"';} ?>>

<h1>Política de Privacidad de Beebrite
</h1>

<p>Beebrite SL es una empresa española, con domicilio social en Paseo del Club Deportivo, 1, Blq15A, CP 28223, Pozuelo de Alarcón, Madrid, España.
</p>
<p>Tomamos tu privacidad muy en serio. Esta Política de privacidad se aplica al sitio www.beebrite.com.
</p>

<h2>El registro a través de Facebook Connect
</h2>
<p>Aplicaciones Beebrite pertenecen a Beebrite SL y, a pesar de que se integren en la plataforma social de Facebook, Facebook Inc. y Beebrite SL son empresas diferentes e independientes.</p>
<p>Al suscribirse a una aplicación desarrollada y mantenida por Beebrite SL a través de Facebook Connect, usted acepta la política de privacidad de Facebook, que está estrictamente cumplido por Beebrite SL. (Http://developers.facebook.com/policy/)
</p>
<p>Los datos personales obtenidos de Facebook será tratado exactamente como si nos hubiera provisto de ellos a través de nuestro formulario de registro, por lo que se puede esperar de las medidas de seguridad más estrictas que deben aplicarse a la información.
</p>

<h2>Información General
</h2>
<p>Recopilamos las direcciones de correo electrónico de quienes se comunican con nosotros vía e-mail, información agregada sobre qué páginas acceden o visitan los consumidores, y la información ofrecida voluntariamente por el consumidor (como información de encuestas y / o registros en el sitio). La información que recogemos se utiliza para mejorar el contenido de nuestras páginas Web y la calidad de nuestro servicio, y no es compartida con o vendida a otras organizaciones para propósitos comerciales, excepto para proporcionar productos o servicios que usted ha solicitado, cuando tenemos su permiso, o bajo las siguientes circunstancias:
</p>
<p>• Es necesario compartir información para investigar, prevenir o tomar acción respecto a actividades ilegales, sospecha de fraude, situaciones que implican amenazas potenciales a la seguridad física de cualquier persona, violaciónes de las Condiciones del servicio, o como sea requerido por la ley.
</p>
<p>• Transferimos información sobre usted si Beebrite es adquirida o fusionada con otra empresa. En este caso, Beebrite le notificará antes de que su información sea transferida y se convierte en objeto de una política de privacidad diferente.
</p>

<h2>Recogida y uso de Informacion
</h2>
<p>Cuando usted se registra para Beebrite le solicitamos información tal como su nombre, dirección de correo electrónico, dirección de facturación, información de tarjeta de crédito. Los miembros que se inscriban en la cuenta gratuita no es necesario introducir una tarjeta de crédito.
</p>
<p>Beebrite utiliza la información recopilada para los siguientes propósitos generales: productos y prestación de servicios, facturación, identificación y autenticación, mejora de los servicios, el contacto y la investigación.
</p>
<h2>Cookies
</h2>
<p>• Una cookie es una pequeña cantidad de datos, que a menudo incluye un identificador único anónimo que es enviado a su navegador desde un sitio web y se almacena en el disco duro de su ordenador.
</p>
<p>• Las cookies están obligadas a utilizar el servicio Beebrite.
</p>
<p>• Utilizamos cookies para registrar información de la sesión actual, pero no utiliza cookies permanentes. Usted está obligado a volver a acceder a su cuenta Beebrite después de un cierto período de tiempo transcurrido para protegerse contra el acceso accidental a otros contenidos de su cuenta.
</p>


<h2>Almacenamiento de datos
</h2>

<p>Beebrite utiliza proveedores y partners de hosting para proporcionar el hardware, software, redes, almacenamiento y tecnología necesaria para ejecutar Beebrite. Aunque Beebrite propietaria del código, bases de datos, y todos los derechos de la aplicación Beebrite, usted conserva todos los derechos sobre sus datos.
</p>

<h2>Revelación
</h2>
<p>Beebrite puede revelar información personal bajo circunstancias especiales, como por ejemplo cumplir con citaciones o cuando sus acciones violan las Condiciones de Servicio.
</p>

<h2>Cambios
</h2>
<p>Beebrite puede actualizar periódicamente esta política. Le notificaremos acerca de cambios significativos en la forma en que tratamos la información personal mediante el envío de una notificación a la dirección de correo electrónico principal especificada en su cuenta principal Beebrite titular de la cuenta o colocando un aviso prominente en nuestro sitio.
</p>

<h2>Preguntas
</h2>
<p>Cualquier pregunta sobre esta Política de Privacidad deben dirigirse a support@beebrite.com.
</p>

<h5>Versión: Octubre 2012
</h5>

</div>