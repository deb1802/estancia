function validacionLogin() {
    var usuario = document.frm.usuario.value.trim();
    var contrasena = document.frm.contrasena.value.trim();

    var isValid = true;

    // Validación del campo usuario
    if (usuario.length === 0) {
        document.getElementById("errorUsuario").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorUsuario").style.display = "none";
    }

    // Validación del campo contraseña
    if (contrasena.length === 0) {
        document.getElementById("errorContrasena").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorContrasena").style.display = "none";
    }

    if (isValid) {
        document.getElementById("btn").style.display = "block";
        document.querySelector(".form_btn").style.display = "none";
        return true; // Permitir que el formulario se envíe
    }

    return false; // Bloquear el envío del formulario
}
