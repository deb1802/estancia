<?php
include "../controller/mostrar_vehiculos_a.php"; // Asegúrate de que este controlador obtenga los datos correctamente
include "db.php";

if (isset($_GET['id'])) {
    $idTrayectoria = $_GET['id'];
    $sql = "SELECT * FROM trayectorias2 WHERE id = $idTrayectoria";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $origen = $row['origen'];
        $destino = $row['destino'];
        $capacidad = $row['capacidad'];
        $referencias = $row['referencias'];
        $pago = $row['pago'];
        $idVehiculo = $row['idVehiculo'];
        $idConductor = $row['idConductor']; 
    } else {
        echo "No existen registros para esa trayectoria.";
    }
}

if (isset($_POST['actualizar'])) {
    $idTrayectoria = $_GET['id'];
    $idVehiculo = $_POST['idVehiculo'];
    $idConductor = $_POST['idConductor'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $capacidad = $_POST['capacidad'];
    $referencias = $_POST['referencias'];
    $pago = $_POST['pago'];

    $updateQuery = "UPDATE trayectorias2 SET 
                    idVehiculo = '$idVehiculo', 
                    idConductor = '$idConductor',
                    origen = '$origen', 
                    destino = '$destino', 
                    capacidad = '$capacidad', 
                    referencias = '$referencias', 
                    pago = '$pago' 
                    WHERE id = $idTrayectoria";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../../../../estancia/view/trayectoria/ver_trayectoria_a.php");
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/create_trayectoria.css">
    <title>Actualizar Trayectoria</title>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <form id="trayectoriaForm" action="update_trayectoria_a.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <h1>Actualizar Trayectoria</h1>

            <!-- Selección de Vehículo -->
            <div class="mb-3">
                <label for="idVehiculo" class="form-label mt-3">Selecciona el Vehículo</label>
                <select name="idVehiculo" id="idVehiculo" class="form-control">
                    <option value="">Selecciona un vehículo</option>
                    <?php
                    foreach ($vehiculos as $vehiculo) {
                        echo "<option value='" . $vehiculo['id'] . "' " . ($vehiculo['id'] == $idVehiculo ? 'selected' : '') . ">" . $vehiculo['marca'] . " - " . $vehiculo['modelo'] . " (" . $vehiculo['anio'] . ") - ID del conductor: " . $vehiculo['idConductor'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Selección de Conductor -->
            <div class="mb-3">
                <label for="idConductor" class="form-label mt-3">Selecciona el Conductor</label>
                <select name="idConductor" id="idConductor" class="form-control">
                    <option value="">Selecciona un conductor</option>
                    <?php
                    foreach ($conductores as $conductor) {
                        echo "<option value='" . $conductor['id'] . "' " . ($conductor['id'] == $idConductor ? 'selected' : '') . ">" . $conductor['nombre'] . " (ID: " . $conductor['id'] . ")</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campo de Capacidad -->
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" id="capacidad" name="capacidad" class="form-control" value="<?php echo $capacidad; ?>" required>
            </div>

            <!-- Campo de Origen -->
            <div class="mb-3">
                <label for="origen" class="form-label">Origen</label>
                <input type="text" id="origen" name="origen" class="form-control" value="<?php echo $origen; ?>" required>
            </div>

            <!-- Campo de Destino -->
            <div class="mb-3">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" id="destino" name="destino" class="form-control" value="<?php echo $destino; ?>" required>
            </div>

            <!-- Campo de Referencias -->
            <div class="mb-3">
                <label for="referencias" class="form-label">Referencias</label>
                <input type="text" id="referencias" name="referencias" class="form-control" value="<?php echo $referencias; ?>">
            </div>

            <!-- Selección de Método de Pago -->
            <div class="mb-3">
                <label for="pago" class="form-label">Método de Pago</label>
                <select id="pago" name="pago" class="form-control" required>
                    <option value="Efectivo" <?php echo ($pago == 'Efectivo' ? 'selected' : ''); ?>>Efectivo</option>
                    <option value="Transferencia" <?php echo ($pago == 'Transferencia' ? 'selected' : ''); ?>>Transferencia</option>
                </select>
            </div>

            <!-- Botones -->
            <button type="button" onclick="mostrarEnMapa()">Mostrar en el Mapa</button>
            <button type="submit" name="actualizar">Actualizar Trayectoria</button>
            <a class="cancelar" href="../view/trayectoria/ver_trayectoria_a.php" class="cancelar">Cancelar</a>
        </form>

        <!-- Mapa -->
        <iframe id="mapFrame" width="600" height="450" style="border:0" loading="lazy" allowfullscreen src=""></iframe>
    </div>

    <script src="../public/js/mapa_update.js"></script>
</body>
</html>
