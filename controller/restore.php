<?php
include '../model/connect.php';

if ($_FILES['restoreFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['restoreFile']['tmp_name'];
    $fileName = $_FILES['restoreFile']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileExtension === 'sql') {
        $sql = explode(";", file_get_contents($fileTmpPath));
        $totalErrors = 0;
        set_time_limit(60);
        $con = mysqli_connect(SERVER, USER, PASS, BD);
        $con->query("SET FOREIGN_KEY_CHECKS=0");

        foreach ($sql as $query) {
            if (trim($query) !== '') {
                if (!$con->query($query . ";")) {
                    $totalErrors++;
                }
            }
        }

        $con->query("SET FOREIGN_KEY_CHECKS=1");
        $con->close();

        if ($totalErrors <= 0) {
            echo "<script>alert('Restauración completada con éxito'); window.location.href = '../view/bd/database.php';</script>";
        } else {
            echo "<script>alert('Ocurrió un error durante la restauración'); window.location.href = '../view/bd/database.php';</script>";
        }
    } else {
        echo "<script>alert('Por favor, suba un archivo con extensión .sql'); window.location.href = '../view/bd/database.php';</script>";
    }
} else {
    echo "<script>alert('Error al cargar el archivo. Intente nuevamente.'); window.location.href = '../view/bd/database.php';</script>";
}
?>
