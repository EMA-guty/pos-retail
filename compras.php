<?php

include("conexion.php");

$mensaje = "";

// PROCESAR COMPRA
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    if (!$id || !$cantidad) {

        $mensaje = "Complete los datos";

    } else {

        // Buscar producto
        $buscar = mysqli_query($conn, "
        SELECT * FROM productos
        WHERE id_producto = $id
        ");

        $producto = mysqli_fetch_assoc($buscar);

        if ($producto) {

            $precio = $producto['precio'];
            $total = $precio * $cantidad;

            // AUMENTAR STOCK
            mysqli_query($conn, "
            UPDATE productos
            SET stock = stock + $cantidad
            WHERE id_producto = $id
            ");

            // GUARDAR COMPRA
            mysqli_query($conn, "
            INSERT INTO compras(id_producto, cantidad, total)
            VALUES($id, $cantidad, $total)
            ");

            // REGISTRAR EN KARDEX
            mysqli_query($conn, "
            INSERT INTO kardex (producto_id, tipo, cantidad, detalle, fecha)
            VALUES ($id, 'entrada', $cantidad, 'compra', NOW())
            ");

            $mensaje = "Compra registrada correctamente";

        } else {

            $mensaje = "Producto no encontrado";
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

<title>Compras</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between">

        <h2>Módulo de Compras</h2>

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
                        <option value="<?php echo $p['id_producto']; ?>">
                            <?php echo $p['nombre']; ?>
                            (Stock actual: <?php echo $p['stock']; ?>)
                        </option>
                    <?php } ?>

                </select>

                <br>

                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" min="1" required>

                <br>

                <button type="submit" class="btn btn-success w-100">
                    Registrar Compra
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>