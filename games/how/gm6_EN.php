					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm6/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Write words with the bunches of letters will appear.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Press the space bar to shuffle the letters.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Each correct word will give fuel to the rocket. If you stop writing words, the fuel bar will decrease causing the rocket crash.
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
							With each bunch of letters, you have to write a number of words, and, when you complete that bunch, will appear another bunch of letters to continue. Meanwhile, the rocket continues rising high.
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm6/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			There are 4 different heights:<br />
							-	Green: 0 - 10.000m<br />
							-	Purple: 10.000m - 25.000m<br />
							-	Dark Blue: 25.000m - 50.000m<br />
							-	Black: 50.000m - 100.000m<br />
							-	Lunar: &gt; 100.000m
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
