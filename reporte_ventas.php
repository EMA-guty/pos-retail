<?php

include("conexion.php");

$resultado = mysqli_query($conn, "
SELECT 
    v.id_venta,
    p.nombre,
    v.cantidad,
    v.totales,
    v.fecha
FROM ventas v
JOIN productos p ON v.id_producto = p.id_producto
ORDER BY v.id_venta DESC
");

$total_general = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
</head>

<body>

<h1>Reporte de Ventas</h1>

<table border="1" cellpadding="5">

<tr>
    <th>ID Venta</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Total</th>
    <th>Fecha</th>
    <th>Factura</th>
</tr>

<?php while($row = mysqli_fetch_assoc($resultado)) { ?>

<tr>

    <td><?php echo $row['id_venta']; ?></td>
    <td><?php echo $row['nombre']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td>Q<?php echo $row['totales']; ?></td>
    <td><?php echo $row['fecha']; ?></td>

    <td>
        <a href="factura.php?id=<?php echo $row['id_venta']; ?>">
            Ver Factura
        </a>
    </td>

</tr>

<?php 

$total_general += $row['totales'];

} ?>

</table>

<br>

<h2>
Total General Vendido: Q<?php echo $total_general; ?>
</h2>

</body>
</html>