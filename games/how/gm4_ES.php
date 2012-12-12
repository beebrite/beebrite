					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm4/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Elige jugar con tus propias fotos de Instagram o, si lo prefieres o no tienes cuenta en Instagram, juega con las fotos que tenemos disponibles para ti!
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Elige una foto y haz click para jugar!
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Usa el ratón para hacer click en la zona del detalle que te muestra este indicador
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_4_es.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Según la precisión, hay 4 tipos de puntuaciones:<br />
							-	Lejos<br />
							-	Cerca<br />
							-	Bien<br />
							-	Exacto!
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Cada vez que consigas un "Exacto!", tendrás +5 seg de tiempo extra
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
