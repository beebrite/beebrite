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
	$strLArray += "|" + $jsnLDataReturn['fasesSuperadas'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['stickerPaladin'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['tiempoEnFinalizarNivel4'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['tiempoEnFinalizarNivel9'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['tiempoEnFinalizarNivel11'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['tiempoEnFinalizarNivel12'];
// ## ARREGLO[17] - intStats11 ## //
	$strLArray += "|" + $jsnLDataReturn['reinoTuyo'];
// ## ARREGLO[18] - intStats12 ## //
	$strLArray += "|" + $jsnLDataReturn['granEstratega'];
// ## ARREGLO[19] - intStats13 ## //
	$strLArray += "|" + $jsnLDataReturn['damaTemeraria'];
// ## ARREGLO[20] - intStats14 ## //
	$strLArray += "|" + $jsnLDataReturn['armaduraVeloz'];
	$strLArray += "|";
	return $strLArray; 
}
