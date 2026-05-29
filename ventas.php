<?php

include("conexion.php");

$mensaje = "";

// PROCESAR VENTA
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $tipo_pago = $_POST['tipo_pago'];
    $fecha_limite = $_POST['fecha_limite'];

    if (!$id || !$cantidad) {

        $mensaje = "Debes seleccionar producto y cantidad";

    } else {

        // Buscar producto
        $buscar = mysqli_query($conn, "
        SELECT * FROM productos 
        WHERE id_producto = $id
        ");

        $producto = mysqli_fetch_assoc($buscar);

        if (!$producto) {

            $mensaje = "Producto no encontrado";

        } else {

            $stock_actual = (int)$producto['stock'];

            if ($cantidad > $stock_actual) {

                $mensaje = "No hay suficiente stock";

            } else {

                // Calcular total
                $precio = (float)$producto['precio'];
                $total = $precio * $cantidad;

                // ESTADO PAGO
                if($tipo_pago == "credito"){

                    $estado_pago = "pendiente";

                } else {

                    $estado_pago = "pagado";
                    $fecha_limite = NULL;
                }

                // Actualizar stock
                mysqli_query($conn, "
                UPDATE productos 
                SET stock = stock - $cantidad 
                WHERE id_producto = $id
                ");

                // Insertar venta
                $sql = "
                INSERT INTO ventas 
                (id_producto, cantidad, totales, tipo_pago, fecha_limite, estado_pago)
                VALUES 
                ($id, $cantidad, $total, '$tipo_pago', " . 
                ($fecha_limite ? "'$fecha_limite'" : "NULL") . ", '$estado_pago')
                ";

                if (mysqli_query($conn, $sql)) {

                    // REGISTRAR EN KARDEX
                    mysqli_query($conn, "
                    INSERT INTO kardex (producto_id, tipo, cantidad, detalle, fecha)
                    VALUES ($id, 'salida', $cantidad, 'venta', NOW())
                    ");

                    $mensaje = "Venta realizada correctamente";

                } else {

                    $mensaje = "Error al guardar la venta";
                }
            }
        }
    }
}

// CARGAR PRODUCTOS
$productos = mysqli_query($conn, "
SELECT * FROM productos
");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ventas POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between">

        <h2>Módulo de Ventas</h2>

        <a href="dashboard.php" class="btn btn-secondary">
            Volver
        </a>

    </div>

    <hr>

    <?php if($mensaje != "") { ?>
        <div class="alert alert-info">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <div class="card shadow">

        <div class="card-body">

            <form method="POST">

                <label>Producto</label>

                <select name="producto" class="form-select" required>

                    <option value="">Seleccione</option>

                    <?php while($p = mysqli_fetch_assoc($productos)) { ?>
                        <option value="<?= $p['id_producto']; ?>">
                            <?= $p['nombre']; ?> (Stock: <?= $p['stock']; ?>)
                        </option>
                    <?php } ?>

                </select>

                <br>

                <label>Cantidad</label>

                <input type="number" name="cantidad" class="form-control" required min="1">

                <br>

                <label>Tipo de Pago</label>

                <select name="tipo_pago" class="form-select" required>
                    <option value="contado">Contado</option>
                    <option value="credito">Crédito</option>
                </select>

                <br>

                <label>Fecha Límite (solo crédito)</label>

                <input type="date" name="fecha_limite" class="form-control">

                <br>

                <button type="submit" class="btn btn-primary w-100">
                    Realizar Venta
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>