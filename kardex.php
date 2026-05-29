<?php
include("conexion.php");

$sql = "
SELECT 
    k.producto_id,
    p.nombre AS producto,
    k.tipo,
    k.cantidad,
    k.detalle,
    k.fecha
FROM kardex k
INNER JOIN productos p ON p.id_producto = k.producto_id
ORDER BY k.fecha DESC
";

$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex</title>
</head>
<body>

<h2>Movimientos Kardex</h2>

<table border="1" cellpadding="5">

<tr>
    <th>Producto</th>
    <th>Tipo</th>
    <th>Cantidad</th>
    <th>Detalle</th>
    <th>Fecha</th>
</tr>

<?php while($row = mysqli_fetch_assoc($resultado)) { ?>

<tr>
    <td><?php echo $row['producto']; ?></td>
    <td><?php echo $row['tipo']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td><?php echo $row['detalle']; ?></td>
    <td><?php echo $row['fecha']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>