<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard POS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Sistema POS</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-5">

    <h3 class="mb-4">Bienvenido al sistema POS</h3>

    <div class="row">

        <!-- Ventas -->
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Ventas</h5>
                    <p>Registrar ventas</p>
                    <a href="ventas.php" class="btn btn-primary w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Compras -->
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Compras</h5>
                    <p>Registrar compras</p>
                    <a href="compras.php" class="btn btn-success w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Productos</h5>
                    <p>Gestionar inventario</p>
                    <a href="productos.php" class="btn btn-warning w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Reportes -->
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Reportes</h5>
                    <p>Ventas y control</p>
                    <a href="reporte_ventas.php" class="btn btn-info w-100">Ir</a>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">

        <!-- Kardex -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Kardex</h5>
                    <p>Movimientos de inventario</p>
                    <a href="kardex.php" class="btn btn-dark w-100">Ver Kardex</a>
                </div>
            </div>
        </div>

        <!-- Facturas -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Facturas</h5>
                    <p>Generar comprobantes</p>
                    <a href="facturas.php" class="btn btn-secondary w-100">Ver Facturas</a>
                </div>
            </div>
        </div>

        <!-- Devoluciones -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Devoluciones</h5>
                    <p>Registrar devoluciones</p>
                    <a href="devoluciones.php" class="btn btn-danger w-100">Ir</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>