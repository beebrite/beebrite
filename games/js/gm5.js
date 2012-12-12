function GenArray($jsnLDataReturn){
// ## NIVEL ## ARREGLO[1] - intStats01 ## //
	$strLArray = "|" + $jsnLDataReturn['nivel'];
// ## DURACION GLOBAL ## ARREGLO[2] - intStats02 ## //
	$strLArray += "|" + $jsnLDataReturn['duracion']['global'];
// ## DURACION POR NIVEL ## //
	$strLArray += "|" + $jsnLDataReturn['duracion']['porNivel'].length;
	$strLArray += "|";
	for($intCont = 0; $intCont < $jsnLDataReturn['duracion']['porNivel'].length; $intCont++){
		$strLArray += "*" + $jsnLDataReturn['duracion']['porNivel'][$intCont];
	}
	$strLArray += "*";
// ## PUNTOS GLOBAL ## ARREGLO[5] - intStats03 ## //
	$strLArray += "|" + $jsnLDataReturn['puntos']['global'];
// ## PUNTOS POR NIVEL ## //
	$strLArray += "|" + $jsnLDataReturn['puntos']['porNivel'].length;
	$strLArray += "|";
	for($intCont = 0; $intCont < $jsnLDataReturn['puntos']['porNivel'].length; $intCont++){
		$strLArray += "*" + $jsnLDataReturn['puntos']['porNivel'][$intCont];
	}
	$strLArray += "*";
// ## VELOCIDAD GLOBAL ## ARREGLO[8] - intStats04 ## //
	$strLArray += "|" + $jsnLDataReturn['velocidad']['global'];
// ## VELOCIDAD POR NIVEL ## //
	$strLArray += "|" + $jsnLDataReturn['velocidad']['porNivel'].length;
	$strLArray += "|";
	for($intCont = 0; $intCont < $jsnLDataReturn['velocidad']['porNivel'].length; $intCont++){
		$strLArray += "*" + $jsnLDataReturn['velocidad']['porNivel'][$intCont];
	}
	$strLArray += "*";
// ## ARREGLO[11] - intStats05 ## //
	$strLArray += "|" + $jsnLDataReturn['aveRapaz'];
// ## ARREGLO[12] - intStats06 ## //
	$strLArray += "|" + $jsnLDataReturn['birdsFeeder'];
// ## ARREGLO[13] - intStats07 ## //
	$strLArray += "|" + $jsnLDataReturn['cetrero'];
// ## ARREGLO[14] - intStats08 ## //
	$strLArray += "|" + $jsnLDataReturn['eaglesFeeder'];
// ## ARREGLO[15] - intStats09 ## //
	$strLArray += "|" + $jsnLDataReturn['fastBird'];
// ## ARREGLO[16] - intStats10 ## //
	$strLArray += "|" + $jsnLDataReturn['maxBirdsOnScreen'];
// ## ARREGLO[17] - intStats11 ## //
	$strLArray += "|" + $jsnLDataReturn['pajarosAlimentados'];
// ## ARREGLO[18] - intStats12 ## //
	$strLArray += "|" + $jsnLDataReturn['rapazNegra'];
	$strLArray += "|";
	return $strLArray; 
}