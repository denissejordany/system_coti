<?php

require_once __DIR__ . "/../models/ClinicaModel.php";

class ClinicaController {

public function clinicas()
{
    // UI
    $page_title = "Gestionar Clinicas";
    $active = "clinicas";

    $extra_css = [
        'assets/css/clinicas.css'
    ];
    // Datos
    $clinicaModel = new ClinicaModel();
    $clinicas = $clinicaModel->getAll();

    // Vista + Layout
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/clinicas/index.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}
}