<!DOCTYPE html>
<html lang="es">
<head>
	<title>Validación de edad</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h2>Validación de edad</h2>
	<form id="age-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
		<input type="text" name="age" id="age-input" placeholder="Introduzca su edad" required>
		<input type="submit" id="submit" name="enviar" value="Comprobar la edad">
	</form> 
<?php
if (isset($_POST['enviar']) && (!empty($_POST['enviar']))){
	echo '<br>Ha envíado <b>correctamente</b> el formulario<br>';
	echo '<br> La edad introducida es:<b> '.$_POST['age'].'</b><br>';
	if ($_POST['age'] < 18){
		echo '<br>"<em>Usted es <b>MENOR</b> de edad, no puede acceder</em>"';
	}else{
		echo '<br>"<em>Usted es <b>MAYOR</b> de edad, sea bienvenido</em>"';
	}
}
?>
</body>
</html>