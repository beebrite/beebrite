<?php



function getArrayRandomItem($array){
	return  $array[ mt_rand( 0, sizeof ( $array )-1 ) ];
}

function esVocal($char){
	$vocales = array ( "a","e","i","o","u" ) ;
	$es = false;
	for( $k=0; $k < sizeof ( $vocales ); $k++ ) {
		if( $char == $vocales[$k]){
			$es = true;
			break;
		}
	}
	return  $es;
}

/**
* remueve del array el primer elemento que sea igual al valor del parametro
*/
function removeByValue ( $array , $item2remove) {
	
	$c = 0;
	$newArray = array ( ) ;
	foreach($array as $item)	{
		if($item != $item2remove) {
			$newArray[] = $item;
		}else {
			if ( $c>0 ) {
				$newArray[] = $item;
			}
			$c++;
		}
		
	}
	return $newArray ;
}



/**
* crea 6 letras al azar y entrega un diccionario que se ajusta a esas letras
*/
function crearDiccionario ( &$recursiones ) {


	//definir letras disponibles (  )
		// $vocales = array ( "a","a","a","e","i","o","u" ) ;
		$vocales = array ( "a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","i","o","o","o","o","o","o","o","o","u","u","u","u" ) ;

		// $consonantes = array ( "b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","w","x","y","z" );
		$consonantes = array ( "b","b","c","c","c","c","c","d","d","d","d","d","d","l","l","l","l","l","m","m","m","n","n","n","n","n","n","p","p","r","r","r","r","r","r","s","s","s","s","s","s","s","s","t","t","t","t","t");

		$abecedario = array_merge($vocales, $consonantes);


	//obtener de 2 a 3 vocales y el resto de consonantes

	$letras = array ( ) ;
	$misvocales = array ( ) ;

	$r = mt_rand ( 2,3 );

	/*if ($r==2 ){
		$letras[] = getArrayRandomItem (  $vocales  );
		$misvocales [] = $letras[0];
		$vocales = removeByValue ( $vocales, $letras[0] );
		$letras[] = getArrayRandomItem (  $vocales  );
		$misvocales [] = $letras[1];
		
		$letras[] = getArrayRandomItem (  $consonantes  );		//consonantes
		$letras[] = getArrayRandomItem (  $consonantes  );
		$letras[] = getArrayRandomItem (  $consonantes  );
		$letras[] = getArrayRandomItem (  $consonantes  );
	}else if ($r==3 ){*/
		$letras[] = getArrayRandomItem (  $vocales  );
		$misvocales [] = $letras[0];
		$vocales = removeByValue ( $vocales, $letras[0] );
		$letras[] = getArrayRandomItem (  $vocales  );
		$misvocales [] = $letras[1];
		$vocales = removeByValue ( $vocales, $letras[1] );
		$letras[] = getArrayRandomItem (  $vocales  );
		$misvocales [] = $letras[2];
		
		$letras[] = getArrayRandomItem (  $consonantes  );		//consonantes
		$letras[] = getArrayRandomItem (  $consonantes  );
		$letras[] = getArrayRandomItem (  $consonantes  );
		$letras[] = getArrayRandomItem (  $consonantes  );
		
	//}


	// var_dump( $letras );
	// $letras = array_unique($letras);	//no repetir letras porque el query a BD no busca por cada caracter en cambio usa un regex
	// var_dump( $letras );
	
	$abecedarioCopy = $abecedario;
	
	//agregando consonantes faltantes al abecedario (no se hace antes para no seleccionarlas como disponibles)
		$abecedarioCopy [] = "h";
		$abecedarioCopy [] = "f";
		$abecedarioCopy [] = "j";
		$abecedarioCopy [] = "g";
		$abecedarioCopy [] = "q";
		$abecedarioCopy [] = "v";
		
		
		$abecedarioCopy [] = "k";
		$abecedarioCopy [] = "w";
		$abecedarioCopy [] = "x";
		$abecedarioCopy [] = "y";
		$abecedarioCopy [] = "z";
	
	$excludedChars = array_diff( $abecedarioCopy, $letras  );
	$excludedChars = implode("", $excludedChars) ;	//convirtiendo array en cadena

	// echo "LETRAS DISPONIBLES :<br/>";
	// var_dump( $letras );



	// echo "LETRAS EXCLUIDAS :<br/>";
	// var_dump( $excludedChars );


	
	
	include('../../inc/open_conn.php');
	$db_link = $con;
	
/*
	$db_link =mysql_connect("localhost","root","toor");
	if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	mysql_select_db("beebrite_dev")or die("couldnt select  DB");
	
	
	$db_link =mysql_connect("localhost","root","");
	if (!$db_link) {  die("Could not connect to DB because : " . mysql_error());  }
	mysql_select_db("letterbox")or die("couldnt select  DB");
*/


	$query='SELECT DISTINCT (word) FROM espanol WHERE word NOT REGEXP "['.$excludedChars.'?.]" AND LENGTH(word) >= 3';

	// echo $query . "<br/>";


	$result=mysql_query($query)or die(mysql_error());

	$diccionario = array ( );

	while($fila=mysql_fetch_array($result)){
		$diccionario[] = $fila ;
	}
	
	
	
	
	
	
	// $diccionario =  excludeWordsWithRepeatedChars ( $diccionario );
	$diccionario =  filterWordsWithRepeatedChars ( $diccionario , $misvocales  );
	
	
	
	if ( sizeof ( $diccionario ) < 10 ) {
		$recursiones ++;
		$result = crearDiccionario ( $recursiones );
		$letras = $result[0] ;
		$diccionario = $result[1] ;
	}
	
	// if ( sizeof( $diccionario ) < 100 ){
		// $recursiones ++;
		// $result = crearDiccionario ( $recursiones );
		// $letras = $result[0] ;
		// $diccionario = $result[1] ;
	// }
	
	// var_dump( array ( $letras, $diccionario ) );
	
	return array ( $letras, $diccionario , $recursiones ) ;
	
}


