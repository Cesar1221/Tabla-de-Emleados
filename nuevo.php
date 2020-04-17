<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/bootstrap-theme.css" rel = "stylesheet">

        <script src = "js/jquery-3.1.1.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>

        <title>Nuevo Registro</title>
        
    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <br>
                <h3 style = "text-align: center">NUEVO REGISTRO</h3>
                <br>
            </div>

            <!-- Formulario del nuevo registro -->
            <form class = "form-horizontal" method = "POST" action = "guardar.php" enctype = "multipart/form-data" autocomplete = "off">

                <!-- Por cada campo a guardar en la base se crea un grupo -->
                <!-- NOMBRE -->           
                <div class = "form-group">
                    <label for = "nombre" class = "col-sm-2 control-label">Nombre</label>
                    <div class = "col-sm-10">
                        <input type = "text" class = "form-control" id = "nombre" name = "nombre" placeholder = "Nombre" required>
                    </div>
                </div>


                <!-- APELLIDO -->
                <div class = "form-group">
                    <label for = "apellido" class = "col-sm-2 control-label">Apellido</label>
                    <div class = "col-sm-10">
                        <input type = "text" class = "form-control" id = "apellido" name = "apellido" placeholder = "Apellido" required>
                    </div>
                </div>


                <!-- GÉNERO -->
                <div class="form-group">
                    <label for = "genero" class = "col-sm-2 control-label">Género</label>
                    <div class = "col-sm-10">
                        <select class = "form-control" id = "genero" name = "genero">
                            <option value="HOMBRE">Hombre</option>
                            <option value="MUJER">Mujer</option>
                        </select>
                    </div>
                </div>


                <!-- FECHA DE NACIMIENTO -->
                <div class = "form-group">
                    <label for = "f_nacimiento" class = "col-sm-2 control-label">Fecha de nacimiento</label>
                    <div class = "col-sm-10">
                        <input type = "date" class = "form-control" id = "f_nacimiento" name = "f_nacimiento" required>
                    </div>
                </div>


                <!-- FECHA DE INGRESO -->
                <div class = "form-group">
                    <label for = "f_ingreso" class = "col-sm-2 control-label">Fecha de ingreso</label>
                    <div class = "col-sm-10">
                        <input type = "date" class = "form-control" id = "f_ingreso" name = "f_ingreso" required>
                    </div>
                </div>


                <!-- SALARIO -->
                <div class = "form-group">
                    <label for = "salario" class = "col-sm-2 control-label">Salario</label>
                    <div class = "col-sm-10">
                        <input type = "salary" class = "form-control" id = "salario" name = "salario" placeholder = "Salario" required>
                    </div>
                </div>
                
                
                <!-- SECCIÓN PARA CARGAR UN ARCHIVO O IMAGEN -->
                <div class="form-group">
                    <label for="archivo" class="col-sm-2 control-label">Archivo</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="archivo" name="archivo">
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