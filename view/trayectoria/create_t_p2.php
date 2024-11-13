<?php
//obtener los vehículos asociados al conductor
include_once('../../controller/mostrar_vehiculo_trayectoria.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="../../public/css/create_tra.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Registra una trayectoria</h2>
        
        <!-- Formulario de registro -->
        <form action="#" method="POST">
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
            <input type="hidden" name="lat_origen" id="lat_origen">
            <input type="hidden" name="lon_origen" id="lon_origen">
            <input type="hidden" name="lat_destino" id="lat_destino">
            <input type="hidden" name="lon_destino" id="lon_destino">
            
            <!-- Lista desplegable para vehículos -->
            <div class="mb-3">
                <label for="idVehiculo" class="form-label mt-3">Selecciona el Vehículo</label>
                <select name="idVehiculo" id="idVehiculo" class="form-control" required>
                    <option value="">Selecciona un vehículo</option>
                    <?php
                    if (isset($vehiculos) && !empty($vehiculos)) {
                        foreach ($vehiculos as $vehiculo) {
                            echo "<option value='" . $vehiculo['id'] . "'>" . $vehiculo['marca'] . " - " . $vehiculo['modelo'] . " (" . $vehiculo['anio'] . ")</option>";
                        }
                    } else {
                        echo "<option value=''>No hay vehículos disponibles</option>";
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
    <script>
    const map = L.map('map').setView([18.9218, -99.2216], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const origenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    const destinoIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    let markerOrigen = null;
    let markerDestino = null;

    const apiKey = '12f4e5575f8e49d3a4701ebcb3458c23';

    function buscarSugerencias(valor, tipo) {
        const input = document.getElementById(tipo);
        const suggestionsElement = document.getElementById(`${tipo}-suggestions`);
        suggestionsElement.innerHTML = '';

        if (!valor.trim()) return;

        const url = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(valor)}&key=${apiKey}&language=es`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                suggestionsElement.innerHTML = '';  // Limpiar sugerencias previas
                if (data.status.code === 200 && data.results.length) {
                    data.results.forEach(result => {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.textContent = result.formatted;
                        listItem.addEventListener('click', () => {
                            colocarMarcador([result.geometry.lat, result.geometry.lng], tipo);
                            input.value = result.formatted;
                            suggestionsElement.innerHTML = '';
                        });
                        suggestionsElement.appendChild(listItem);
                    });
                } else {
                    suggestionsElement.innerHTML = '<li class="list-group-item">No se encontraron resultados</li>';
                }
            })
            .catch(error => {
                console.error('Error al buscar sugerencias:', error);
            });
    }

    function colocarMarcador(coordenadas, tipo) {
        const [lat, lon] = coordenadas;
        const marker = L.marker([lat, lon], { icon: tipo === 'origen' ? origenIcon : destinoIcon })
            .addTo(map)
            .bindPopup(tipo.charAt(0).toUpperCase() + tipo.slice(1))
            .openPopup();

        if (tipo === 'origen') {
            if (markerOrigen) map.removeLayer(markerOrigen);
            markerOrigen = marker;
            document.getElementById('lat_origen').value = lat;
            document.getElementById('lon_origen').value = lon;
        } else if (tipo === 'destino') {
            if (markerDestino) map.removeLayer(markerDestino);
            markerDestino = marker;
            document.getElementById('lat_destino').value = lat;
            document.getElementById('lon_destino').value = lon;
        }

        map.setView([lat, lon], 13);
    }

    document.getElementById('origen').addEventListener('input', () => {
        buscarSugerencias(document.getElementById('origen').value, 'origen');
    });

    document.getElementById('destino').addEventListener('input', () => {
        buscarSugerencias(document.getElementById('destino').value, 'destino');
    });

    document.querySelector('form').addEventListener('submit', (event) => {
        const latOrigen = document.getElementById('lat_origen').value;
        const lonOrigen = document.getElementById('lon_origen').value;
        const latDestino = document.getElementById('lat_destino').value;
        const lonDestino = document.getElementById('lon_destino').value;

        if (!latOrigen || !lonOrigen || !latDestino || !lonDestino) {
            alert('Por favor selecciona un origen y un destino válidos');
            event.preventDefault();
        }
    });
</script>

</body>
</html>
