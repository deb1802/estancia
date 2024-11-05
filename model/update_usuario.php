<?php
function actualizarUsuario($conn, $id, $nombre, $apellido, $correo, $usuario, $tipo_usuario) {
    $sql = "UPDATE usuarios 
            SET nombre = ?, apellido = ?, correo = ?, usuario = ?, tipo = ? 
            WHERE id = ?;";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $apellido, $correo, $usuario, $tipo_usuario, $id);
    
    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
    
    return $execute; 
}
?>
