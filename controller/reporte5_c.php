<?php
include_once '../model/reporte5_m.php';

class ReporteController {
    public function generarReporte() {
        generar_reporte5();
    }
}
$controller = new ReporteController();
$controller->generarReporte();
?>
