<?php
include("conexion.php");

if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO productos(nombre, descripcion, precio, stock, estado)
            VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$estado')";

    mysqli_query($conn, $sql);

    header("Location: productos.php");
    exit();
}
?>

<h2>Agregar Producto</h2>

<form method="POST">

    Nombre:<br>
    <input type="text" name="nombre"><br>

    Descripción:<br>
    <input type="text" name="descripcion"><br>

    Precio:<br>
    <input type="text" name="precio"><br>

    Stock:<br>
    <input type="text" name="stock"><br>

    Estado:<br>
    <input type="text" name="estado"><br><br>

    <button type="submit" name="guardar">Guardar</button>
