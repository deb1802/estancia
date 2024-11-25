document.getElementById('mapFrame').style.display = "block";

        function mostrarEnMapa() {
            const origen = document.getElementById('origen').value;
            const destino = document.getElementById('destino').value;

            // si el origen es "upemor" o "Universidad Politécnica del Estado de Morelos"
            let location = origen.toLowerCase() === "upemor" || origen.toLowerCase() === "universidad politécnica del estado de morelos" ? destino : origen;
            
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
        