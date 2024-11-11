<?php
session_start(); 

include "../model/db.php"; 
include "../model/login_sql.php";


if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}


if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
    $user = $_POST["usuario"];
    $password = $_POST["contrasena"];


    $row = login($conn, $user, $password);

    if ($row) {
        // En el archivo de login, al momento de autenticar al usuario
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["tipo"] = $row["tipo"];
        $_SESSION["id_conductor"] = $row["id"];
        
        // Redirigir según el tipo de usuario
        switch ($row["tipo"]) {
            case 'alumno':
                header("Location: ../view/alumno/menu_alumno.php");
                $_SESSION["idAlumno"] = $row["id"];
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
        $_SESSION['error'] = "Credenciales incorrectas. Por favor, verifica tu usuario y contraseña.";
        header("Location: ../view/login.php");
        exit();
    }
}
?>
