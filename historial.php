<?php

include("conexion.php");

$resultado = mysqli_query($conexion, "
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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas</title>
</head>

<body>

<h2>Historial de Ventas</h2>

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

        <td><?php echo $row['totales']; ?></td>

        <td><?php echo $row['fecha']; ?></td>

        <td>
            <a href="factura.php?id=<?php echo $row['id_venta']; ?>">
                Ver Factura
            </a>
        </td>

    </tr>
    <?php } ?>

</table>

</body>
</html>
