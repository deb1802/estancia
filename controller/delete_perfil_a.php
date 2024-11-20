<?php
include '../model/eliminar_perfil_a.php';

// Verificar si el ID se proporcionó mediante POST o GET
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAlumno'])) {
    $idAlumno = intval($_POST['idAlumno']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idAlumno'])) {
    $idAlumno = intval($_GET['idAlumno']);
} else {
    echo "Error: No se proporcionó un ID válido.";
    exit();
}

// Llamar a la función para eliminar el perfil
if (eliminarPerfil($idAlumno)) {
    header("Location: ../view/perfil/perfiles_a.php");
    exit();
} else {
    // Redirigir o mostrar un mensaje de error en caso de que falle la eliminación
    echo "Error: No se pudo eliminar el perfil.";
    exit();
}
?>
