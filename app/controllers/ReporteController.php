<?php


class ReporteController {

public function reportes()
{
    // UI
    $page_title = "Reportes";
    $active = "reportes";

    $extra_css = [
        'assets/css/reportes.css'
    ];
    // Datos
  

    // Vista + Layout
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/reportes/index.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}
}