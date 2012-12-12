					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm7/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Look carefully to remember the position of the checkers. Then, disappear and you´ll  have to remember the position.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Click with the mouse to put the checkers in the correct position. Be careful because the board can rotate!
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							The checkers that are on the left side, shows the lifes available. You start with 10 lifes.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							The time indicator shows you the elapsed time of the game.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_5_en.png); background-position:center bottom; background-repeat:no-repeat; ">
							The level indicator shows you the level and the stage you are.
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm7/step_6_en.png); background-position:center bottom; background-repeat:no-repeat; ">
							The placed checkers indicator shows you how many checkers have you put in the game.
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
