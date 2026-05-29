<?php

include("conexion.php");

$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
<body>

<h1>Lista de Productos</h1>

<a href="agregar_producto.php">Agregar Producto</a>
<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Estado</th>
    <th>Accion</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

<tr>

<td><?php echo $fila['id_producto']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['precio']; ?></td>
<td><?php echo $fila['stock']; ?></td>
<td><?php echo $fila['estado']; ?></td>

<td>
<a href="eliminar_producto.php?id=<?php echo $fila['id_producto']; ?>">
Eliminar
</a>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>