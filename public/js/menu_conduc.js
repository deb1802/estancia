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
                window.location.href = '../../view/trayectoria/create_traye.php';
                break;
        default:
            console.error("Página desconocida");
    }
}
