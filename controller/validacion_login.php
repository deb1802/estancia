<?php
session_start(); 

include "../model/db.php"; 
include "../model/login_sql.php";

// Limpiar cualquier error previo
unset($_SESSION['error']);

if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
    $user = trim($_POST["usuario"]); // Eliminar espacios
    $password = trim($_POST["contrasena"]);

    // Llamar a la función para autenticar
    $row = login($conn, $user, $password);

    if ($row) {
        // Almacenar datos en la sesión
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["tipo"] = $row["tipo"];
        $_SESSION["id_conductor"] = $row["id"];
        $_SESSION["nombre"] = $row["nombre"];
        
        // Redirigir según el tipo de usuario
        switch ($row["tipo"]) {
            case 'alumno':
                $_SESSION["idAlumno"] = $row["id"];
                header("Location: ../view/alumno/menu_alumno.php");
                exit();
            case 'conductor':
                header("Location: ../view/conductor/menu_conductor.php");
                exit();
            case 'administrador':
                header("Location: ../view/admin/menuadmin.php");
                exit();
            default:
                $_SESSION['error'] = "Tipo de usuario desconocido.";
                header("Location: ../view/login.php");
                exit();
        }
    } else {
        // Credenciales incorrectas
        $_SESSION['error'] = "Credenciales incorrectas. Por favor, verifica tu usuario y contraseña.";
        header("Location: ../view/login.php");
        exit();
    }
} else {
    // Si no se envió el formulario
    $_SESSION['error'] = "Por favor, complete los campos.";
    header("Location: ../view/login.php");
    exit();
}
