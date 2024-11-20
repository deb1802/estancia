<?php
include '../model/db.php';
include '../model/insert_avisos_g.php';

$titulo = $_POST['titulo'] ?? null;
$mensaje = $_POST['mensaje'] ?? null;

if (!empty($titulo) && !empty($mensaje)) {
    $resultado = insertarAviso($conn, $titulo, $mensaje);

    if ($resultado) {
        header("Location: ../../../../estancia/view/avisos/crud_avisos.php");
        exit;
    } else {
        echo "Error al registrar el aviso.";
    }
} else {
    echo "Todos los campos son obligatorios.";
}
?>
