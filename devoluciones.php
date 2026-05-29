<?php
include "conexion.php";

$mensaje = "";

// PROCESAR DEVOLUCIÓN
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];
    $motivo = $_POST['motivo'];

    // Guardar devolución
    $sql = "INSERT INTO devoluciones (id_producto, tipo, cantidad, motivo)
            VALUES ($id, '$tipo', $cantidad, '$motivo')";
    mysqli_query($conn, $sql);

    // Ajustar stock
    if ($tipo == "COMPRA") {
        // devolución a proveedor (sale stock)
        mysqli_query($conn, "UPDATE productos SET stock = stock - $cantidad WHERE id_producto = $id");
    } else {
        // devolución de cliente (entra stock)
        mysqli_query($conn, "UPDATE productos SET stock = stock + $cantidad WHERE id_producto = $id");
    }

    $mensaje = "Devolución registrada correctamente";
}

// PRODUCTOS
$productos = mysqli_query($conn, "SELECT * FROM productos");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Devoluciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2>Módulo de Devoluciones</h2>

<p class="text-success"><?= $mensaje ?></p>

<form method="POST">

<label>Producto</label>
<select name="producto" class="form-select" required>
    <option value="">Seleccione</option>
    <?php while($p = mysqli_fetch_assoc($productos)) { ?>
        <option value="<?= $p['id_producto'] ?>">
            <?= $p['nombre'] ?>
        </option>
    <?php } ?>
</select>

<br>

<label>Tipo de devolución</label>
<select name="tipo" class="form-select" required>
    <option value="CLIENTE">Cliente (entrada stock)</option>
    <option value="COMPRA">Proveedor (salida stock)</option>
</select>

<br>

<label>Cantidad</label>
<input type="number" name="cantidad" class="form-control" required>

<br>

<label>Motivo</label>
<input type="text" name="motivo" class="form-control">

<br>

<button class="btn btn-primary w-100">Registrar devolución</button>

</form>

</body>
</html>