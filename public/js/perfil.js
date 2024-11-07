document.addEventListener("DOMContentLoaded", function () {
    const uploadFoto = document.getElementById("uploadFoto");
    const fotoPerfil = document.getElementById("fotoPerfil");

    // Evento para mostrar la imagen de perfil seleccionada
    uploadFoto.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                fotoPerfil.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Simulación de guardado
    const guardarButton = document.getElementById("guardar");
    guardarButton.addEventListener("click", function () {
        alert("Cambios guardados correctamente.");
    });
});
