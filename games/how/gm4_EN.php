					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm4/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Choose to play with your own Instagram photos, or if you prefer or don´t have an Instagram account, play with the photos we have available for you!
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Choose a photo and click to play!
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_3.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Use the mouse to click in the detail area that shows this indicator
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_4_en.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			According to accuracy, there are 4 types of ratings:<br />
							-	Far<br />
							-	Close<br />
							-	Good<br />
							-	Exact!
			    		</div>
			    		<div id="divHowPage5" class=" game_slides " style="display:none; background-image:url(games/how/img/gm4/step_5.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Every time you get a "Exact!" answer, you´ll have +5 seconds extra time
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
