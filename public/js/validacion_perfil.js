// Función para validar todos los campos del formulario
function validarFormulario(event) {
    // Prevenir el envío del formulario si hay algún error
    event.preventDefault();

    // Obtener los valores de los campos
    const nombre = document.getElementById('nombre').value;
    const matricula = document.getElementById('matricula').value;
    const telefono = document.getElementById('cel').value;
    const informacion = document.getElementById('info').value;

    // Validaciones
    const nombreValido = validarNombre(nombre);
    const matriculaValida = validarMatricula(matricula);
    const telefonoValido = validarTelefono(telefono);
    const informacionValida = validarInformacion(informacion);

    // Si todas las validaciones son correctas, enviar el formulario
    if (nombreValido && matriculaValida && telefonoValido && informacionValida) {
        document.getElementById('perfilForm').submit();
    }
}

// Función para validar el nombre de usuario
function validarNombre(nombre) {
    const errorvacioNombre = document.getElementById('errorvacioNombre');
    const errorNombre = document.getElementById('errorNombre');
    
    if (nombre === '') {
        errorvacioNombre.style.display = 'block';
        errorNombre.style.display = 'none';
        return false;
    } else if (nombre.length < 3 || nombre.length > 18) {
        errorNombre.style.display = 'block';
        errorvacioNombre.style.display = 'none';
        return false;
    }
    
    errorvacioNombre.style.display = 'none';
    errorNombre.style.display = 'none';
    return true;
}

// Función para validar la matrícula
function validarMatricula(matricula) {
    const errorMatricula = document.getElementById('errorMatricula');
    const matriculaRegex = /^[A-Za-z0-9]{10}$/;  // 10 caracteres alfanuméricos

    if (!matriculaRegex.test(matricula)) {
        errorMatricula.style.display = 'block';
        return false;
    }

    errorMatricula.style.display = 'none';
    return true;
}

// Función para validar el teléfono móvil
function validarTelefono(telefono) {
    const errorTel = document.getElementById('errorTel');
    const telefonoRegex = /^\d{10}$/; // 10 dígitos numéricos

    if (!telefonoRegex.test(telefono)) {
        errorTel.style.display = 'block';
        return false;
    }

    errorTel.style.display = 'none';
    return true;
}

// Función para validar la información adicional
function validarInformacion(informacion) {
    const errorInfo = document.getElementById('errorInfo');
    
    if (informacion === '') {
        errorInfo.style.display = 'block';
        return false;
    } else if (/malas palabras/.test(informacion.toLowerCase())) {
        errorInfo.style.display = 'block';
        return false;
    }

    errorInfo.style.display = 'none';
    return true;
}
