<?php
include '../model/connect.php';

if (isset($_FILES['restoreFile']) && $_FILES['restoreFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['restoreFile']['tmp_name'];
    $fileName = $_FILES['restoreFile']['name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if ($fileExtension === 'sql') {
        $sql = explode(";", file_get_contents($fileTmpPath));
        $totalErrors = 0;

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

        if ($totalErrors === 0) {
            echo "Restauración completada con éxito";
        } else {
            echo "Ocurrieron errores durante la restauración";
        }
    } else {
        echo "El archivo debe tener extensión .sql";
    }
} else {
    echo "Error al subir el archivo";
}
