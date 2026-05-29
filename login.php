<?php
session_start();
include "conexion.php";

$mensaje = "";

if(isset($_POST['ingresar'])){

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        // Verificar si está bloqueado
        if($user['bloqueado'] == 1){

            $mensaje = "Usuario bloqueado";

        } else {

            // Verificar contraseña ENCRIPTADA
            if(password_verify($contrasena, $user['contrasena'])){

                // reset intentos
                mysqli_query($conn, "UPDATE usuario SET intentos=0 WHERE id=".$user['id']);

                // guardar sesión
                $_SESSION['usuario'] = $usuario;

                // REDIRECCIÓN REAL
                header("Location: dashboard.php");
                exit();

            } else {

                // sumar intentos
                $intentos = $user['intentos'] + 1;

                if($intentos >= 3){

                    mysqli_query($conn, "UPDATE usuario SET intentos=$intentos, bloqueado=1 WHERE id=".$user['id']);

                    $mensaje = "Usuario bloqueado por 3 intentos";

                } else {

                    mysqli_query($conn, "UPDATE usuario SET intentos=$intentos WHERE id=".$user['id']);

                    $mensaje = "Contraseña incorrecta";
                }
            }
        }

    } else {
        $mensaje = "Usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card p-4">

                <h3 class="text-center">Sistema POS</h3>

                <?php if($mensaje != "") { ?>
                    <div class="alert alert-danger text-center">
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

                    <button type="submit" name="ingresar" class="btn btn-primary w-100">
                        Ingresar
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>