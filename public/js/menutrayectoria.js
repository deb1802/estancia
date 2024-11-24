function navigateTo(page) {
    switch (page) {
        case 'crear':
            window.location.href = '../../view/trayectoria/crud_trayectoria.php';
            break;
        case 'veet':
            window.location.href = '../../view/trayectoria/ver_trayectoria_a.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
