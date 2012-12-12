					<div class=" howprev " onclick="PrevPage(); "></div>
		    		<div style="width:770px; float:left">
			    		<div id="divHowPage1" class=" game_slides " style="display:block; background-image:url(games/how/img/gm3/step_1.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			Use the mouse to turn on the bulbs. Try to turn on the maximum number of bulbs.
			    		</div>
			    		<div id="divHowPage2" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_2.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			If it takes too long to turn on the next bulb, the circle of light will close on and you won´t be able to continue. In addition the bulbs you have around you, will be break, preventing you continuing.
			    		</div>
			    		<div id="divHowPage3" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_3_en.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			There are 4 types of light bulbs:<br />
							-	Normal = Without effect<br />
							-	Bulb freezer = Paralyzes the circle of light, giving you extra time to turn on the next bulb<br />
							-	Bulb vision field = Amplify the circle of light, so you can turn on bulbs that are further<br />
							-	Bulb Combo: If you turn three consecutive bulbs of this type, will turn on 10 normal bulbs
			    		</div>
			    		<div id="divHowPage4" class=" game_slides " style="display:none; background-image:url(games/how/img/gm3/step_4.png); background-position:center bottom; background-repeat:no-repeat; ">
			    			There is also a battery that just click on it, speeds up and will turn on 10 normal bulbs at once.
			    		</div>
			    	</div>
					<div class=" hownext " onclick="NextPage(); "></div>
					<br style="clear:both">
					<script>
					$intHowPage = 1;
					function NextPage(){
						if ($intHowPage<4){
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
