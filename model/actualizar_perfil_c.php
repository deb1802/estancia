<?php
session_start();
$idAlumno = $_SESSION['id_conductor'];
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $telefono = $_POST['telefono'];
    $informacion = $_POST['informacion'];
    $imagen = null;

    // Verificar si la matrícula ya existe para otro alumno
    $queryVerificarMatricula = "SELECT idAlumno FROM perfiles WHERE matricula = ? AND idAlumno != ?";
    $stmtVerificar = $conn->prepare($queryVerificarMatricula);
    $stmtVerificar->bind_param('si', $matricula, $idAlumno);
    $stmtVerificar->execute();
    $resultVerificar = $stmtVerificar->get_result();

    if ($resultVerificar->num_rows > 0) {
        echo "<script>
            alert('La matrícula ingresada ya está asociada a otro usuario. Por favor, verifica los datos.');
            window.history.back();
        </script>";
        exit(); 
    }

    // Subir nueva imagen o mantener la actual
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $directorioDestino = '../../estancia/uploads/fotosperfil/';
        $archivoImagen = $_FILES['fotoPerfil'];
        $nombreArchivo = $directorioDestino . basename($archivoImagen['name']);
        if (move_uploaded_file($archivoImagen['tmp_name'], $nombreArchivo)) {
            $imagen = $nombreArchivo;
        }
    } else {
        // Mantener la imagen actual si no se subió una nueva
        $queryImagen = "SELECT imagen FROM perfiles WHERE idAlumno = ?";
        $stmtImagen = $conn->prepare($queryImagen);
        $stmtImagen->bind_param('i', $idAlumno);
        $stmtImagen->execute();
        $resultImagen = $stmtImagen->get_result();
        if ($resultImagen->num_rows > 0) {
            $rowImagen = $resultImagen->fetch_assoc();
            $imagen = $rowImagen['imagen'];
        }
    }

    // Actualización en la base de datos
    $query = "UPDATE perfiles SET nombreUser = ?, matricula = ?, telefono = ?, informacion = ?, imagen = ? WHERE idAlumno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $nombre, $matricula, $telefono, $informacion, $imagen, $idAlumno);

    if ($stmt->execute()) {
        echo "<script>
            alert('Perfil actualizado con éxito.');
            window.location.href = '../../../../estancia/view/perfil/verificar_perfil_c.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar el perfil. Por favor, intenta de nuevo.');
            window.history.back();
        </script>";
    }
}
?>
