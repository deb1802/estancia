function validacionTrayectoria() {
    var expreTexto = /^[a-zA-Z0-9À-ÿ\s]{1,100}$/; // Origen, destino y referencias (alphanumeric y acentos)
    var expreCapacidad = /^[1-9][0-9]*$/; // Capacidad (número positivo mayor que 0)
    
    // Obtener los valores de los campos
    var idVehiculo = document.getElementById("idVehiculo").value.trim();
    var capacidad = document.getElementById("capacidad").value.trim();
    var origen = document.getElementById("origen").value.trim();
    var destino = document.getElementById("destino").value.trim();
    var referencias = document.getElementById("referencias").value.trim();
    var pago = document.getElementById("pago").value.trim();

    var isValid = true;

    // Resetear los mensajes de error antes de cada validación
    document.getElementById("errorVehiculo").style.display = "none";
    document.getElementById("errorCapacidad").style.display = "none";
    document.getElementById("errorOrigen").style.display = "none";
    document.getElementById("errorDestino").style.display = "none";
    document.getElementById("errorReferencias").style.display = "none";
    document.getElementById("errorPago").style.display = "none";

    // Validación del campo vehículo
    if (idVehiculo === "") {
        document.getElementById("errorVehiculo").style.display = "block";
        isValid = false;
    }

    // Validación del campo capacidad
    if (!capacidad || !expreCapacidad.test(capacidad)) {
        document.getElementById("errorCapacidad").style.display = "block";
        isValid = false;
    }

    // Validación del campo origen
    if (!origen || !expreTexto.test(origen)) {
        document.getElementById("errorOrigen").style.display = "block";
        isValid = false;
    }

    // Validación del campo destino
    if (!destino || !expreTexto.test(destino)) {
        document.getElementById("errorDestino").style.display = "block";
        isValid = false;
    }

    // Validación de que origen no sea igual a destino
    if (origen.toLowerCase() === destino.toLowerCase()) {
        //document.getElementById("errorOrigen").textContent = "El origen no puede ser igual al destino.";
        document.getElementById("errorOrigen").style.display = "block";
        isValid = false;
    }

    // Validación del campo referencias (opcional)
    if (referencias && !expreTexto.test(referencias)) {
        document.getElementById("errorReferencias").style.display = "block";
        document.getElementById("errorPago").textContent = "Las referencias son opcionales pero ingresa un texto válido.";
        isValid = false;
    }

    // Validación del método de pago
    if (pago === "") {
        document.getElementById("errorPago").style.display = "block";
        isValid = false;
        document.getElementById("errorPago").textContent = "Elige un método de pago de la lista.";
    }

    return isValid; // Si todo es válido, permite el envío del formulario
}

// Asignar la función de validación al formulario
document.getElementById("trayectoriaForm").onsubmit = function(event) {
    if (!validacionTrayectoria()) {
        event.preventDefault(); // Previene el envío si hay errores
    }
};
