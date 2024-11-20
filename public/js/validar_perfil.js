function validarFormulario(event) {
    // Prevenir el envío del formulario si hay errores
    let valido = true;

    // Obtener los valores de los campos
    const nombre = document.getElementById('nombre').value.trim();
    const matricula = document.getElementById('matricula').value.trim();
    const telefono = document.getElementById('cel').value.trim();
    const informacion = document.getElementById('info').value.trim();

    // Limpiar mensajes de error previos
    document.querySelectorAll('.alert').forEach(alert => alert.style.display = 'none');

    // Validar el campo de nombre
    if (!nombre) {
        document.getElementById('errorvacioNombre').style.display = 'block';
        valido = false;
    } else if (nombre.length < 3 || nombre.length > 18) {
        document.getElementById('errorNombre').style.display = 'block';
        valido = false;
    }

    // Validar el campo de matrícula
    if (!matricula) {
        document.getElementById('errorMatricula').style.display = 'block';
        valido = false;
    } else if (!/^[a-zA-Z0-9]{10}$/.test(matricula)) {
        document.getElementById('errorMatricula').style.display = 'block';
        valido = false;
    }

    // Validar el campo de teléfono móvil
    if (!telefono) {
        document.getElementById('errorTel').style.display = 'block';
        valido = false;
    } else if (!/^\d{10}$/.test(telefono)) {
        document.getElementById('errorTel').style.display = 'block';
        valido = false;
    }

    // Validar el campo de información adicional
    if (!informacion) {
        document.getElementById('errorInfo').style.display = 'block';
        valido = false;
    }

    // Si hay errores, evitar el envío del formulario
    if (!valido) {
        event.preventDefault();
    }

    return valido; // Retorna true si es válido
}
