function validacionDisponibilidad() {
    var dia = document.frmDisponibilidad.dia.value.trim();
    var horaInicio = document.frmDisponibilidad.horaInicio.value.trim();
    var horaFin = document.frmDisponibilidad.horaFin.value.trim();

    var isValid = true;

    // Validación del campo día
    if (dia === "") {
        document.getElementById("errorDia").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorDia").style.display = "none";
    }

    // Validación del campo hora de inicio
    if (horaInicio === "") {
        document.getElementById("errorHoraInicio").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorHoraInicio").style.display = "none";
    }

    // Validación del campo hora de fin y comparación con hora de inicio
    if (horaFin === "") {
        document.getElementById("errorHoraFin").style.display = "block";
        isValid = false;
    } else if (horaInicio !== "" && horaFin <= horaInicio) {
        document.getElementById("errorHoraFin").innerText = "La hora de fin debe ser mayor que la hora de inicio.";
        document.getElementById("errorHoraFin").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorHoraFin").style.display = "none";
    }

    // Mostrar mensaje de envío solo si todos los campos son válidos
    if (isValid) {
        document.getElementById("btn").style.display = "block";
        document.querySelector(".form_btn").style.display = "none";
    }

    return isValid; // Retorna true solo si todos los campos son válidos
}
