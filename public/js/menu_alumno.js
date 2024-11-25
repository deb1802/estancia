function navigateTo(page) {
    switch (page) {
        case 'trayectorias':
            window.location.href = '../../view/trayectoria/ver_trayectorias.php';
            break;
        case 'solicitudes':
            window.location.href = '../../view/solicitudes/ver_solicitudes_a.php';
            break;
        case 'perfiles':
            window.location.href = '../../view/perfil/perfiles.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
