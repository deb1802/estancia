<?php
function insertarUsuario($conn, $nombre, $apellidos, $correo, $user, $pass) {
    //recordar que por default es alumno, sólo el admin lo puede cambiar a conductor
    
    $tipo_usuario = 1;
    
    $sql = "INSERT INTO usuarios(nombre, apellido, correo, usuario, contrasena, tipo) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular los parámetros, incluyendo $tipo_usuario como entero ("i" en el formato)
    mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $apellidos, $correo, $user, $pass, $tipo_usuario);

    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);

    // Cerrar la declaración
    mysqli_stmt_close($stmt);

    return $execute; 
}
?>
