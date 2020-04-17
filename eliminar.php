<?php
require 'conexion.php';

//1.- Obtener el ID del registro a eliminaer
$id = $_GET['id'];

//2.- Preparar la consulta de eliminación
$sql = "DELETE FROM empleados WHERE id = '$id'";

//3.- Ejecutar la consulta
$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>

<!--<html lang = "es"> Define a español el lenguaje HTML utilizado para la página.-->
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1"> <!--Adapta los datos al tamaño de la pantalla-->

        <!--Hojas de estilo para la página proveninetes de Bootstrap-->
        <link href = "css/bootbootstrap.min.css" rel = "stylesheet">
        <link href = "css/bootstrap-theme.css" rel = "stylesheet">

        <!--Definir que la página utilizará JavaScript con Jquery-->
        <script src = "js/jquery-3.1.1.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>

        <title>Eliminar</title>

    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <div class = "row" style = "text-align: center">
                    <!-- Se evalúa la consulta de la clase-->
                    <?php if ($resultado) { ?>
                        <h3>REGISTRO ELIMINADO</h3>
                    <?php } else { ?>
                        <h3>ERROR AL ELIMINAR</h3> 
                    <?php } ?>
                    <a href = "index.php" class = "btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>

