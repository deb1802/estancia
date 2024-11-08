// Inicializar el mapa centrado en una ubicación predeterminada
const map = L.map('map').setView([18.9218, -99.2216], 13);

// Agregar el mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Iconos personalizados
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

let markerOrigen = null;
let markerDestino = null;

const mapboxToken = 'pk.eyJ1IjoiZGViYTE4MDIiLCJhIjoiY20zN21xcDZsMGljaTJqcHM4bzQ5OGp3aSJ9.eUtcIoaeQZBBruJJs6sV0w';

// Función para buscar y mostrar sugerencias
async function buscarSugerencias(query, tipo) {
    try {
        const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(query)}.json?access_token=${mapboxToken}`);
        if (!response.ok) throw new Error(`Error en la solicitud: ${response.status}`);
        
        const data = await response.json();
        console.log("Sugerencias recibidas:", data);

        const suggestionsElement = document.getElementById(`${tipo}-suggestions`);
        suggestionsElement.innerHTML = '';
        
        if (data.features.length === 0) {
            const noResultsItem = document.createElement('li');
            noResultsItem.textContent = "No se encontraron resultados";
            noResultsItem.classList.add('list-group-item');
            suggestionsElement.appendChild(noResultsItem);
        } else {
            data.features.forEach(feature => {
                const listItem = document.createElement('li');
                listItem.textContent = feature.place_name;
                listItem.classList.add('list-group-item');
                
                listItem.addEventListener('click', () => {
                    colocarMarcador(feature.geometry.coordinates, tipo);
                    suggestionsElement.innerHTML = '';
                    document.getElementById(tipo).value = feature.place_name;
                    document.getElementById(`${tipo}_seleccionado`).value = feature.place_name; // Actualizar campo oculto
                });
                
                suggestionsElement.appendChild(listItem);
            });
        }
    } catch (error) {
        console.error("Error al obtener sugerencias:", error);
    }
}

// Función para colocar marcador en el mapa
function colocarMarcador(coordenadas, tipo) {
    const [lon, lat] = coordenadas;
    const marker = L.marker([lat, lon], { icon: tipo === 'origen' ? origenIcon : destinoIcon })
        .addTo(map)
        .bindPopup(tipo.charAt(0).toUpperCase() + tipo.slice(1))
        .openPopup();
    
    if (tipo === 'origen') {
        if (markerOrigen) map.removeLayer(markerOrigen);
        markerOrigen = marker;
    } else if (tipo === 'destino') {
        if (markerDestino) map.removeLayer(markerDestino);
        markerDestino = marker;
    }
    
    map.setView([lat, lon], 13);
}

// Event listeners para campos de entrada
document.getElementById('origen').addEventListener('input', (event) => {
    if (event.target.value.trim() === "") {
        document.getElementById('origen-suggestions').innerHTML = '';
    }
    buscarSugerencias(event.target.value, 'origen');
});

document.getElementById('destino').addEventListener('input', (event) => {
    if (event.target.value.trim() === "") {
        document.getElementById('destino-suggestions').innerHTML = '';
    }
    buscarSugerencias(event.target.value, 'destino');
});
