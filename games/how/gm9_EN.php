					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm9/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
							Use the mouse to buy and sell the jewelry. The price of jewelery fluctuates up and down. Buy when you can and sell for a higher price you purchased. But watch out!, sell before the price starts to down.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
							Once you have enough money, buy the treasure of each level. Try it in the shortest time possible.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
							The time indicator shows you the time you have to complete the level.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							The money indicator shows you how much money you have available at all times.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm9/step_5_en.png); background-position:center bottom; background-repeat:no-repeat; ">
							The level indicator shows you in what level you are.
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
