<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <script src="../public/js/validacion_login.js" defer></script>
    <script src="../public/js/mostrar_contrasena.js" defer></script> 
</head>
<body>
    <div class="contendor_login">
        <div class="login-box">
            <h2>Iniciar sesión</h2>
            <p>Inicia sesión para continuar</p>
            <?php
            // Por si no son correctas las credenciales
            if (isset($_GET['error'])) {
                echo '<p class="alert alert-danger">Credenciales incorrectas. Inténtalo de nuevo.</p>';
            }
            ?>
            <form name="frm" action="../controller/validacion_login.php" method="post" onsubmit="return validacionLogin();">
                <div class="input">
                    <img src="../public/img/user.png" alt="icono usuario" class="icono">
                    <input type="text" placeholder="Ingresa usuario" name="usuario">
                </div>
                <p class="alert alert-danger" id="errorUsuario" style="display: none;">
                    Completa el campo usuario.
                </p>
                <div class="input">
                    <img src="../public/img/pass.png" alt="icono candado" class="icono">
                    <input type="password" placeholder="Ingresa Contraseña" name="contrasena">
                    <button type="button" id="togglePassword" class="btn_mostrarContra" onclick="visibilidadContrasena()">
                        <img src="../public/img/eye.svg" alt="Mostrar contraseña" style="width: 20px; height: 20px;"> <!-- Ajusta el tamaño según sea necesario -->
                    </button>


                </div>
                <p class="alert alert-danger" id="errorContrasena" style="display: none;">
                    Completa el campo contraseña.
                </p>
                <button type="submit">Accede</button>
            </form>
        </div>
    </div>
</body>
</html>
