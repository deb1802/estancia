<?php include "../view/header.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Definición de metadatos del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta Nueva</title>
    
    <!-- Inclusión de hojas de estilo y scripts necesarios -->
    <link rel="stylesheet" href="../public/css/registro.css">
    <script src="../public/js/validacion_registro.js"></script>
</head>
<body>
    <!-- Contenedor principal para el formulario de registro -->
    <div class="contenedor_login">
        <div class="login-box">
            <h2>Crear una cuenta nueva</h2>
            <!-- Enlace para acceder si el usuario ya está registrado -->
            <p>¿Ya estás registrado? <a href="../view/login.php">Accede</a></p>
            
            <!-- Formulario de registro que se envía al archivo "alta_usuario.php" -->
            <form name="frm" action="../controller/alta_usuario.php" method="post" onsubmit="return validacion();">
                
                <!-- Campo para el nombre del usuario -->
                <div class="input">
                    <input type="text" placeholder="Nombre" name="nombre">
                </div>
                <!-- Mensaje de error para el campo "nombre" -->
                <p class="alert alert-danger" id="errorNombre" style="display: none;">
                    El campo nombre debe contener entre 3 y 40 caracteres y no debe contener números.
                </p>
                
                <!-- Campo para el apellido del usuario -->
                <div class="input">
                    <input type="text" placeholder="Apellido" name="apellido">
                </div>
                <!-- Mensaje de error para el campo "apellido" -->
                <p class="alert alert-danger" id="errorApellido" style="display: none;">
                    El campo apellido debe contener entre 3 y 40 caracteres y no debe contener números.
                </p>
                
                <!-- Campo para el correo electrónico del usuario -->
                <div class="input">
                    <input type="email" placeholder="Correo Electrónico" name="correo">
                </div>
                <!-- Mensaje de error para el campo "correo" -->
                <p class="alert alert-danger" id="errorCorreo" style="display: none;">
                    Ingresa un correo electrónico válido con dominio "@upemor.edu.mx".
                </p>
                
                <!-- Campo para el nombre de usuario -->
                <div class="input">
                    <input type="text" placeholder="Usuario" name="usuario">
                </div>
                <!-- Mensaje de error para el campo "usuario" -->
                <p class="alert alert-danger" id="errorUsuario" style="display: none;">
                    El campo usuario debe tener entre 4 y 20 caracteres.
                </p>
                
                <!-- Campo para la contraseña -->
                <div class="input">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                </div>
                <!-- Mensaje de error para el campo "contraseña" -->
                <p class="alert alert-danger" id="errorContrasena" style="display: none;">
                    La contraseña debe tener al menos 6 caracteres.
                </p>
                
                <!-- Botón para enviar el formulario -->
                <button type="submit" class="form_btn">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>
