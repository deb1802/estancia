function validacion() {
    var expreNomyApe = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
    var expreUsuario = /^[a-zA-Z0-9_]{4,20}$/;
    var expreEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

    var nombre = document.frm.nombre.value.trim();
    var apellido = document.frm.apellido.value.trim();
    var correo = document.frm.correo.value.trim();
    var usuario = document.frm.usuario.value.trim();
    var contrasena = document.frm.contrasena.value.trim();

    var isValid = true;

    // Validación del campo nombre
    if (nombre.length <= 2 || !expreNomyApe.test(nombre)) {
        document.getElementById("errorNombre").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorNombre").style.display = "none";
    }

    // Validación del campo apellido
    if (apellido.length <= 2 || !expreNomyApe.test(apellido)) {
        document.getElementById("errorApellido").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorApellido").style.display = "none";
    }

    // Validación del campo correo
    if (!expreEmail.test(correo)) {
        document.getElementById("errorCorreo").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorCorreo").style.display = "none";
    }

    // Validación del campo usuario
    if (usuario.length < 4 || !expreUsuario.test(usuario)) {
        document.getElementById("errorUsuario").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("errorUsuario").style.display = "none";
    }

    // Validación del campo contraseña
    if (contrasena.length < 6) {
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
