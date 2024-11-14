<?php include '../../controller/mostrar_vehiculo_trayectoria.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/create_trayectoria.css">
    <title>Registrar Trayectoria</title>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Formulario para ingresar la trayectoria -->
        <form id="trayectoriaForm" action="../../controller/alta_trayectoria.php" method="POST">
            <h1>Registrar una nueva trayectoria</h1>

            <!-- Campo de selección de vehículo en lugar de input -->
            <div class="mb-3">
                <label for="idVehiculo" class="form-label mt-3">Selecciona el Vehículo</label>
                <select name="idVehiculo" id="idVehiculo" class="form-control" required>
                    <option value="">Selecciona un vehículo</option>
                    <?php
                    foreach ($vehiculos as $vehiculo) {
                        echo "<option value='" . $vehiculo['id'] . "'>" . $vehiculo['marca'] . " - " . $vehiculo['modelo'] . " (" . $vehiculo['anio'] . ")</option>";
                    }
                    ?>
                </select>
            </div>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" required><br>

            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" required placeholder="Ingresa el origen (ej. upemor o Universidad Politécnica del Estado de Morelos)"><br>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required placeholder="Ingresa el destino"><br>
            <p><strong>Nota:</strong> Si el origen o el destino es la universidad, por favor ingrese "upemor" o "Universidad Politécnica del Estado de Morelos" en lugar de usar abreviaturas o formas alternativas.</p>

            <label for="referencias">Referencias:</label>
            <input type="text" id="referencias" name="referencias"><br>

            <label for="pago">Método de Pago:</label>
            <select id="pago" name="pago" required>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
            </select><br><br>

            <button type="button" onclick="mostrarEnMapa()">Mostrar en el Mapa</button>
            <button type="submit">Guardar Trayectoria</button>
        </form>

        <!-- Mapa -->
        <iframe
            id="mapFrame"
            width="600"
            height="450"
            style="border:0"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="">
        </iframe>
    </div>

    <script>
        // Mostrar el mapa de inmediato al cargar
        document.getElementById('mapFrame').style.display = "block";

        function mostrarEnMapa() {
            // Obtiene los valores de origen y destino
            const origen = document.getElementById('origen').value;
            const destino = document.getElementById('destino').value;

            // Verifica si el origen es "upemor" o "Universidad Politécnica del Estado de Morelos"
            let location = origen.toLowerCase() === "upemor" || origen.toLowerCase() === "universidad politécnica del estado de morelos" ? destino : origen;
            
            // Valida que origen y destino no sean iguales
            if (origen.trim() === "" || destino.trim() === "") {
                alert("Por favor, ingresa tanto un origen como un destino.");
                return;
            }
            
            if (origen.toLowerCase() === destino.toLowerCase()) {
                alert("El origen y el destino no pueden ser el mismo.");
                return;
            }

            // Genera la URL para mostrar en el mapa
            const apiKey = "AIzaSyBr1kk7jLRVoLpjy-uvr1-JhvP304A5Q5I"; // Reemplaza con tu clave de API
            const mapUrl = `https://www.google.com/maps/embed/v1/place?key=${apiKey}&q=${encodeURIComponent(location)}`;
            
            // Actualiza el iframe del mapa
            const mapFrame = document.getElementById('mapFrame');
            mapFrame.src = mapUrl;
        }
    </script>
</body>
</html>
