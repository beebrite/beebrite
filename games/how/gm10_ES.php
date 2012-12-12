					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm10/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Destruye todas las bolas formando pares que sumen 10.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm10/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Puedes usar una sola bola para destruir un grupo de bolas con el mismo número.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm10/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							Presiona la barra espaciadora para cambiar de bola.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<3){
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