function excludeWordsWithRepeatedChars ( $diccionario ) {
	// var_dump( $diccionario );
	$newDiccionario = array ( ) ;

	for($n=0; $n < sizeof ( $diccionario ) ; $n++ )	{
		$word = $diccionario[$n][0];
		// echo $word."<BR/>";
		$hasRepeatedChar = false;
		$chars = str_split($word);
		// var_dump( $chars );
		
		for($c=0; $c < sizeof ( $chars ) ; $c++)	{
			if( substr_count($word, $chars[$c]) > 1 ) {
				$hasRepeatedChar = true ;
				break;
			}
		}
		
		
		if ( $hasRepeatedChar == false) {
			$newDiccionario[] = $word ;
		}
	}
	
	return $newDiccionario;
}



function filterWordsWithRepeatedChars ( $diccionario , $vocales) {
	// var_dump( $vocales );
	// var_dump( $diccionario );
	
	$vocalCount = array();
	for( $k=0;$k<sizeof ( $vocales );$k++ ) {
		if ( !isset ( $vocalCount[$vocales[$k]]) ){
			$vocalCount[$vocales[$k]] = 1;
		}else{
			$vocalCount[$vocales[$k]] ++;
		}
	}
	// var_dump( $vocalCount );
	
	
	
	$newDiccionario = array ( ) ;

	for($n=0; $n < sizeof ( $diccionario ) ; $n++ )	{
		$word = $diccionario[$n][0];
		// echo $word."<BR/>";
		$hasRepeatedChar = false;
		$chars = str_split($word);
		// var_dump( $chars );
		
		//para cada caracter de la cadena revisar cuantas veces se repite
		//aplicar filtro usando $vocalCount solo para vocales
		for($c=0; $c < sizeof ( $chars ) ; $c++)	{
			
			if (   esVocal( $chars[$c] )  ){
				if( substr_count( $word, $chars[$c] ) > $vocalCount[$chars[$c]] ) {
					$hasRepeatedChar = true ;
					break;
				}
			}else {
				if( substr_count( $word, $chars[$c] ) > 1 ) {
					$hasRepeatedChar = true ;
					break;
				}
			}
					
		}
		
		
		if ( $hasRepeatedChar == false) {
			$newDiccionario[] = $word ;
		}
	}
	
	return $newDiccionario;
}

$recursiones = 0 ;

$diccionario = crearDiccionario ( $recursiones ) ;

// echo "Recursiones  : $recursiones <br/>";
// echo "Diccionario :<br/>";

// echo sizeof ( $diccionario[1] );
// var_dump( $diccionario );

$l = implode ( "," , $diccionario[0]);
$d = "";
foreach($diccionario[1] as $item)	{
		$d .=$item ."," ;
}
$d=substr($d, 0, -1);

echo  "letras=$l&diccionario=$d&" ;


?>










