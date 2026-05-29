<?php
include("conexion.php");

// VALIDAR ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se ha seleccionado ninguna venta");
}

$id = (int) $_GET['id'];

// CONSULTA
$sql = "
SELECT 
    v.id_venta,
    p.nombre,
    v.cantidad,
    v.totales,
    v.fecha
FROM ventas v
INNER JOIN productos p ON p.id_producto = v.id_producto
WHERE v.id_venta = $id
";

$resultado = mysqli_query($conn, $sql);

// VALIDAR ERROR SQL
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// VALIDAR SI EXISTE
if (mysqli_num_rows($resultado) == 0) {
    die("No se encontró la venta");
}

$venta = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
</head>
<body>

<h2>Factura</h2>

<hr>

<p><strong>ID Venta:</strong> <?php echo $venta['id_venta']; ?></p>
<p><strong>Producto:</strong> <?php echo $venta['nombre']; ?></p>
<p><strong>Cantidad:</strong> <?php echo $venta['cantidad']; ?></p>
<p><strong>Total:</strong> Q<?php echo $venta['totales']; ?></p>
<p><strong>Fecha:</strong> <?php echo $venta['fecha']; ?></p>

<hr>

<button onclick="window.print()">Imprimir Factura</button>

</body>
</html>