<?php



function getArrayRandomItem($array){
	return  $array[ mt_rand( 0, sizeof ( $array )-1 ) ];
}




function crearDiccionarioPrefijo ( $prefijo ,$recursiones ) { 

	

	$db_link =mysql_connect("localhost","root","toor");
	if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	mysql_select_db("beebrite")or die("couldnt select  DB");
	
	
	// $db_link =mysql_connect("localhost","root","");
	// if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	// mysql_select_db("letterbox")or die("couldnt select  DB");

	
	$query='SELECT DISTINCT (word) FROM espanol WHERE word LIKE "'.$prefijo.'%" AND LENGTH(word) >= 3';
	// echo $query . "<br/>";
	$result=mysql_query($query)or die(mysql_error());
	$diccionario = array ( );
	while($fila=mysql_fetch_array($result)){
		$diccionario[] = $fila[ 'word' ] ;
	}
	// if ( sizeof ( $diccionario ) < 10 ) {
		// $recursiones ++;
		// $diccionario = crearDiccionarioPrefijo ( $prefijo, $recursiones );				
	// }
	return  $diccionario ;
	
}
function crearDiccionarioSufijo( $sufijo ,$recursiones ) { 

	

	$db_link =mysql_connect("localhost","root","toor");
	if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	mysql_select_db("beebrite")or die("couldnt select  DB");
	
	
	// $db_link =mysql_connect("localhost","root","");
	// if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	// mysql_select_db("letterbox")or die("couldnt select  DB");

	
	$query='SELECT DISTINCT (word) FROM espanol WHERE word LIKE "%'.$sufijo.'" AND LENGTH(word) >= 3';
	// echo $query . "<br/>";
	$result=mysql_query($query)or die(mysql_error());
	$diccionario = array ( );
	while($fila=mysql_fetch_array($result)){
		$diccionario[] = $fila[ 'word' ] ;
	}
	// if ( sizeof ( $diccionario ) < 10 ) {
		// $recursiones ++;
		// $diccionario = crearDiccionarioPrefijo ( $sufijo, $recursiones );				
	// }
	return  $diccionario ;
	
}

$output = "";

$recursiones = 0 ;

$pre1 = "de";
$pre2 = "ra";
$pre3 = "ca";

$suf1 = "re";
$suf2 = "ra";
$suf3 = "fa";


$diccionarioPre1 = crearDiccionarioPrefijo ( "$pre1", $recursiones ) ;
$diccionarioPre2 = crearDiccionarioPrefijo ( "$pre2", $recursiones ) ;
$diccionarioPre3 = crearDiccionarioPrefijo ( "$pre3", $recursiones ) ;

$diccionarioSuf1 = crearDiccionarioSufijo ( "$suf1", $recursiones ) ;
$diccionarioSuf2 = crearDiccionarioSufijo ( "$suf2", $recursiones ) ;
$diccionarioSuf3 = crearDiccionarioSufijo ( "$suf3", $recursiones ) ;



$d = "";
foreach($diccionarioPre1 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "pre1=$pre1,$d&" ;


$d = "";
foreach($diccionarioPre2 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "pre2=$pre2,$d&" ;


$d = "";
foreach($diccionarioPre3 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "pre3=$pre3,$d&" ;


$d = "";
foreach($diccionarioSuf1 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "suf1=$suf1,$d&" ;


$d = "";
foreach($diccionarioSuf2 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "suf2=$suf2,$d&" ;


$d = "";
foreach($diccionarioSuf3 as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);
$output.= "suf3=$suf3,$d&" ;





echo $output;




?>










