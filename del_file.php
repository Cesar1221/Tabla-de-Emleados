<?php
//1.- Recibir el id por medio del método POST
$file = $_POST['id'];

//2.- Verificar que sea una imagen lo que se quiere eliminar
if(is_file($file)){
    
    //2.1.- Otorgar permisos a directorio para eliminarlo
    chmod($file, 0777);
    
    //2.2.- Eliminar el archivo
    if(!unlink($file)){
        echo false;
    }
}
?>

