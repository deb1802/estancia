function validacion() {
    // Expresiones regulares para validación
    var expreMarcaModelo = /^[a-zA-Z0-9À-ÿ\s]{1,40}$/; // Marca y modelo
    var exprePlacas = /^[A-Z0-9]{1,10}$/; // Placas
    var expreColor = /^[a-zA-ZÀ-ÿ\s]{1,30}$/; // Color

    var marca = document.frm.marca.value.trim();
    var modelo = document.frm.modelo.value.trim();
    var anio = document.frm.anio.value.trim();
    var placas = document.frm.placas.value.trim();
    var color = document.frm.color.value.trim();

    var isValid = true;

    // Validación del campo marca
    if (!marca || !expreMarcaModelo.test(marca)) {
        document.getElementById("errorMarca").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorMarca").style.display = "none";
    }

    // Validación del campo modelo
    if (!modelo || !expreMarcaModelo.test(modelo)) {
        document.getElementById("errorModelo").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorModelo").style.display = "none";
    }

    // Validación del campo año
    if (!anio || anio < 1950 || anio > 2025) {
        document.getElementById("errorAnio").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorAnio").style.display = "none";
    }

    // Validación del campo placas
    if (!placas || !exprePlacas.test(placas)) {
        document.getElementById("errorPlacas").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorPlacas").style.display = "none";
    }

    // Validación del campo color
    if (!color || !expreColor.test(color)) {
        document.getElementById("errorColor").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorColor").style.display = "none";
    }

    // Si todo es válido, ocultar el botón de envío
    if (isValid) {
        document.getElementById("btn").style.display = "block"; // Muestra el mensaje de envío
        return true; // Permitir el envío del formulario
    }

    return false; // Bloquear el envío del formulario
}
