					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm3/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Usa el ratón para encender las bombillas. Intenta encender el máximo número de bombillas.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Si tardas demasiado en encender la siguiente bombilla, el círculo de luz se irá cerrando y no podrás continuar. Además las bombillas que tengas alrededor se irán rompiendo impidiéndote continuar.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_3_es.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Existen 4 tipos de bombillas:<br />
							-	Bombilla normal  = ningún efecto<br />
							-	Bombilla congeladora = Paraliza el circulo de luz, dándote tiempo extra para encender la siguiente bombilla<br />
							-	Bombilla amplia campo de visión = Amplia el circulo de luz, pudiendo encender bombillas que estén más lejos<br />
							-	Bombilla Combo: Si enciendes 3 bombillas consecutivas de este tipo, te enciende 10 bombillas normales al total
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			También existe la batería que con solo hacer click en ella, acelera y te enciende 10 bombillas de una sola vez.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<4){
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
