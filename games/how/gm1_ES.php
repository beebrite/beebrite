					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm1/step_1_es.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Cada cuadrante del reloj tiene a su lado "+", "-", "Par", "Impar"
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Dentro de cada cuadrante te aparecerá un numero o una operación positiva o negativa
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Usa las teclas (derecha (SI) y la tecla izquierda (NO) de tu teclado o el ratón para elegir la respuesta correcta.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			A medida que respondas correctamente, las indicaciones "+", "-", "Par", "Impar" de cada cuadrante irán desapareciendo haciendo que tengas que recordar la posición de todas ellas.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			El indicador de vidas muestra las vidas disponibles y el indicador del reloj muestra el tiempo restante. Comienzas con 5 vidas y 120 segundos.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<5){
							$('#divHowPage' + $intHowPage).fadeOut('fast',function(){
								$intHowPage++;
								$('#divHowPage' + $intHowPage).fadeIn('fast');
							});
						};
					};
					
					function PrevPage(){
						if ($intHowPage>1){
							$('#divHowPage' + $intHowPage).fadeOut('fast',function(){
								$intHowPage--;
								$('#divHowPage' + $intHowPage).fadeIn('fast');
							});
						};
					};
					</script>
