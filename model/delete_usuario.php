<?php

function eliminarUsuario($conn, $id) {
    $sql = "DELETE FROM usuarios WHERE id = ?";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);

    // Cerrar la declaración
    mysqli_stmt_close($stmt);

    return $execute; // Devuelve true si la eliminación fue exitosa
}
?>
