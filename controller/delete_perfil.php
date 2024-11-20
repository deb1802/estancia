<?php
include '../model/eliminar_perfil.php';

if (isset($_GET['idAlumno'])) {
    $idAlumno = intval($_GET['idAlumno']);

    if (eliminarPerfil($idAlumno)) {
        header("Location: ../view/perfil/verificar_perfil.php");
        exit(); 
    } else {
        //header("Location: lista_perfiles.php?mensaje=error_eliminacion");
        exit();
    }
} else {
    echo "Error: No se proporcionó un ID válido.";
}
?>
