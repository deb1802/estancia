<?php
function insertarAviso($conn, $titulo, $mensaje) {
    $sql = "INSERT INTO avisosGeneral (titulo, mensaje) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $titulo, $mensaje);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    } else {
        return false;
    }
}
?>
