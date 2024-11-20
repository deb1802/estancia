<?php
include '../model/insert_perfil.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAlumno = $_POST['idAlumno'];
    $telefono = $_POST['telefono'];
    $informacion = $_POST['informacion'];
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];

    // Verificar si ya existe un perfil con el mismo idAlumno o matricula
    $sqlVerificar = "SELECT * FROM perfiles WHERE idAlumno = ? OR matricula = ?";
    $stmt = $conn->prepare($sqlVerificar);
    $stmt->bind_param("is", $idAlumno, $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si ya existe, mostrar alerta y redirigir al formulario
        echo "<script>
                alert('Ya existe un perfil con este ID de alumno o matrícula. Por favor, verifica los datos.');
                window.location.href = '../view/perfil/crear_perfil_a.php';
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
                window.location.href = '../view/admin/menuadmin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al guardar el perfil. Inténtalo nuevamente.');
                window.location.href = '../view/perfil/crear_perfil.php';
              </script>";
    }
    $stmt->close();
    $conn->close();
}
?>
