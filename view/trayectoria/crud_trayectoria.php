<?php 
include '../../controller/mostrar_vehiculos_a.php';
//var_dump($conductores); 
?>
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
        <form id="trayectoriaForm" action="../../controller/alta_trayectoria_a.php" method="POST">
            <h1>Registrar una nueva trayectoria</h1>
            
            <!-- Campo ID Vehículo -->
        <div class="mb-3">
            <label for="idVehiculo" class="form-label mt-3">Selecciona el Vehículo</label>
            <select name="idVehiculo" id="idVehiculo" class="form-control">
                <option value="">Selecciona un vehículo</option>
                <?php
                foreach ($vehiculos as $vehiculo) {
                    echo "<option value='" . $vehiculo['id'] . "'>" . $vehiculo['marca'] . " - " . $vehiculo['modelo'] . " (" . $vehiculo['anio'] . ") - Id del conductor: " . $vehiculo['idConductor'] . "</option>";
                }
                ?>
            </select>
            <p class="alert alert-danger" id="errorVehiculo" style="display: none;">Selecciona un vehículo, es obligatorio.</p>
        </div>

            <!-- Campo ID Conductor -->
            <div class="mb-3">
                <label for="idConductor" class="form-label mt-3">Selecciona el Conductor</label>
                <select name="idConductor" id="idConductor" class="form-control">
                    <option value="">Selecciona un conductor</option>
                    <?php
                    // Verifica si $conductores tiene datos antes de generar las opciones
                    if (isset($conductores) && is_array($conductores) && count($conductores) > 0) {
                        foreach ($conductores as $conductor) {
                            // Depurar los datos del conductor
                            var_dump($conductor); // Esto mostrará la estructura de los datos del conductor
                            echo "<option value='" . $conductor['id'] . "'>" . $conductor['nombre'] . " (ID: " . $conductor['id'] . ")</option>";
                        }
                    } else {
                        echo "<option value=''>No hay conductores disponibles</option>";
                    }
                    ?>
                </select>
                <p class="alert alert-danger" id="errorConductor" style="display: none;">Selecciona un conductor, es obligatorio.</p>
            </div>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad"><br>
            <p class="alert alert-danger" id="errorCapacidad" style="display: none;">La capacidad debe ser un número entero positivo.</p>

            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" placeholder="Ingresa el origen (ej. upemor)"><br>
            <p class="alert alert-danger" id="errorOrigen" style="display: none;">Este campo es obligatorio y no puede ser igual al destino.</p>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" placeholder="Ingresa el destino"><br>
            <p class="alert alert-danger" id="errorDestino" style="display: none;">Este campo es obligatorio.</p>
            <p><strong>Nota:</strong> Si el origen o el destino es la universidad, por favor ingrese "upemor" o "Universidad Politécnica del Estado de Morelos" en lugar de usar abreviaturas o formas alternativas.</p>

            <label for="referencias">Referencias:</label>
            <input type="text" id="referencias" name="referencias"><br>
            <p class="alert alert-danger" id="errorReferencias" style="display: none;">Este campo es opcional, pero si lo llenas, debe ser válido.</p>

            <label for="pago">Método de Pago:</label>
            <select id="pago" name="pago">
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
            </select><br><br>
            <p class="alert alert-danger" id="errorPago" style="display: none;">Este campo es obligatorio.</p>

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
        // Asociamos la función de validación al evento submit del formulario
        document.getElementById("trayectoriaForm").onsubmit = function(event) {
            if (!validacion()) {
                event.preventDefault(); // Previene el envío si hay errores
            }
        };
    </script>

    <script src="../../public/js/mostrar_mapa.js"> </script>
    <script src="../../public/js/validacion_trayectoria.js"> </script>
</body>
</html>
