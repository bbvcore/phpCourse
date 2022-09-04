<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h2>Uso del loop FOR</h2>

<?php
//================
// FOR tradicional
//================
echo 'Primeros <b>10</b> valores <b>númericos</b>: ';
for ($i = 0; $i < 10 ; $i++){
	echo "<em>$i</em>";
}

//=========
// FOR EACH
//=========
// Hay dos formas de trabajar con foreach
$array=['Alumno_01','Alumno_02','Alumno_03','Alumno_04','Alumno_05'];

echo '<br><br>Impresión de los <b>valores</b> contenidos en el array usando <b>foreach</b>:<br><br>';
// Primera forma: ver directamente el valor
foreach ($array as $value){
	echo $value;
}
echo '<br><br>Impresión del <b>indice</b> y los <b>valores</b> contenidos en el array usando <b>foreach</b>:<br>';
// Segunda forma: consultar el indice y el valor
foreach ($array as $key => $value){
	echo '<br>Indice: '.$key.' => Valor: '.$value.'<br>';
}

// ARRAYS multidimensionales e iteración con FOR
// FOR clásico
$arrayMulti = array(
	array(0,1,2),
	array(3,4,5),
	array(6,7,8)
);
// También vale sizeof()
$size = count($arrayMulti);
for ($i=0 ; $i < $size; $i++){
	echo '(';
	for ($j=0 ; $j < $size ;$j++){
		echo $arrayMulti[$i][$j];
	}
	echo ')<br>';
}
// Formulario para decidir el número de datos a introducir
echo '<h3>Definir el número de elementos del array bandas: </h3>';
echo '<form action="php_02_for.php" method="post">';
echo '<input type="text" name="number" placeholder="Introducir número de campos necesarios" required>';
echo '<input type="submit" name="enviarNumber" value="Enviar número" >';
echo '</form>';
// Formulario para introducir datos
echo '<form action="php_02_for.php" method="post">';
if (isset($_POST['enviarNumber'])){
	for($j = 0; $j< $_POST['number'];$j++){
		echo '<br>';
		echo 'Banda número '.$j.': <input type="text" name="bands[]" placeholder="Introduce nombre de la banda"><br>';
	}
	echo '<input type="submit" name="enviarBands" value="Envia bandas" />';
	echo '</form>';
}
// Ver datos introducidos
if (isset($_POST['enviarBands'])){
	echo '<h3>Lectura del contenido del array bandas: </h3>';
	foreach($_POST['bands'] as $band) {
        echo "<br><em>Banda introducida:</em> <b>$band</b></br>";
    }
}





?>
</body>
</html>