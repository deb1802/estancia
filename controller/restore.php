<?php
include '../model/connect.php';

// Verificar si se ha subido un archivo sin errores
if ($_FILES['restoreFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['restoreFile']['tmp_name']; // Ruta temporal del archivo subido
    $fileName = $_FILES['restoreFile']['name']; // Nombre original del archivo
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Obtener la extensión del archivo

    // Verificar si el archivo tiene extensión .sql
    if ($fileExtension === 'sql') {
        // Leer el contenido del archivo y dividirlo en consultas SQL
        $sql = explode(";", file_get_contents($fileTmpPath));
        $totalErrors = 0; // Contador de errores durante la restauración

        // Aumentar el tiempo de ejecución permitido
        set_time_limit(60);

        // Conectar a la base de datos
        $con = mysqli_connect(SERVER, USER, PASS, BD);
        $con->query("SET FOREIGN_KEY_CHECKS=0"); // Desactivar las comprobaciones de claves foráneas

        // Ejecutar cada consulta SQL contenida en el archivo
        foreach ($sql as $query) {
            if (trim($query) !== '') { // Asegurarse de que la consulta no esté vacía
                if (!$con->query($query . ";")) { // Si ocurre un error, incrementar el contador
                    $totalErrors++;
                }
            }
        }

        // Reactivar las comprobaciones de claves foráneas
        $con->query("SET FOREIGN_KEY_CHECKS=1");
        $con->close(); // Cerrar la conexión a la base de datos

        // Notificar el resultado de la restauración
        if ($totalErrors <= 0) {
            echo "<script>alert('Restauración completada con éxito'); window.location.href = '../view/bd/database.php';</script>";
        } else {
            echo "<script>alert('Ocurrió un error durante la restauración'); window.location.href = '../view/bd/database.php';</script>";
        }
    } else {
        echo "<script>alert('Por favor, suba un archivo con extensión .sql'); window.location.href = '../view/bd/database.php';</script>";
    }
} else {
    // Si no se cargó correctamente el archivo
    echo "<script>alert('Error al cargar el archivo. Intente nuevamente.'); window.location.href = '../view/bd/database.php';</script>";
}
?>
