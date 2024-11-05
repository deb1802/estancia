<?php  
include "../model/db.php"; 
include "../model/insert_usuario.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $user = $_POST['usuario'];
    $pass = $_POST['contrasena'];

    $execute = insertarUsuario($conn, $nombre, $apellidos, $correo, $user, $pass);

    if ($execute) {
        echo '<p class="parrafo">Registro exitoso. Serás redirigido al inicio de sesión en unos segundos.</p>';
        
        // etiqueta para que después de 3 segs, redirija al usuario al login
        echo '<meta http-equiv="refresh" content="3;url=../view/login.php">';
        
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conn);
    }
}
?>
