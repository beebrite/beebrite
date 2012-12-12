					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm8/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Each face of the cube is a stage in the game.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Use the keyboard to form correct words and press "Enter".
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							At each stage you will have to write words that begin or end with the letters the cube shows.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							When you complete a level, the background color will change.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
							The lifes indicator shows you the available lifes. You start with 3 lifes.
			    		</div>
			    		<div id="divHowPage6" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_6.png); background-position:center bottom; background-repeat:no-repeat; ">
							The words indicator shows you all the correct words in each stage.
			    		</div>
			    		<div id="divHowPage7" class=" game_slides " style="display:none; background-image:url(games/how/img/gm8/step_7.png); background-position:center bottom; background-repeat:no-repeat; ">
							The prefixes/sufixes indicator shows you the overcome stages in the current level.
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
