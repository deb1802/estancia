<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Avisos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        
        .aviso-card {
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .aviso-card:hover {
            transform: scale(1.02);
        }
        .aviso-title {
            color: #4A90E2;
            font-weight: bold;
        }
        .aviso-body {
            font-size: 16px;
            color: #5a5a5a;
        }
        .refresh-btn {
            background-color: #4A90E2;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }
        .refresh-btn:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Tus Avisos</h2>
        <button class="refresh-btn mb-3" onclick="cargarAvisos()">Actualizar Avisos</button>
        <div class="row" id="avisos-container">
            <!-- Aquí se mostrarán las tarjetas de avisos -->
        </div>
    </div>

    <script>
        // Función para cargar los avisos desde el servidor
        function cargarAvisos() {
            fetch('../../model/avisos.php')  // Ruta del archivo PHP que maneja la consulta
                .then(response => response.json())
                .then(data => {
                    const avisosContainer = document.getElementById('avisos-container');
                    avisosContainer.innerHTML = '';

                    // Verificar si hay avisos
                    if (data.length > 0) {
                        // Crear una tarjeta por cada aviso
                        data.forEach(aviso => {
                            const avisoCard = document.createElement('div');
                            avisoCard.classList.add('col-md-6');
                            avisoCard.innerHTML = `
                                <div class="card aviso-card">
                                    <div class="card-body">
                                        <h5 class="aviso-title">${aviso.titulo}</h5>
                                        <p class="aviso-body">${aviso.mensaje}</p>
                                    </div>
                                </div>
                            `;
                            avisosContainer.appendChild(avisoCard);
                        });
                    } else {
                        avisosContainer.innerHTML = '<p class="text-center">No tienes avisos en este momento.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error al cargar los avisos:', error);
                    alert('Hubo un problema al cargar los avisos.');
                });
        }

        // Cargar los avisos al cargar la página
        document.addEventListener('DOMContentLoaded', cargarAvisos);
    </script>
</body>
</html>
