function navigateTo(page) {
    switch (page) {
        case 'usuarios':
            window.location.href = '../../view/usuarios/crud_usuarios.php';
            break;
        case 'disponibilidades':
            window.location.href = '../../view/disponibilidad/crud_disponibilidad.php';
            break;
        case 'trayectorias':
            window.location.href = '../../view/trayectoria/crud_trayectoria.php';
            break;
        case 'avisos':
            window.location.href = '../../view/avisos/crud_avisos.php';
            break;
        case 'perfiles':
            window.location.href = '../../view/perfil/crear_perfil_a.php';
            break;
        case 'vehiculos':
            window.location.href = '../../view/vehiculo/crud_vehiculo.php';
            break;
        case 'reportes':
            window.location.href = '';
            break;
        case 'bd':
            window.location.href = '../../view/bd/bdd.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
