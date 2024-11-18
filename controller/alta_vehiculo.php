<link rel="stylesheet" href="../public/css/create_v.css">
<?php 
session_start();

include "../model/db.php"; 
include "../model/insert_vehiculo.php"; 

if (!isset($_SESSION['id_conductor'])) {
    echo "No has iniciado sesión. Por favor, inicia sesión primero.";
    exit();
}

$idconductor = $_SESSION['id_conductor']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $pla = $_POST['placas'];
    $color = $_POST['color'];

    // Verificar que los campos no estén vacíos
    if (!empty($marca) && !empty($modelo) && !empty($anio) && !empty($pla) && !empty($color)) {
        // Llamar a la función para insertar el vehículo
        $execute = insertarVehiculo($conn, $idconductor, $marca, $modelo, $anio, $pla, $color);

        if ($execute === true) {
            // Si el registro fue exitoso
            echo '<p class="parrafo">Registro exitoso. Serás redirigido al menú del conductor en unos segundos.</p>';
            echo '<meta http-equiv="refresh" content="3;url=../../../../estancia/view/conductor/menu_conductor.php">';
        } else {
            echo '<p class="error-message">' . $execute . '</p>';
            echo '<p class="parrafo">Serás redirigido al registro nuevamente.</p>';
            // Redirigir al formulario de registro después de 4 segundos si hay un error
            echo '<meta http-equiv="refresh" content="4;url=../../../../estancia/view/vehiculo/create_vehiculos.php">';
        }
    } else {

        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
mysqli_close($conn);
?>
