<?php
//Importar archivo que conecta con la Base de Datos
require 'conexion.php';

//Capturar el valor de cada campo desde la página de nuevo.php
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$genero = $_POST['genero'];
$f_nacimiento = $_POST['f_nacimiento'];
$f_ingreso = $_POST['f_ingreso'];
$salario = $_POST['salario'];

//Hacer el query a la BD para envíar los campos capturados
//Preparar el query
$sql = "INSERT INTO empleados (nombre, apellido, genero, f_nacimiento, f_ingreso, salario) VALUES ('$nombre', '$apellido', '$genero', '$f_nacimiento', '$f_ingreso', '$salario')";

//Ejecutar el query
$resultado = $mysqli->query($sql);

//SECCIÓN PARA IMAGEN
//Obtener el id del registro que se acaba de insertar
$id_insert = $mysqli->insert_id;

//Recibir el archivo de tipo File
//Verificar si el archivo viene con algún error
if ($_FILES["archivo"]["error"] > 0) {
    echo "Error al cargar el archivo";
} else {
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
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">

    <link href = "css/bootbootstrap.min.css" rel = "stylesheet">
    <link href = "css/bootstrap-theme.css" rel = "stylesheet">

    <!--Definir que la página utilizará JavaScript con Jquery-->
    <script src = "js/jquery-3.1.1.min.js"></script>
    <script src = "js/bootstrap.min.js"></script>

    <title>Guardar registro</title>

</head>
    <body>
        <div class = "container">
            <div class = "row">
                <div class = "row" style = "text-align: center">
                    <!-- Se evalúa la consulta de la clase-->
                    <?php if ($resultado) { ?>
                        <h3>REGISTRO GUARDADO</h3>
                    <?php } else { ?>
                        <h3>ERROR AL GUARDAR</h3> 
                    <?php } ?>
                    <a href = "index.php" class = "btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>

