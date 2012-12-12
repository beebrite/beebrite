					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm5/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Use the mouse and drag the rope down to start the game.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			There are three types of birds:<br />
							-	Red Bird eats seed<br />
							-	Eagle eats meat<br />
							-	Black Bird doesn´t eat, only distracts
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Have the seeds and meat just to feed all the birds of each level. Remember, you can only feed each only once. Keep track on the birds you've fed.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			You'll have to wait a few seconds until you can feed the following bird.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Start with 4 lifes
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
							Bird fed properly: Contorno verde<br />
							Bird fed incorrectly: Contorno Rojo y Cruz Roja de Error
			    		</div>
			    		<div id="divHowPage7" class=" game_slides " style="display:none; background-image:url(games/how/img/gm5/step_7.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Remember, don´t feed the black birds. They are only to distract.
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
