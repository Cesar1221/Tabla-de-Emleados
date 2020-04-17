<?php

require 'conexion.php';

$where = "";

if (!empty($_POST)){
    $valor = $_POST['campo'];
    if (!empty($valor)){
        $where = "WHERE nombre LIKE '%$valor'";
    }
}


$sql = "SELECT * FROM empleados $where";

$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <link href="css/bootstrap.min.css" rel = "stylesheet">
        <link href="css/bootstrap-theme.css" rel = "stylesheet">

        <script src = "js/jquery-3.1.1.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>

        <title>Tabla de Empleados </title>
    </head>
    <body>

        <div class="container">

            <div class="row">
                <br>
                <h3 style = "text-align: center">Tabla de Empleados <strong>MERCOSUR</strong></h3>
            </div>

            <div class="row">      
                <a href = "nuevo.php" class = "btn btn-primary">Nuevo Registro</a>
                <br>
                <br>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <b>Nombre: </b><input type="text" id="campo" name="campo"/>
                    <input type="submit" id="enviar" name="enviar" value="buscar" class="btn btn-info"/>
                </form>
            </div>
            <br>

            <!-- Tabla para mostrar los registros de la Base -->
            <div class = "row table-responsive">
                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Género</th>
                            <th>Salario</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Disponer los datos mediante el recorrido de la variable resultado-->
                        <?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['apellido']; ?></td>
                                <td><?php echo $row['genero']; ?></td>
                                <td><?php echo $row['salario']; ?></td>
                                <td>
                                    <a href="modificar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>
                                <td>
                                    <a href="#" data-href="eliminar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal sobre el proceso de eliminción de un registro -->
        <div class = "modal fade" id = "confirm-delete" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
            <div class = "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>
                        <h4 class = "modal-title" id = "myModalLabel">Eliminar Registro</h4>
                    </div>
                    <div class = "modal-body">¿Desea eliminar este Registro?</div>
                    <div class = "modal-footer">
                        <button type = "button" class = "btn btn-default" data-dismiss = "modal">Cancelar</button>
                        <a class = "btn btn-danger btn-ok">Borrar</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#confirm-delete').on('show.bs.modal', function(e){
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>

    </body>
</html>