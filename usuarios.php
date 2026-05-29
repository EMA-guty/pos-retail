<?php
include "conexion.php";

$mensaje = "";

if(isset($_POST['guardar'])){

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // VALIDAR CONTRASEÑA FUERTE
    if(
        strlen($contrasena) < 8 ||
        strlen($contrasena) > 11 ||
        !preg_match('/[A-Z]/', $contrasena) ||
        !preg_match('/[a-z]/', $contrasena) ||
        !preg_match('/[0-9]/', $contrasena) ||
        !preg_match('/[\W]/', $contrasena)
    ){

        $mensaje = "La contraseña debe tener mayúscula, minúscula, número y símbolo.";

    } else {

        // ENCRIPTAR
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // GUARDAR
        $sql = "INSERT INTO usuario(usuario, contrasena, intentos, bloqueado)
                VALUES('$usuario','$hash',0,0)";

        if(mysqli_query($conn, $sql)){

            $mensaje = "Usuario guardado correctamente";

        } else {

            $mensaje = "Error al guardar";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card p-4">

                <h3 class="text-center">Crear Usuario</h3>

                <?php if($mensaje != ""){ ?>

                    <div class="alert alert-info">
                        <?php echo $mensaje; ?>
                    </div>

                <?php } ?>

                <form method="POST">

                    <label>Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>

                    <br>

                    <label>Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" required>

                    <br>

                    <button type="submit" name="guardar" class="btn btn-success w-100">
                        Guardar Usuario
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>