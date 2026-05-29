<?php
include("conexion.php");

$resultado = mysqli_query($conn, "
SELECT * FROM ventas
ORDER BY id_venta DESC
");

if (!$resultado) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Facturas</title>
</head>
<body>

<h2>Lista de Facturas</h2>

<?php
echo "Cantidad de ventas: " . mysqli_num_rows($resultado);
?>

<table border="1" cellpadding="5">

<?php
if(mysqli_num_rows($resultado) > 0){
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th>Fecha</th>
        <th>Acción</th>
    </tr>

<?php
while($row = mysqli_fetch_assoc($resultado)){
?>

<tr>
    <td><?php echo $row['id_venta']; ?></td>
    <td><?php echo $row['id_producto']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td>Q<?php echo $row['totales']; ?></td>
    <td><?php echo $row['fecha']; ?></td>
    <td>
        <a href="factura.php?id=<?php echo $row['id_venta']; ?>">
            Ver factura
        </a>
    </td>
</tr>

<?php
}
?>

</table>

<?php
}else{
    echo "No hay ventas registradas";
}
?>

<br><br>
<a href="dashboard.php">Volver</a>

</body>
</html>