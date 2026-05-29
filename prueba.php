<?php

$conexion = new mysqli("localhost", "root", "", "pos_retail");

if ($conexion->connect_error) {

    die("Fallo conexión: " . $conexion->connect_error);

} else {

    echo "Conexión exitosa";

}

?>