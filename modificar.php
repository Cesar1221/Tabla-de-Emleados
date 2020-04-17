<?php
require 'conexion.php';

//Obtener el ID que se está enviando a esta página
$id = $_GET['id'];

//Obtener los datos del registro cuyo id fue recibido
$sql = "SELECT * FROM empleados WHERE id = '$id'";

//Se ejecuta la consulta 
$resultado = $mysqli->query($sql);

//Se guardan los datos obtenidos de la consulta en un arreglo
$row = $resultado->fetch_array(MYSQLI_ASSOC);

$fechaIngreso = $row['f_ingreso'];

$ant = 2020 - $fechaIngreso;

$sueldo = $row['salario'];

$aguinaldo = ($sueldo * 2);

?>

<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">

        <!--Hojas de estilo Bootstrap-->
        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/bootstrap-theme.css" rel = "stylesheet">

        <!--Definir que la página utilizará JavaScript con Jquery-->
        <script src = "js/jquery-3.1.1.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>

        <title>Modificar</title>

        <!-- Función para eliminar la imagen del registro para su modificación -->
        <script type="text/javascript">
            $(document).ready(function(){
              $('.delete').click(function(){
               var parent = $(this).parent().attr('id');
               var services = $(this).parent().attr('data');
               var dataString = 'id='+services;
              
               $.ajax({
                 type: "POST",
                 url: "del_file.php",
                 data: dataString,
                 success: function(){
                     location.reload();
                 }
              });
           }); 
        });
        </script>

    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <br>
                <h3 style = "text-align: center">REGISTRO <strong>EMPLEADO</strong></h3>
                <br>
            </div>

            <!-- Formulario del nuevo registro -->
            <form class = "form-horizontal" method = "POST" action = "update.php" enctype="multipart/form-data" autocomplete = "off">

                <!-- Por cada campo a guardar en la base se crea un grupo -->
                <!-- Nombre -->           
                <div class = "form-group">
                    <label for = "nombre" class = "col-sm-2 control-label">Nombre</label>
                    <div class = "col-sm-10">
                        <input type = "text" class = "form-control" id = "nombre" name = "nombre" placeholder = "Nombre" value= "<?php echo $row['nombre']; ?>" required>
                    </div>
                </div>

                <!-- Recuperar el ID para actualizar el registro seleccionado -->
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />

                <!-- APELLIDO -->
                <div class = "form-group">
                    <label for = "apellido" class = "col-sm-2 control-label">Apellido</label>
                    <div class = "col-sm-10">
                        <input type = "apellido" class = "form-control" id = "apellido" name = "apellido" placeholder = "Apellido" value= "<?php echo $row['apellido']; ?>" required>
                    </div>
                </div>

                <!-- GENERO -->
                <div class="form-group">
                    <label for = "genero" class = "col-sm-2 control-label">Género</label>
                    <div class = "col-sm-10">
                        <select class = "form-control" id = "genero" name = "genero">
                            <option value="HOMBRE" <?php if ($row['genero'] == 'HOMBRE') echo 'selected'; ?>>Hombre</option>
                            <option value="MUJER" <?php if ($row['genero'] == 'MUJER') echo 'selected'; ?>>Mujer</option>
                        </select>
                    </div>
                </div>


                <!-- FECHA DE NACIMIENTO -->
                <div class="form-group">
                    <label for = "f_nacimiento" class = "col-sm-2 control-label">Fecha Nacimiento</label>
                    <div class = "col-sm-10">
                        <input type = "date" class = "form-control" id = "f_nacimiento" name = "f_nacimiento" placeholder = "Fecha nacimiento" value="<?php echo $row['f_nacimiento']; ?>" required>
                    </div>
                </div>

                <!-- FECHA DE INGRESO -->
                <div class="form-group">
                    <label for = "f_ingreso" class = "col-sm-2 control-label">Fecha Ingreso</label>
                    <div class = "col-sm-10">
                        <input type = "date" class = "form-control" id = "f_ingreso" name = "f_ingreso" placeholder = "Fecha ingreso" value="<?php echo $row['f_ingreso']; ?>" required>
                    </div>
                </div>


                <!-- ANTIGUEDAD -->
                <div class = "form-group">
                    <label for = "antiguedad" class = "col-sm-2 control-label">Antiguedad</label>
                    <div class = "col-sm-10">
                        <input type = "int" class = "form-control" id = "antiguedad" name = "antiguedad" placeholder = "Antiguedad" value= "<?php echo $ant, ' años' ?>" required>
                    </div>
                </div>


                <!-- SALARIO -->
                <div class="form-group">
                    <label for = "salario" class = "col-sm-2 control-label">Salario</label>
                    <div class = "col-sm-10">
                        <input type = "texto" class = "form-control" id = "salario" name = "salario" placeholder = "Salario" value="<?php echo '$', $row['salario'], ' pesos'; ?>" required>
                    </div>
                </div>
                

                <!-- AGUINALDO -->
                <div class = "form-group">
                    <label for = "aguinaldo" class = "col-sm-2 control-label">Aguinaldo</label>
                    <div class = "col-sm-10">
                        <input type = "int" class = "form-control" id = "aguinaldo" name = "aguinaldo" placeholder = "Aguinaldo" value= "<?php echo '$', $aguinaldo, ' pesos' ?>" required>
                    </div>
                </div>


                <!-- SECCIÓN PARA RECUPERAR Y MOSTRAR LA IMAGEN DEL REGISTRO -->
                <div class="form-group">
                    <label for="archivo" class="col-sm-2 control-label">Archivo</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="archivo" name="archivo"

                        <!-- RECUPERACIÓN Y DESPLIEGUE DE LA IMAGEN -->
                        <?php
                        //Recuperar la carpeta cuyo id se invoca arriba
                        $path = "files/" . $id;

                        //Verificar la existencia de la carpeta
                        if (file_exists($path)) {

                            //Abrir la carpeta y recuperar todos sus archivos dentro
                            $directorio = opendir($path);

                            //Desglosar los archivos recuperados
                            while ($archivo = readdir($directorio)) {

                                //Filtrar archivos para no tomar en cuenta carpetas
                                if (!is_dir($archivo)) {

                                    //Imprimir el archivo imagen
                                    echo "<div data = '" . $path . "/" . $archivo .
                                    "'><a href = '" . $path . "/" . $archivo, "'
                                                title='Ver Archivo Adjunto'><span
                                                class = 'glyphicon
                                                glyphicon-picture'></span></a>";

                                    //Colocar un bote de basura para eliminar la imagen
                                    echo"$archivo <a href='#' class='delete'
                                            title='Ver Archivo Adjunto'><span
                                            class='glyphicon glyphicon-trash'
                                            aria-hidden='true'></span></a></div>";

                                    //Mostrar la imagen
                                    echo "<img src='files/$id/$archivo' width='300'/>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- BOTONES DE MOVIMIENTO -->
                <div class="form-group">
                    <div class = "col-sm-offset-2 col-sm-10">
                        <a href="index.php" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>