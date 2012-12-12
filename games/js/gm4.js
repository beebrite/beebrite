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
	$strLArray += "|" + $jsnLDataReturn['hiperfocus'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['megapixel'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['superTrigger'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['visionProgresiva'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['retroColeccionista'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['x11'];
	$strLArray += "|";
	return $strLArray; 
}