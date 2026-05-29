<?php

include("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id_producto='$id'";

mysqli_query($conexion, $sql);

header("Location: productos.php");

?>