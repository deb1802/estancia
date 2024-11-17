document.getElementById('mapFrame').style.display = "block";

function mostrarEnMapa() {
    const origen = document.getElementById('origen').value;
    const destino = document.getElementById('destino').value;

    // Validación: Asegurarse de que ambos campos no estén vacíos
    if (origen.trim() === "" || destino.trim() === "") {
        alert("Por favor, ingresa tanto un origen como un destino.");
        return;
    }

    // Validación: Asegurarse de que el origen y el destino no sean iguales
    if (origen.toLowerCase() === destino.toLowerCase()) {
        alert("El origen y el destino no pueden ser el mismo.");
        return;
    }
    const apiKey = "AIzaSyBr1kk7jLRVoLpjy-uvr1-JhvP304A5Q5I"; 
    const mapUrl = `https://www.google.com/maps/embed/v1/directions?key=${apiKey}&origin=${encodeURIComponent(origen)}&destination=${encodeURIComponent(destino)}`;
    
    // Actualizar el iframe del mapa con la nueva URL
    const mapFrame = document.getElementById('mapFrame');
    mapFrame.src = mapUrl;
}
