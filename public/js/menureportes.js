function navigateTo(page) {
    switch (page) {
        case 'reporte1':
            window.location.href = '../../../estancia/view/reportes/reporte1.php';
            break;
        case 'disponibilidades':
            window.location.href = '../../../estancia/view/reportes/reporte2.php';
            break;
        case 'trayectorias':
            window.location.href = '../../../estancia/view/reportes/reporte3.php';
            break;
        case 'avisos':
            window.location.href = '';
            break;
        case 'perfiles':
            window.location.href = '';
            break;
        default:
            console.error("Página desconocida");
    }
}
