					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm6/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Escribe palabras con los grupos de letras que te aparecen.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Presiona la barra espaciadora para mezclar las letras.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Cada palabra correcta le dará gasolina al cohete. Si dejas de de escribir palabras, la barra de gasolina irá disminuyendo haciendo que el cohete se estrelle.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Con cada grupo de letras tendrás que escribir un número determinado de palabras, y, cuando las completes, te aparecerá otro grupo de letras para continuar. Mientras tanto, el cohete sigue subiendo y aumentando de altura.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
						Hay 4 niveles de altura:<br />
						-	Verde: 0 - 10.000m<br />
						-	Morado: 10.000m - 25.000m<br />
						-	Azul oscuro: 25.000m - 50.000m<br />
						-	Negro: 50.000m - 100.000m<br />
						-	Lunar: &gt; 100.000m  			
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
