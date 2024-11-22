<?php
include_once '../model/reporte3_m.php';

class Reporte3Controller {
    public function generarReporte() {
        generar_reporte3();
    }
}
$controller = new Reporte3Controller();
$controller->generarReporte();
?>
