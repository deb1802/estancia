let deleteUrl = '';

function openModal(url) {
    deleteUrl = url; // Almacenar la URL de eliminación
    document.getElementById("confirmModal").style.display = "block";
}

function closeModal() {
    document.getElementById("confirmModal").style.display = "none";
    deleteUrl = ''; 
}

function confirmDelete() {
    if (deleteUrl) {
        window.location.href = deleteUrl;
    }
    closeModal();
}
