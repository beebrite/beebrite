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
	$strLArray += "|" + $jsnLDataReturn['altosVuelos'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['cometaEspacial'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['despegueEstelar'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['estrellaFugaz'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['guardianEstacion'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['houstonHouston'];
// ## ARREGLO[17] - intStats11 ## //
	$strLArray += "|" + $jsnLDataReturn['metros'];
// ## ARREGLO[18] - intStats12 ## //
	$strLArray += "|" + $jsnLDataReturn['palabras'];
// ## ARREGLO[19] - intStats13 ## //
	$strLArray += "|" + $jsnLDataReturn['velocidadLuz'];
// ## ARREGLO[20] - intStats14 ## //
	$strLArray += "|" + $jsnLDataReturn['expedicionExitosa'];
// ## ARREGLO[21] - intStats15 ## //
	$strLArray += "|" + $jsnLDataReturn['astronautaExperimentado'];
	$strLArray += "|";
	return $strLArray; 
}
