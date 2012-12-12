<?php




include('../../inc/open_conn.php');
$db_link = $con;
$tabla 	 = "diccionariocubo";



$nivel = $_GET['nivel'];
$output = "";
$pre1 = "";
$pre2 = "";
$pre3 = "";

$suf1 = "";
$suf2 = "";
$suf3 = "";


if( $nivel == 1 || $nivel == 2){

	$nivel = 1 ; 
	
}else if( $nivel == 3 ||$nivel == 4){

	$nivel = 2 ;
		
}else if( $nivel == 5 || $nivel == 6 ){

	$nivel = 3 ; 
	
}




	//__________________________obteniendo prefijos no repetidos
	
	$query = "SELECT * FROM $tabla WHERE parte='prefijo' AND nivel='$nivel' AND idioma='en' ORDER BY RAND() LIMIT 1";	
	$result= mysql_query($query)or die(mysql_error());
	$fila1 = mysql_fetch_array($result);
	
	
	$diccionario = stripslashes($fila1['diccionario']);
	$output.= "pre1=".$fila1['caracteres'] . "," . $diccionario. "&";
	
	
	// var_dump ( $fila1 ) ;
	
	$id = $fila1['id'];
	$query = "SELECT * FROM $tabla WHERE parte='prefijo' AND nivel='$nivel' AND idioma='en' AND id!='$id' ORDER BY RAND() LIMIT 0,1 ";	
	$result= mysql_query($query)or die(mysql_error());
	$fila2 = mysql_fetch_array($result);
	
	$diccionario = stripslashes($fila2['diccionario']);
	$output.= "pre2=".$fila2['caracteres'] . "," . $diccionario. "&";
	
	// var_dump ( $fila2 ) ;
	
	$id2 = $fila2['id'];
	$query = "SELECT * FROM $tabla WHERE parte='prefijo' AND nivel='$nivel' AND idioma='en' AND id!='$id' AND id!='$id2' ORDER BY RAND() LIMIT 0,1 ";	
	$result= mysql_query($query)or die(mysql_error());
	$fila3 = mysql_fetch_array($result);
	
	$diccionario = stripslashes($fila3['diccionario']);
	$output.= "pre3=".$fila3['caracteres'] . "," . $diccionario. "&";
	
	// var_dump ( $fila3 ) ;
	
	
	//__________________________obteniendo sufijos no repetidos
	
	
	$query = "SELECT * FROM $tabla WHERE parte='sufijo' AND nivel='$nivel' AND idioma='en' ORDER BY RAND() LIMIT 1";	
	$result= mysql_query($query)or die(mysql_error());
	$fila4 = mysql_fetch_array($result);
		
	$diccionario = stripslashes($fila4['diccionario']);
	$output.= "suf1=".$fila4['caracteres'] . "," . $diccionario. "&";
	
	// var_dump ( $fila4 ) ;
	
	$id = $fila4['id'];
	$query = "SELECT * FROM $tabla WHERE parte='sufijo' AND nivel='$nivel' AND idioma='en' AND id!='$id' ORDER BY RAND() LIMIT 0,1";	
	$result= mysql_query($query)or die(mysql_error());
	$fila5 = mysql_fetch_array($result);
		
	$diccionario = stripslashes($fila5['diccionario']);
	$output.= "suf2=".$fila5['caracteres'] . "," . $diccionario. "&";
	
	// var_dump ( $fila5 ) ;
	
	
	$id2 = $fila5['id'];
	$query = "SELECT * FROM $tabla WHERE parte='sufijo' AND nivel='$nivel' AND idioma='en' AND id!='$id' AND id!='$id2' ORDER BY RAND() LIMIT 0,1";	
	$result= mysql_query($query)or die(mysql_error());
	$fila6 = mysql_fetch_array($result);
		
	$diccionario = stripslashes($fila6['diccionario']);
	$output.= "suf3=".$fila6['caracteres'] . "," . $diccionario. "&";
	
	// var_dump ( $fila6 ) ;




echo $output;




?>










