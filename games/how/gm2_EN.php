					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm2/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Use the mouse to drag the piece of land that appears in the panel and drop it into the place you choose to build the path of the rabbit.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Hurry up and build the longest path as possible. When the rabbit is immersed into the ground, you can continue placing pieces of land on the path.<br />
			    			Depends on the level, you´ll have more or less time until the rabbit immerse into the ground.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
						There are 4 types of carrots:<br />
						-	Normal = 1 Carrot Carrot Normal<br />
						-	Carrots Carrot gold = 5 normal<br />
						-	Carrots Carrots time = 3 normal + Extra 10sec<br />
						-	Carrot Carrot frozen = 1 normal + Extra 10sec
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Each level requires the rabbit will eat a minimum number of carrots to move to the next level.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			You can also find extra lifes along the levels. You start the game with 5 lifes.
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm2/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Besides pieces of land, sometimes you can find a brush that lets you erase a piece of land in case you missed the place.
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
