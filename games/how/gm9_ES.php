					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm9/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Usa el ratón para comprar y vender las joyas. El precio de las joyas sube y baja. Compra cuando puedas y vende por un precio mayor por el que compraste. Pero cuidado!, vende antes de que comience a bajar el precio.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Una vez tengas el dinero suficiente, compra el tesoro de cada nivel. Intenta hacerlo en el menor tiempo posible.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de tiempo te mostrará cuanto tiempo tienes para completar el nivel
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de dinero te mostrará cuánto dinero disponible tienes en cada momento.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_5_es.png); background-position:center bottom; background-repeat:no-repeat; ">
							El indicador de nivel te mostrará en qué nivel te encuentras.
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
