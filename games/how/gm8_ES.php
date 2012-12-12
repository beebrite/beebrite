					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm8/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Cada cara del cubo es una fase en el juego.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Usa las letras del teclado para formar palabras correctas y presiona "Enter" para introducir las palabras.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							En cada fase tendrás que escribir palabras que empiecen o terminen por las letras que te indique el cubo.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							Cuando superes un nivel, el color de fondo cambiará.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador vidas te muestra las vidas disponibles. Comienzas con 3 vidas.
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador palabras te muestra todas las palabras escritas correctamente en cada fase.
			    		</div>
			    		<div id="divHowPage7" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_7.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador prefijos/sufijos te muestra las fases superadas dentro del nivel.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<7){
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
