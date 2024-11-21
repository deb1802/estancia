<?php
include_once '../model/reporte2_m.php';

class ReporteController {
    public function generarReporte() {
        generar_reporte2();
    }
}
$controller = new ReporteController();
$controller->generarReporte();
?>
