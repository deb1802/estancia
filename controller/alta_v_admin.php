<?php 
session_start();

include "../model/db.php"; 
include "../model/insert_vehiculo.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idconductor = $_POST['idconductor'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $pla = $_POST['placas'];
    $color = $_POST['color'];

    // Verificar que los campos no estén vacíos
    if (!empty($idconductor) && !empty($marca) && !empty($modelo) && !empty($anio) && !empty($pla) && !empty($color)) {
        
        // Verificar que el id del conductor exista y sea de tipo 2
        $sql = "SELECT COUNT(*) as existe FROM usuarios WHERE id = ? AND tipo = 2";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idconductor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existe);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($existe > 0) {
            // Llamar a la función para insertar el vehículo
            $execute = insertarVehiculo($conn, $idconductor, $marca, $modelo, $anio, $pla, $color);

            if ($execute) {
                echo "Registro exitoso.";
                header("Location:../view/admin/menuadmin.php");
                exit(); 
            } else {
                echo "Error al registrar el vehículo.";
            }
        } else {
            echo "El conductor no existe o no tiene el tipo correcto.";
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
