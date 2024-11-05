// Validar año del vehículo
function validateYear(event) {
    const yearInput = event.target;
    const yearValue = yearInput.value;

    // Verificar si la entrada no es un número o está vacía
    if (isNaN(yearValue) || yearValue.trim() === "") {
        // Cambiar el color del borde para indicar un error
        yearInput.style.borderColor = "red";

        // Opcional: Añadir un mensaje de error debajo del campo de entrada
        if (!yearInput.nextElementSibling || !yearInput.nextElementSibling.classList.contains('error-message')) {
            const errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            errorMessage.style.color = 'red';
            errorMessage.textContent = "Por favor, ingrese un año válido (números solamente).";
            yearInput.parentNode.insertBefore(errorMessage, yearInput.nextSibling);
        }
    } else {
        // Si es válido, restablecer el color del borde y eliminar el mensaje de error
        yearInput.style.borderColor = "";
        const errorMessage = yearInput.nextElementSibling;
        if (errorMessage && errorMessage.classList.contains('error-message')) {
            errorMessage.remove();
        }
    }
}
