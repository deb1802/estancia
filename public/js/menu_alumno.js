function navigateTo(page) {
    switch (page) {
        case 'trayectorias':
            window.location.href = '../../view/trayectoria/ver_trayectorias.php';
            break;
        case 'solicitudes':
            window.location.href = '../../view/solicitudes/ver_solicitudes_a.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
