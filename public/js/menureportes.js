function navigateTo(page) {
    switch (page) {
        case 'reporte1':
            window.location.href = '../../../estancia/view/reportes/reporte1.php';
            break;
        case 'reporte2':
            window.location.href = '../../../estancia/view/reportes/reporte2.php';
            break;
        case 'reporte3':
            window.location.href = '../../../estancia/view/reportes/reporte3.php';
            break;
        case 'reporte4':
            window.location.href = '../../../estancia/view/reportes/reporte4.php';
            break;
        case 'reporte5':
            window.location.href = '../../../estancia/view/reportes/reporte5.php';
            break;
        default:
            console.error("Página desconocida");
    }
}
