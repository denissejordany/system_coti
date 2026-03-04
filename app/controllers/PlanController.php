<?php

require_once __DIR__ . "/../models/PlanModel.php";

class PlanController {

public function planes()
{
    // UI
    $page_title = "Gestionar Planes";
    $active = "planes";

    $extra_css = [
        'assets/css/planes.css'
    ];
    // Datos
    $planModel = new PlanModel();
    $planes = $planModel->getAll();

    // Vista + Layout
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/planes/index.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}
}