<?php 
	//declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h2></h2>
<?php
//========================================
// Declaración de funciones previa a php 7
//========================================
// A.- El tipado es automático, lo realiza el lenguaje
function suma($a, $b){
	return $a+$b;
}
echo 'El valor de la suma es: ' . suma(5,4).'<br>';

// B.- Trabajar con valores por referencia
// Para ello usamos el operador de dirección '&'
// El operador de indirección seria '*' pero en PHP no se usa.
$change=10;
echo "Valor ANTES de modificar: ". $change ;
function modificar(&$change){
	$change += 10;
}
modificar($change);
echo "<br>Valor modificado: ". $change .'<br>';

//===========================================
// Declaración de funciones a partir de php 7
//===========================================
// A.- El tipado se puede definir por el usuario
// Definimos que los parámetros trabajaran con 
// argumentos de tipo int y también que el return
// será de tipo int.
function sumaTipado(int $a, int $b) :int {
	return $a+$b;
}
echo 'El valor de la suma es: ' . sumaTipado(8,6);

// B.- Añadir un valor mínimo al argumento del parámetro pasado.
function multiplicacion (int $a, int $b = 10) :int{
	return $a*$b;
}
// Si no se pasa argumento para el parámetro b, automáticamente usará el valor 10.
echo '<br>El valor de la multiplicación es: '. multiplicacion(3);
// Al pasar un valor para el argumento del parámetro b, 
// ignora el 10 prefijado y utiliza el pasado en la 
// llamada de la función
echo '<br>El valor de la multiplicación es: '. multiplicacion(3,5);


?>
</body>
</html>