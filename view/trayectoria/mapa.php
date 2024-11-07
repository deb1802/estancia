<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Origen y Destino</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="../../public/css/mapa.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Selecciona Origen y Destino</h2>
        <div class="mb-3">
            <label for="origen" class="form-label">Dirección de Origen</label>
            <input type="text" id="origen" class="form-control" placeholder="Ingresa la dirección de origen">
            <button id="btn-origen" class="btn btn-primary mt-2">Buscar Origen</button>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Dirección de Destino</label>
            <input type="text" id="destino" class="form-control" placeholder="Ingresa la dirección de destino">
            <button id="btn-destino" class="btn btn-secondary mt-2">Buscar Destino</button>
        </div>
        <div id="map" class="map-container"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="../../public/js/mapa.js"></script>
</body>
</html>
