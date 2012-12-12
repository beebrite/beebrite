function GenArray($jsnLDataReturn){
// ## NIVEL ## ARREGLO[1] - intStats01 ## //
	$strLArray = "|" + $jsnLDataReturn['nivel'];
// ## DURACION GLOBAL ## ARREGLO[2] - intStats02 ## //
	$strLArray += "|" + $jsnLDataReturn['duracion']['global'];
// ## DURACION POR NIVEL ## //
	$strLArray += "||";
// ## PUNTOS GLOBAL ## ARREGLO[5] - intStats03 ## //
	$strLArray += "|" + $jsnLDataReturn['puntos']['global'];
// ## PUNTOS POR NIVEL ## //
	$strLArray += "||";
// ## VELOCIDAD GLOBAL ## ARREGLO[8] - intStats04 ## //
	$strLArray += "|" + $jsnLDataReturn['velocidad']['global'];
// ## VELOCIDAD POR NIVEL ## //
	$strLArray += "||";
// ## ARREGLO[11] - intStats05 ## //
	$strLArray += "|" + $jsnLDataReturn['sticker_englishLord'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['sticker_royalAdvisor'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['sticker_victorianGuide'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['sticker_visionary'];
	$strLArray += "|";
	return $strLArray; 
}