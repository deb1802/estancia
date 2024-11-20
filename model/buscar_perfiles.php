<?php
include('db.php'); 


// Verificar si se ingresó un término de búsqueda
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Consulta para obtener perfiles con o sin búsqueda
if ($searchTerm) {
    $query = "SELECT * FROM perfiles WHERE nombreUser LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT * FROM perfiles"; 
    $result = mysqli_query($conn, $query);
}

// Recuperar los registros obtenidos
$profiles = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Cerrar la conexión
mysqli_close($conn);
?>
