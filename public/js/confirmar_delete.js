function confirmarEliminacion(url) {
    if (confirm("¿Estás seguro de que deseas eliminar este vehículo? Esta acción no se puede deshacer.")) {
        window.location.href = url;
    }
}
