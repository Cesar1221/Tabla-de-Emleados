<?php

$mysqli = new mysqli('localhost', 'root', '', 'mercosur');

if(mysqli_connect_errno()) {
    echo 'Fallo en la conexión', mysqli_connect_error();
    exit();
}

?>