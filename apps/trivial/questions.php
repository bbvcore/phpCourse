<?php
    session_start(); // Inicialización de la sesión
    $_SESSION["id"]; // Variable para almacenar el campo "id"
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Juego de preguntas</title>
    <style type="text/css">
    *{
        padding:0;
        margin:0;
        box-sizing:border-box;
    }
    :root{
        --grey:#d3d3d3;
    }
    body{
        font-family:Arial, Helvetica,"sans-serif";
        font-size:100%;
        background:#f3f3f3;
    }
    #wrapper{
        width:48rem;
        border:1px solid #333;
        margin:0 auto;
        margin-top:5rem;
        box-shadow:0 0 5px #d3d3d3;
        border-radius:3px;
        background:#fff;
    }
    #container{
        width:100%;
        padding:2rem;
        height:auto;
    }
    .text-center{
        text-align:center;
    }
    .btn{
        padding:.5rem 1rem .5rem 1rem;
        background:#aaccdd;
        color:#222;
        border:1px solid #333;
        border-radius:3px;
        float:right;
        margin-top:1rem;
    }
    .btn:hover{
        background:#4286b4;
        color:#fff;
        border:1px solid #333;
        border-radius:3px;
    }
    .pagination{
        margin-top:.5rem;
    }
    .pagination a:link{text-decoration:none;color:#222;}
    .pagination a:visited{text-decoration:none;color:#222;}
    .pagination a:hover{text-decoration:none;color:#4286b4;}
    .pagination a:active{text-decoration:none;color:#222;}          
    .clear{
        clear:both;
        height:.5rem;
    }  
    .next-link:link{text-decoration:none;margin:0 auto;}

    </style>
</head>
<body>
<div id="wrapper">
    <div id="container">
    <?php
        //=====================================================
        // Conexión a base de datos a traves de la interfaz PDO
        //=====================================================
        // 1.- DECLARACIÓN DE VARIABLES DE CONEXIÓN
        //=========================================
        // Primero declaración de variables con asignación de valores
        $host = 'localhost';
        // Vuestro usuario, normalmente es root
        $user = 'root';
        // La contraseña que tengáis en mysql
        // La que tengáis que poner al ejecutar este comando: mysql -h localhost -u root -p
        $password = '';
        $db = 'exams';
        $engine = 'mysql';
        //=========================================
        // 2.- DECLARACIÓN DE DISTINGUISH NAME
        //=========================================
        // Distinguish name: Requiere el nombre del motor de DB que usemos + el hostname + la dbname
        // Además también podría aceptar un parámetro más que sería un array para añadir opciones extra de configuración
        $dn = "$engine:host=$host;dbname=$db";

        //=========================
        // 3. ESTABLECEMOS CONEXIÓN
        //=========================
        try{
            $connection = new PDO($dn,$user,$password);  
            // Mensaje de éxito:  
            // echo "<p class='text-center'><br><b>La conexión se ha establecida correctamente</b></br></p>";
        }catch(PDOException $e){
            echo "<p class='text-center'><br><b><span style='color:red'>ERROR en la conexión: </span><b>'".$e->getMessage()."'<br></p>";
        }
        //======================
        // 4.- INICIO PÁGINACIÓN
        //======================
        // 4.1. OBTENER PÁGINA
        //=====================
        // Comprobar si existe página, en caso positivo capturar su valor, en caso negativo asignarla a 1
        if (isset($_GET['p'])){
            $p = $_GET['p']; 
        }else{
            $p = 1;   
        }
        //echo "<b><span style='red'>Comprobar valor de $p: </b>:$p</span>";
        //=================================
        // 4.2. OBTENER TODOS LOS REGISTROS
        //=================================
        // Consulta SQL que nos devuelve la cantidad de registros almacenados en la tabla
        $sql = "SELECT COUNT(*) AS `total` FROM `questions`";
        $rs = $connection->query($sql);
        $row = $rs -> fetch();
        $regTotal = $row[0];
        // Variable para configurar número de resultados a mostrar por página
        $regXpage = 1;
        // Número de páginas a mostrar
        $pagesToShow = ceil($regTotal/$regXpage);
        echo '<br>';
        // INFORMACIÓN ADICIONAL:
        //echo '<em>Número total de PREGUNTAS: </em>'.$regTotal.'<br>';
        //echo '<em>Número total de preguntas por página: '.$regXpage.'<br>';
        //echo '<em>Número total de preguntas por página: '.$pagesToShow.'<br>';
        //=================================
        // 4.3 MOSTRAR LOS RESULTADOS
        //=================================
        $sql = "SELECT * FROM `questions`";
        // Importante: usamos p-1 para cuando iteremos,vamos de 0 a 3, nos concuerde todo
        // y no tengamos problemas de correspondencia en la visualización de datos.
        $sql2= "$sql LIMIT ".(($p-1)*$regXpage).", $regXpage";
        // echo "Comprobar la consulta enviada: $sql2";
        $rs = $connection->query($sql2);
        while ($row = $rs->fetch()){
            echo "<br>";
            echo "<form id='questions' name='questions' method='post'>";
                // Variable SESSION para almacenar $row[0], que es el IDENTIFICADOR de la pregunta
                $_SESSION["id"]=$row[0];
                echo "<h4>".$row[1].'</h4><br>';
                echo 'a) <input type="radio" name="respuestas" value="a">  '.$row[2].'<br>';    
                echo 'b) <input type="radio" name="respuestas" value="b">  '.$row[3].'<br>';
                echo 'c) <input type="radio" name="respuestas" value="c">  '.$row[4].'<br>';
                echo 'd) <input type="radio" name="respuestas" value="d">  '.$row[5].'<br>';
                echo "<br>";
                echo "<input type='submit' class='btn' value='Responder pregunta' name='enviar'>";
            echo "</form>";
        }
        //=====================================================
        // 4.4. PROCESAR RESPUESTA Y CARGAR RESPUESTA SIGUIENTE
        //=====================================================
        if (isset($_POST['enviar'])){
            //echo "Comprobar envío del formulario: Estado enviado";
                if (isset($_POST["respuestas"])){
                    $respuestas = $_POST["respuestas"];
                    echo '<br><br> La respuesta escogida es: <b>' .$respuestas.'</b><br>';
                    // Búsqueda para comprobar si es correcta la respues: consulta a DB y comparar con respuesta marcada
                    $search='SELECT correct FROM questions INNER JOIN answers ON questions.id = answers.id WHERE questions.id ='.$_SESSION["id"]; 
                    //echo "Comprobar la consulta: $search."<br><br>";
                    $rs = $connection->query($search);
                    /*
                    // Si hubiera multiples respuestas correctas
                        while($row=$rs->fetch()){
                         $sol=$row[0];
                    }*/
                    // Para solo 1 Respuesta Correcta, que es el planteamiento aceptado para este juego.
                    $row = $rs->fetch();
                    $sol=$row[0];
                    if (isset($sol)){
                        //echo "<br>La respuesta correcta es: $sol<br>";
                            if($respuestas === $sol){
                                echo "<br><p class='text-center'  style='color:#4286b4'>¡Ha Acertado! Respuesta correcta.</b></p><br>";
                            }else{
                                echo "<br><p class='text-center' style='color:red'>'WRONG!', Se ha equivocado. Respuesta Errónea.</p><br>";
                            }
                    }
                    //echo "<br><br>Comprobar el númnero de pregunta: $search<br><br>";        
                        // Avanzar a siguiente pregunta: Capturar las P que van de 1 a n
                        if ($p === 0 || $p === null || $p === $regTotal){
                            $p=1;
                            echo "<a class='btn next-link' href='questions.php?p=$p'>Volver al principio</a>";
                        }else if ($p<$regTotal){
                                $p+=1;
                                echo "<a class='btn next-link'  href='questions.php?p=$p'>Ir a la siguiente pregunta</a>";
                            }
                }else{
                    echo "<br><p class='text-center' style='color:red'><b>No ha escogido una respuesta</b></p><br>";
                }
        }
        ?>
        <div class="clear"></div>
    </div>
</div>
    <?php
        //=====================================================
        // 4.5. PAGINACIÓN DE LOS RESULTADOS
        //=====================================================        
        echo "<br><br><p class='text-center pagination'>";
        for ($i = 0 ; $i <=$regTotal; $i++){ // De 0 a 3
            if ($i=1){ // Caso p=0
                echo '<a href="questions.php?p='.$i.'">'.$i.'</a>  ';
            }
            for ($i=2; $i<$regTotal;$i++){ // Caso p=1, p=2, p=n
                echo '<a href="questions.php?p='.$i.'">'.$i.'</a>  ';
            }
            if ($i==$regTotal){ // Caso p=total
                echo '<a href="questions.php?p='.$regTotal.'">'.$i.'</a> ';
            }
        }
        echo "</p>";
    ?>
</body>
</html>
