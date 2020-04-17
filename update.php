<?php
require 'conexion.php';

//Recibir el ID de la página a modificar
$id = $_POST['id'];

//Capturar el valor de cada campo desde la página de modificar.php
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$genero = $_POST['genero'];
$f_nacimiento = $_POST['f_nacimiento'];
$f_ingreso = $_POST['f_ingreso'];
$salario = $_POST['salario'];

//Hacer el query (consulta) a la BD para envíar los campos capturados
//Preparar el query
$sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', genero='$genero', f_nacimiento='$f_nacimiento', f_ingreso='$f_ingreso', salario='$salario' WHERE id = '$id'";

//2.- Ejecutar el query
$resultado = $mysqli->query($sql);

//Bloque para guardar la nueva imagen o imágenes
//Obtener el ID del registro de query anterior
$id_insert = $id;

//Recibir el archivo de tipo File
//Revisar si el archivo viene con algún error
if ($_FILES["archivo"]["error"] > 0) {
    echo "ERROR al cargar el archivo";
} else {
    //Definir archivos permitidos que se pueden mandar a guardar
    $permitidos = array("image/png", "image/gif", "image/jpeg", "application/pdf");
    //Definir los archivos que se pueden cargar
    $permitidos = array("image/png", "image/gif", "image/jpeg", "application/pdf");

    //Definir el tamaño permitido de los archivos
    $limite_kb = 500;

    //Evaluar si el archivo cumple los límites de extenxión y tamaño
    if (in_array($_FILES["archivo"]["type"], $permitidos) && ($_FILES["archivo"]["size"] <= $limite_kb * 1024)) {

        //Crear la carpeta donde se guardará la imagen con su respectivo ID
        $ruta = 'files/' . $id_insert . '/';

        //Establecer el nombre del archivo
        $archivo = $ruta . $_FILES["archivo"]["name"];

        //Verificar que la ruta definida exista o no
        if (!file_exists($ruta)) {
            mkdir($ruta);
        }

        //Veriricar si existen archivos duplicados
        if (!file_exists($archivo)) {

            //Guardar el archivo
            $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

            //Evaluar si el archivo pudo guardarse
            if ($resultado) {
                echo "Archivo Guardado";
            } else {
                echo "Archivo NO guardado";
            }
        } else {
            echo "Archivo ya Existente";
        }
    } else {
        echo "Archivo NO permitido o excede las dimensiones";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">

        <link href = "css/bootbootstrap.min.css" rel = "stylesheet">
        <link href = "css/bootstrap-theme.css" rel = "stylesheet">

        <!--Definir que la página utilizará JavaScript con Jquery-->
        <script src = "js/jquery-3.1.1.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>

        <title>Actualizar</title>

    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <div class = "row" style = "text-align: center">
                    <!-- Se evalúa la consulta de la clase-->
                    <?php if ($resultado) { ?>
                        <h3>REGISTRO MODIFICADO</h3>
                    <?php } else { ?>
                        <h3>ERROR AL MODIFICAR</h3> 
                    <?php } ?>
                    <a href = "index.php" class = "btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>