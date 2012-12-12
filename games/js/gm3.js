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
	$strLArray += "|" + $jsnLDataReturn['bateriasEncendidas'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['bombillasEncendidas'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['chainEncendidas'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['focosRotosEnemigo'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['freezeEncendidas'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['newtrino'];
// ## ARREGLO[17] - intStats11 ## //
	$strLArray += "|" + $jsnLDataReturn['rangoEncendidas'];
// ## ARREGLO[18] - intStats12 ## //
	$strLArray += "|" + $jsnLDataReturn['rayoEscapista'];
	$strLArray += "|";
	return $strLArray; 
}