					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm7/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Mira con atención para recordar la posición de las damas. Luego, desaparecerán y tendrás que recordar la posición.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Haz click con el ratón para poner las damas en la posición correcta. Ten cuidado porque el tablero puede girar!
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							Las damas que hay en la parte izquierda, indican las vidas disponibles. Comienzas con 10 vidas.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de tiempo te mostrará el tiempo transcurrido de la partida.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_5_es.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de nivel te mostrará en qué nivel y en qué fase te encuentras
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_6_es.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de damas colocadas te mostrará cuantas damas has colocado a lo largo de toda la partida.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<6){
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
