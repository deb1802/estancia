<?php include "../view/header.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta Nueva</title>
    <link rel="stylesheet" href="../public/css/registro.css">
    <script src="../public/js/validacion_registro.js"></script>
</head>
<body>
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Crear una cuenta nueva</h2>
            <p>¿Ya estás registrado? <a href="../view/login.php">Accede</a></p>
            <form name="frm" action="../controller/alta_usuario.php" method="post" onsubmit="return validacion();">
                <div class="input">
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <p class="alert alert-danger" id="errorNombre" style="display: none;">
                    El campo nombre debe contener entre 3 y 40 caracteres y no debe contener números.
                </p>
                <div class="input">
                    <input type="text" placeholder="Apellido" name="apellido">
                </div>
                <p class="alert alert-danger" id="errorApellido" style="display: none;">
                    El campo apellido debe contener entre 3 y 40 caracteres y no debe contener números.
                </p>
                <div class="input">
                    <input type="email" placeholder="Correo Electrónico" name="correo">
                </div>
                <p class="alert alert-danger" id="errorCorreo" style="display: none;">
                    Ingresa un correo electrónico válido con dominio "@upemor.edu.mx".
                </p>
                <div class="input">
                    <input type="text" placeholder="Usuario" name="usuario">
                </div>
                <p class="alert alert-danger" id="errorUsuario" style="display: none;">
                    El campo usuario debe tener entre 4 y 20 caracteres.
                </p>
                <div class="input">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                </div>
                <p class="alert alert-danger" id="errorContrasena" style="display: none;">
                    La contraseña debe tener al menos 6 caracteres.
                </p>
                <button type="submit" class="form_btn">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>
