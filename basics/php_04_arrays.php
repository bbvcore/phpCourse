<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h2></h2>

<?php
// ARRAYS
//=======
// En PHP los arrays tienen una peculiradidad, pueden ser asociativos
// es decir el indice puede ser texto y no numérico.
// A.- Declaración de arrays
$bands = array(
	'Korn',
	'Slayer',
	'Pennywise'
);
$discs = ['Life is peachy','Reign blood','Full circle'];
echo 'Es un array $bands: ';
echo is_array($bands) ? 'Sí' : 'No';
echo '<br>Número de elementos en $discs: '.count($discs).'<br>';
//  B.- Array asociativo: el indice es un texto, en vez
// de un indice numérico como suele ser habitual, por ello
// en la asignación se indica el texto que se quiere usar
// como indice de la determinada posición en dicho array.
$players = array(
	'Iago Aspas' => 10,
	'Messi' => 30,
	'Haaland' => 9
);
echo 'Aspas lleva el dorsal número '.$players['Iago Aspas'];
// Iteración del array asoaciativo: lo más comodo es usar un foreach
echo '<br><br><b>Contenido del array asociativo:</b><br>';
 foreach ($players as $key => $value){
 	echo $key . ' => ' . $value .'<br>';
 }
// ARRAYS multidimensionales:
 $multi = [
 	['metal', 'punk', 'funk', 'jazz', 'progressive'],
 	['DEP', 'Offspring', 'George Clinton', 'Page Hamilton', 'Rush'],
	['USA','UK','USA','UK','UK']
];
 for ($i=0; $i < 3 ; $i++){
 	echo 'Linea del array número '.$i.': &nbsp;&nbsp; ';
 	for ($j=0; $j <5; $j++){
 		echo $multi[$i][$j].'&nbsp;&nbsp;&nbsp;&nbsp;' ;
 	}
 	echo '<br>';
 }


?>
</body>
</html>