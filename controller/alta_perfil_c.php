<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php';
include '../model/insert_perfil.php';

if (!isset($_SESSION['id_conductor'])) {
    echo "<script>
            alert('No has iniciado sesión. Por favor, inicia sesión primero.');
            window.location.href = '../view/login.php'; // Cambiar la ruta al login si es necesario
          </script>";
    exit();
}

// Obtener los datos del formulario
$idAlumno = $_SESSION['id_conductor'];

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telefono = $_POST['telefono'];
    $informacion = $_POST['informacion'];
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];

    // Verificar si ya existe la matrícula
    $sqlVerificar = "SELECT * FROM perfiles WHERE matricula = ?";
    $stmt = $conn->prepare($sqlVerificar);
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si la matrícula ya existe
        echo "<script>
                alert('La matrícula ya está registrada. Por favor, verifica los datos.');
                window.location.href = '../view/perfil/crearmiperfilconductor.php';
              </script>";
        exit();
    }

    // Subir la imagen
    $imagen = null;
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $directorioDestino = '../../estancia/uploads/fotosperfil/';
        $archivoImagen = $_FILES['fotoPerfil'];
        $nombreArchivo = $directorioDestino . basename($archivoImagen['name']);
        
        if (move_uploaded_file($archivoImagen['tmp_name'], $nombreArchivo)) {
            $imagen = $nombreArchivo; // Guardar la ruta relativa de la imagen
        }
    }

    // Llamar a la función para guardar el perfil en la base de datos
    if (guardarPerfil($conn, $idAlumno, $nombre, $telefono, $informacion, $imagen, $matricula)) {
        echo "<script>
                alert('Perfil guardado con éxito.');
                window.location.href = '../view/perfil/verificar_perfil_c.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al guardar el perfil. Inténtalo nuevamente.');
                window.location.href = '../view/perfil/crearperfilconductor.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
