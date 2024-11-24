function navigateTo(page) {
    switch (page) {
        case 'usuarios':
            window.location.href = '../../view/usuarios/crud_usuarios.php';
            break;
        case 'disponibilidades':
            window.location.href = '../../view/disponibilidad/crud_disponibilidad.php';
            break;
        case 'trayectorias':
            window.location.href = '../../view/trayectoria/menutrayectoria.php';
            break;
        case 'avisos':
            window.location.href = '../../view/avisos/crud_avisos.php';
            break;
        case 'perfiles':
            window.location.href = '../../view/perfil/menuperfiles.php';
            break;
        case 'vehiculos':
            window.location.href = '../../view/vehiculo/crud_vehiculo.php';
            break;
        case 'reportes':
            window.location.href = '../../view/reportes/menureportes.php';
            break;
        case 'bd':
            window.location.href = '../../view/bd/database.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
