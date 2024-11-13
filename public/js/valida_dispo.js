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
    } else if (horaInicio !== "") {
        // Convertir las horas de formato 12h (AM/PM) a minutos totales
        var inicioMinutos = convertToMinutes(horaInicio);
        var finMinutos = convertToMinutes(horaFin);

        // Comparar si la hora de fin es mayor que la hora de inicio
        if (finMinutos <= inicioMinutos) {
            document.getElementById("errorHoraFin").innerText = "La hora de fin debe ser mayor que la hora de inicio.";
            document.getElementById("errorHoraFin").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("errorHoraFin").style.display = "none";
        }
    }

    // Mostrar mensaje de envío solo si todos los campos son válidos
    if (isValid) {
        document.getElementById("btn").style.display = "block";
        document.querySelector(".form_btn").style.display = "none";
    }

    return isValid; // Retorna true solo si todos los campos son válidos
}

// Función para convertir una hora en formato de 12 horas (AM/PM) a minutos totales desde medianoche
function convertToMinutes(hour12) {
    var parts = hour12.split(" ");
    var timeParts = parts[0].split(":");
    var hour = parseInt(timeParts[0]);
    var minute = parseInt(timeParts[1]);
    var period = parts[1]; // "AM" o "PM"

    // Convertir AM/PM a formato de 24 horas
    if (period === "AM" && hour === 12) {
        hour = 0; // 12 AM es medianoche
    }
    if (period === "PM" && hour !== 12) {
        hour += 12; // Convierte PM a formato de 24 horas
    }

    // Convertir la hora a minutos totales desde medianoche
    return hour * 60 + minute;
}
