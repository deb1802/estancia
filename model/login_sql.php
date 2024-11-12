<?php
session_start();

function login($conn, $user, $password) {
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    $sql = "SELECT id, usuario, nombre, tipo, contrasena FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "s", $user);

    // Ejecutar la consulta y verificar errores
    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
        return null; 
    }

    $result = mysqli_stmt_get_result($stmt);

    // Comprobar si se encontró el usuario
    if ($row = mysqli_fetch_assoc($result)) { 
        echo "Usuario encontrado: " . $row['usuario'] . "<br>";

        // Comprobar la contraseña directamente
        if ($password === $row['contrasena']) { 
            // Almacenar el nombre y usuario en la sesión
            $_SESSION['usuario'] = $row['usuario']; // Nombre de usuario
            $_SESSION['nombre'] = $row['nombre'];   // Nombre real del usuario
            return $row; 
        } else {
            echo "Contraseña incorrecta.<br>";
        }
    } else {
        echo "Usuario no encontrado.<br>";
    }

    mysqli_stmt_close($stmt);

    return null;
}
?>
