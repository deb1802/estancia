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
        echo '<p class="parrafo">Registro exitoso.</p>';
        
        // 
        echo '<meta http-equiv="refresh" content="2;url=../view/usuarios/crud_usuarios.php">';
        
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conn);
    }
}
?>
