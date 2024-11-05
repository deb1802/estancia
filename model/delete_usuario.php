<?php

function eliminarUsuario($conn, $id) {
    // Consulta para eliminar el usuario basado en el ID
    $sql = "DELETE FROM usuarios WHERE id = ?"; // Asegúrate de que el nombre de la tabla y la columna sean correctos

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "i", $id); // 'i' indica que el parámetro es un entero

    // Ejecutar la declaración
    $execute = mysqli_stmt_execute($stmt);

    // Cerrar la declaración
    mysqli_stmt_close($stmt);

    return $execute; // Devuelve true si la eliminación fue exitosa
}
?>
