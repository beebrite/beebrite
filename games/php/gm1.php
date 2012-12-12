<script>
<?php
$strSql = "SELECT intLevel, intPoints, intTime, intBBI FROM cat_users WHERE intId = " . $uId . ";";
$rstJsonData = mysql_query($strSql);
?>
	function InitGame(){
		var jsnData= {
			"uData":{
				"uId": "<?php echo $uId; ?>", 
				"uPic": "<?php echo $uPic; ?>",	
				"uName": "<?php echo $uName; ?>",
				"uLast": "<?php echo $uLast; ?>",
				"uNick": "<?php echo $uNick; ?>",
				"uLang": "<?php echo $uLang; ?>",
				"uLevel": <?php echo mysql_result($rstCount,0,0); ?>,
				"uPoints": <?php echo mysql_result($rstCount,0,1); ?>,
				"uMs": <?php echo mysql_result($rstCount,0,2); ?>,
				"uBBi": <?php echo mysql_result($rstCount,0,3); ?>},
			"tData":{
				"tId": 1,
				"tName": "Entrenamiento Basico",
				"tType": 0,
				"tSession": 20},
			"gData":{
				"gId": 1,
				"gName": "Instavision",
				"gType": 0,
				"gRecLevel": 1000,
				"gRecPoints": 2000,
				"gRecMs": 575,
				"gRecBBi": 800},
			"sData":[
				{"sId": 1, "sName": "Abacus", "sDesc": "Get 100 points in Numberscope", "sPic":"img/stickers/1.png", "sPeel":0},
				{"sId": 2, "sName": "Pascal´s Machine", "sDesc": "Get 500 points in Numberscope", "sPic":"img/stickers/2.png", "sPeel":0},
				{"sId": 3, "sName": "Calculator", "sDesc": "Get 5.000 points in Numberscope", "sPic":"img/stickers/3.png", "sPeel":0},
				{"sId": 4, "sName": "Supercomputer", "sDesc": "Get 20.000 points in Numberscope", "sPic":"img/stickers/4.png", "sPeel":0},
				{"sId": 5, "sName": "Sherlock", "sDesc": "Current Points Record in Numberscope", "sPic":"img/stickers/5.png", "sPeel":1}
				]
			};
		showFlashGame();
		return jsnData;
	};	
</script>