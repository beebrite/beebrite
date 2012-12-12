function tglStatsfGames(){
	if($('#stats').css('display') == 'block')
	{
		$('#gametrayin').animate({bottom: 79}, "fast", function() {});
	}
	else
	{
		$('#gametrayin').animate({bottom: 178}, "fast", function() {});
	};
	$('#stats').slideToggle('fast', function(){
		if(stStats == true)
		{
			stStats = false;
			$('#stats_up').css("display","none");
			$('#stats_down').css("display","block");
		}
		else
		{ 
			stStats = true;
			$('#stats_up').css("display","block");
			$('#stats_down').css("display","none");
		}
	});
}

function callGameStart($blnGoPlay){
	if($blnGoPlay==1){
		document.getElementById("musicTheme").stopSound();
		$('#startscreen').fadeOut('slow', function(){
			document.getElementById("flashcontent_embed").focus();
			document.getElementById("flashcontent_embed").InitGameResponse();
		});
	}else{
		riseUpgrade();
	};
};

function riseUpgrade(){
	$('#divUpgrade').fadeIn('slow');
};

function showFlashGame(){
	$('#divLoading').hide();
	$('#divBtnPlay').show();
};