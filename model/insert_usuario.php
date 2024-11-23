<?php
function insertarUsuario($conn, $nombre, $apellidos, $correo, $user, $pass) {
    // Verificar si el correo ya existe en la base de datos
    $sql_check_email = "SELECT COUNT(*) FROM usuarios WHERE correo = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check_email);
    mysqli_stmt_bind_param($stmt_check, "s", $correo);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $email_count);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    // Si el correo ya existe, retornar un mensaje de error
    if ($email_count > 0) {
        return "Error: El correo electrónico ya está registrado.";
    }

    // Si el correo no existe, proceder con la inserción del nuevo usuario
    $tipo_usuario = 1; // Asignar el tipo de usuario como 'alumno' por defecto

    $sql = "INSERT INTO usuarios(nombre, apellido, correo, usuario, contrasena, tipo) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular los parámetros, incluyendo el tipo de usuario como entero ("i")
    mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $apellidos, $correo, $user, $pass, $tipo_usuario);

    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);

    // Cerrar la declaración
    mysqli_stmt_close($stmt);

    // Verificar si la inserción fue exitosa
    if ($execute) {
        return true;  // Registro exitoso
    } else {
        return "Error al registrar el usuario: " . mysqli_error($conn);
    }
}
?>
