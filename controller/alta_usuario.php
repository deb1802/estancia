<link rel="stylesheet" href="../public/css/registro.css">
<?php  
include "../model/db.php"; 
include "../model/insert_usuario.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $user = $_POST['usuario'];
    $pass = $_POST['contrasena'];

    // Llamar a la función insertarUsuario y obtener el resultado
    $resultado = insertarUsuario($conn, $nombre, $apellidos, $correo, $user, $pass);

    // Si el registro fue exitoso
    if ($resultado === true) {
        echo '<p class="parrafo">Registro exitoso. Serás redirigido al inicio de sesión en unos segundos.</p>';
        
        // Etiqueta para redirigir al login después de 3 segundos
        echo '<meta http-equiv="refresh" content="3;url=../view/login.php">';
    } else {
        // Si el resultado es un mensaje de error (correo duplicado o error de inserción)
        echo '<p class="error-message">' . $resultado . '</p>'; 
        echo '<p class="parrafo">Serás redirigido al registro nuevamente.</p>';
        
        // Redirigir al registro después de 4 segundos si hay un error
        echo '<meta http-equiv="refresh" content="4;url=../../../../estancia/view/registro.php">';
    }
}
?>
