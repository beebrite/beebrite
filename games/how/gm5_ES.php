					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm5/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Usa el ratón y arrastra la cuerda hacia abajo para comenzar la partida.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Hay 3 tipos de pájaros:<br />
							-	Pájaro Rojo come semilla<br />
							-	Águila come carne<br />
							-	Pájaro Negro no come, solo distrae
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Tienes las semillas y la carne justa para alimentar a todos los pájaros del nivel. Recuerda, solo puedes alimentar a cada uno solo una vez. No pierdas de vista a los pájaros que ya has alimentado.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Tendrás que esperar unos segundos hasta que puedas alimentar al siguiente pájaro.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Comienzas la partida con 4 vidas
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Pajaro bien alimentado: Contorno Verde<br />
							Pajaro mal alimentado: Contorno Rojo y Cruz Roja de Error
			    		</div>
			    		<div id="divHowPage7" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_7.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Recuerda, no alimentes a los pájaros negros. Solo están para distraer.
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
