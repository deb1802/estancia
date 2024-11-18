<?php
include $_SERVER['DOCUMENT_ROOT'] . '/estancia/model/db.php'; 
// verificarCorreo.php
if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];

    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para verificar si el correo ya está registrado
    $sql = "SELECT COUNT(*) FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    
    // Si el correo ya existe, se responde con 'existe'
    if ($count > 0) {
        echo "existe";
    } else {
        echo "disponible";
    }

    $stmt->close();
    $conexion->close();
}
?>
