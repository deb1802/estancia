<?php
include 'db.php'; 

function obtenerAvisos() {
    global $conn; 
    $query = "SELECT titulo, mensaje FROM avisosGeneral ORDER BY fecha DESC";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // Retorna un array vacío si no hay datos
    }
}
?>
