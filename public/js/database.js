function navigateTo(page) {
    switch (page) {
        case 'respaldar':
            window.location.href = '../../controller/backup.php';
            break;
        case 'restaurar':
            window.location.href = '';
            break;
        default:
            console.error("Página desconocida");
    }
}
