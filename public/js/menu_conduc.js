function navigateTo(page) {
    switch (page) {
        case 'vehiculo':
            window.location.href = '../../view/vehiculo/create_vehiculos.php';
            break;
        case 'mis-vehiculos':
            window.location.href = '../../view/vehiculo/read_v.php';
            break;
        case 'disponibilidad':
            window.location.href = '../../view/disponibilidad/create_disponibilidad.php';
            break;
        case 'mis-disponibilidades':
            window.location.href = '../../view/disponibilidad/read_dispo.php';
            break;
        case 'trayectoria':
            window.location.href = '../../view/trayectoria/hacer_trayectoria.php';
             break;
        case 'mis-trayectorias':
            window.location.href = '../../view/trayectoria/ver_trayectoria.php';
            break;
        case 'mis-solicitudes':
            window.location.href = '../../view/solicitudes/ver_solicitudes_c.php';
        break;
        default:
        
            console.error("Página desconocida");
    }
}
