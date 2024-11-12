function navigateTo(page) {
    switch (page) {
        case 'usuarios':
            window.location.href = '../../view/usuarios/crud_usuarios.php';
            break;
        case 'disponibilidades':
            window.location.href = '../../view/disponibilidad/create_disponibilidad.php';
            break;
        case 'trayectorias':
            window.location.href = '../../view/trayectoria/create_traye.php';
            break;
        case 'avisos':
            window.location.href = '';
            break;
        case 'perfiles':
            window.location.href = '';
            break;
        case 'vehiculos':
            window.location.href = '';
            break;
        case 'reportes':
            window.location.href = '';
            break;
        case 'bd':
            window.location.href = '';
            break;
        default:
            console.error("Página desconocida");
    }
}
