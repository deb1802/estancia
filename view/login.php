<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Inclusión de archivos CSS y JavaScript -->
    <link rel="stylesheet" href="../public/css/login.css"> <!-- Estilos para el formulario de login -->
    <script src="../public/js/validacion_login.js" defer></script> <!-- Validaciones del formulario -->
    <script src="../public/js/mostrar_contrasena.js" defer></script> <!-- Función para mostrar/ocultar contraseña -->
</head>

<body>
    <!-- Contenedor principal del formulario de inicio de sesión -->
    <div class="contendor_login">
        <div class="login-box">
            <h2>Iniciar sesión</h2>
            <p>Inicia sesión para continuar</p>

            <?php
            // Mostrar mensaje de error si las credenciales son incorrectas
            if (isset($_GET['error'])) {
                echo '<p class="alert alert-danger">Credenciales incorrectas. Inténtalo de nuevo.</p>';
            }
            ?>

            <!-- Formulario de inicio de sesión -->
            <form name="frm" action="../controller/validacion_login.php" method="post" onsubmit="return validacionLogin();">
                <!-- Campo de usuario -->
                <div class="input">
                    <img src="../public/img/user.png" alt="icono usuario" class="icono"> <!-- Icono de usuario -->
                    <input type="text" placeholder="Ingresa usuario" name="usuario">
                </div>
                <!-- Mensaje de error para el campo usuario -->
                <p class="alert alert-danger" id="errorUsuario" style="display: none;">
                    Completa el campo usuario.
                </p>

                <!-- Campo de contraseña -->
                <div class="input">
                    <img src="../public/img/pass.png" alt="icono candado" class="icono"> <!-- Icono de contraseña -->
                    <input type="password" placeholder="**********" name="contrasena">
                    <!-- Botón para mostrar/ocultar contraseña -->
                    <button type="button" id="togglePassword" class="btn_mostrarContra" onclick="visibilidadContrasena()">
                        <img src="../public/img/eye.svg" alt="Mostrar contraseña" style="width: 20px; height: 20px;"> <!-- Icono de ojo -->
                    </button>
                </div>
                <!-- Mensaje de error para el campo contraseña -->
                <p class="alert alert-danger" id="errorContrasena" style="display: none;">
                    Completa el campo contraseña.
                </p>

                <!-- Botón de envío del formulario -->
                <button type="submit">Accede</button>
            </form>
        </div>
    </div>
</body>

</html>
