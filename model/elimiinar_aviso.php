<?php
function deleteAviso($conn, $id) {
    $sql = "DELETE FROM avisosGeneral WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Vincular el parámetro ID
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Cerrar el statement
        mysqli_stmt_close($stmt);
    }
}
?>
