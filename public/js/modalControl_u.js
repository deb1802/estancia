let deleteUrl = '';

function openModalu(url) {
    deleteUrl = url; // Almacenar la URL de eliminación
    document.getElementById("confirmModal").style.display = "block";
}

function closeModal() {
    document.getElementById("confirmModal").style.display = "none";
    deleteUrl = ''; 
}

function confirmDelete() {
    if (deleteUrl) {
        window.location.href = deleteUrl; // Redirige a la URL de eliminación
    }
    closeModal();
}
