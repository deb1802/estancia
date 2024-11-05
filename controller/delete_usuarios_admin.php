<?php
include "../model/db.php"; // Asegúrate de incluir la conexión a la base de datos
include "../model/delete_usuario.php"; // Incluir el modelo para la eliminación de usuarios

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el ID del usuario desde la URL

    // Llamar a la función para eliminar el usuario
    $execute = eliminarUsuario($conn, $id);

    // Verificar si la eliminación fue exitosa
    if (!$execute) {
        die("Eliminación falló: " . mysqli_error($conn)); // Mostrar error si la eliminación falla
    }

    // Redirigir a la página de gestión de usuarios
    header("Location: ../view/usuarios/crud_usuarios.php");
    exit;
} else {
    echo "ID de usuario no especificado."; // Mensaje si no se proporciona el ID
}

include 'includes/footer.php'; // Incluir el pie de página si es necesario
?>
