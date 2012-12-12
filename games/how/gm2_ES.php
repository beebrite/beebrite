					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm2/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Usa el ratón para arrastrar la porción de tierra que aparece en el panel y suéltala en el hueco que elijas para formar el camino del conejo.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Date prisa y construye el camino más largo posible. Cuando el conejo se sumerja en la tierra podrás continuar colocando porciones de tierra en el camino.<br />
			    			Depende del nivel, tendrás más o menos tiempo hasta que el conejo se sumerja.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Existen 4 tipos de zanahorias:<br />
			    			-	Zanahoria normal = 1 Zanahoria normal<br />
							-	Zanahoria dorada = 5 Zanahorias normales<br />
							-	Zanahorias de tiempo = 3 Zanahorias normales + 10seg extra<br />
							-	Zanahoria congelada = 1 Zanahoria normal + 10seg extra<br />
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Cada nivel requiere que el conejo se coma un número mínimo de zanahorias para poder pasar al siguiente.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			También puedes encontrar vidas extras a lo largo de los niveles. Comienzas el juego con 5 vidas.
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Aparte de porciones de tierra, en ocasiones podrás encontrar un cepillo que te permitirá borrar una porción de tierra por si te equivocaste al colocarla.
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
