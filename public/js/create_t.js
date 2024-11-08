// Crear el mapa
const map = L.map('map').setView([19.4326, -99.1332], 13); // Coordenadas por defecto, puedes cambiarlas

// Añadir capa de mapa
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

// Variables para almacenar las ubicaciones seleccionadas
let origenLatLng = null;
let destinoLatLng = null;

// Función para agregar un marcador y actualizar el campo oculto
function agregarMarcador(latLng, tipo) {
    const marker = L.marker(latLng).addTo(map);

    if (tipo === 'origen') {
        origenLatLng = latLng;
        document.getElementById('origen_seleccionado').value = JSON.stringify(latLng); // Almacenar el origen en el campo oculto
    } else {
        destinoLatLng = latLng;
        document.getElementById('destino_seleccionado').value = JSON.stringify(latLng); // Almacenar el destino en el campo oculto
    }
}

// Añadir un marcador de origen al hacer clic
map.on('click', function (e) {
    if (!origenLatLng) {
        agregarMarcador(e.latlng, 'origen');
    } else if (!destinoLatLng) {
        agregarMarcador(e.latlng, 'destino');
    }
});
