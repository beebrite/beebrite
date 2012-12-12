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
	$strLArray += "|" + $jsnLDataReturn['encendiendoLlama'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['usandoPolvora'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['balaInfinita'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['balaCanon'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['energicoLanzador'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['respetadoLanzador'];
	$strLArray += "|";
	return $strLArray; 
};