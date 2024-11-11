<?php
//para ver los vehículos asociados al conductor
include '../../controller/mostrar_vehiculo_trayectoria.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="../../public/css/create_tra.css>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Registra una trayectoria</h2>
        
        <!-- Formulario de registro -->
        <form action="../../controller/alta_trayectoria.php" method="POST">
            <div class="mb-3">
                <label for="origen" class="form-label">Origen</label>
                <input type="text" id="origen" class="form-control" placeholder="Ingresa el origen" required>
                <ul id="origen-suggestions" class="list-group position-absolute"></ul>
                
                <label for="destino" class="form-label mt-3">Destino</label>
                <input type="text" id="destino" class="form-control" placeholder="Ingresa el destino" required>
                <ul id="destino-suggestions" class="list-group position-absolute"></ul>
            </div>
            
            <div class="mb-3">
                <label for="referencias" class="form-label mt-3">Referencias</label>
                <textarea name="referencias" id="referencias" class="form-control" rows="3" placeholder="Añade referencias sobre la ubicación"></textarea>
            </div>

            <!-- Campos ocultos para el origen y destino seleccionados -->
            <input type="hidden" name="origen_seleccionado" id="origen_seleccionado">
            <input type="hidden" name="destino_seleccionado" id="destino_seleccionado">
            
            <!-- Lista desplegable para vehículos -->
            <div class="mb-3">
                <label for="idVehiculo" class="form-label mt-3">Selecciona el Vehículo</label>
                <select name="idVehiculo" id="idVehiculo" class="form-control" required>
                    <option value="">Selecciona un vehículo</option>
                    <?php
                    // Mostrar los vehículos asociados al conductor
                    foreach ($vehiculos as $vehiculo) {
                        echo "<option value='" . $vehiculo['id'] . "'>" . $vehiculo['marca'] . " - " . $vehiculo['modelo'] . " (" . $vehiculo['anio'] . ")</option>";
                    }
                    ?>
                </select>
            </div>
            
            <!-- Campos adicionales -->
            <div class="mb-3">
                <label for="capacidad" class="form-label mt-3">Capacidad</label>
                <input type="number" name="capacidad" id="capacidad" class="form-control" required>
                
                <label for="pago" class="form-label mt-3">Método de Pago</label>
                <select name="pago" id="pago" class="form-control" required>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Registrar Trayectoria</button>
        </form>

        <div id="map" class="map-container" style="height: 400px;"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="../../public/js/mapa_tra.js"></script>
</body>
</html>
