<?php
function login($conn, $user, $password) {
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $sql = "SELECT id, usuario, nombre, tipo, contrasena FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "s", $user);

    // Ejecutar la consulta
    if (!mysqli_stmt_execute($stmt)) {
        return null;
    }

    $result = mysqli_stmt_get_result($stmt);

    // Comprobar si se encontró el usuario
    if ($row = mysqli_fetch_assoc($result)) {
        // Verificar la contraseña
        if ($password === $row['contrasena']) { 
            return $row; 
        }
    }

    mysqli_stmt_close($stmt);
    return null; // Retornar null si no hay coincidencia
}
?>
