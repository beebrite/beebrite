					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm1/step_1_en.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Each quadrant of the clock has beside it  "+", "-", "Even", "Odd"
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Within each quadrant will appear a number or a positive or negative operation
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Use the arrow keys (right (SI) and the left button (NO) on your keyboard or the mouse to choose the correct answer.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			As you answer correctly, the signs "+", "-", "Even", "Odd" of each quadrant will disappear making you have to remember the position of all of them.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm1/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			The life indicator shows the lifes availables and clock indicator shows the time remaining. You start with 5 lifes and 120 seconds.
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
