// Inicializar el mapa centrado en una ubicación predeterminada
const map = L.map('map').setView([18.9218, -99.2216], 13);

// Agregar el mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Iconos personalizados para origen y destino
const origenIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

const destinoIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

// Variables para almacenar los marcadores
let markerOrigen = null;
let markerDestino = null;

// Función para buscar y marcar en el mapa
async function buscarUbicacion(direccion, tipo) {
    const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}`);
    const data = await response.json();

    if (data && data.length > 0) {
        const { lat, lon } = data[0];
        const coordenadas = [lat, lon];
        
        // Colocar marcador en el mapa con íconos personalizados
        if (tipo === 'origen') {
            if (markerOrigen) map.removeLayer(markerOrigen);
            markerOrigen = L.marker(coordenadas, { icon: origenIcon })
                .addTo(map)
                .bindPopup("Origen")
                .openPopup();
        } else if (tipo === 'destino') {
            if (markerDestino) map.removeLayer(markerDestino);
            markerDestino = L.marker(coordenadas, { icon: destinoIcon })
                .addTo(map)
                .bindPopup("Destino")
                .openPopup();
        }
        
        // Centrar el mapa en la ubicación
        map.setView(coordenadas, 13);
    } else {
        alert("No se encontró la dirección. Intenta con otra.");
    }
}

// Event listeners para los botones de búsqueda
document.getElementById('btn-origen').addEventListener('click', () => {
    const direccionOrigen = document.getElementById('origen').value;
    buscarUbicacion(direccionOrigen, 'origen');
});

document.getElementById('btn-destino').addEventListener('click', () => {
    const direccionDestino = document.getElementById('destino').value;
    buscarUbicacion(direccionDestino, 'destino');
});
