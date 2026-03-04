<?php

require_once __DIR__ . "/../models/ClinicaModel.php";

class CotizacionController {

public function realizar()
{
    // UI
    $page_title = "Realizar Cotización";
    $active = "realizar";

    $extra_css = [
        'assets/css/cotizacion.css'
    ];
    // Datos
    $clinicaModel = new ClinicaModel();
    $clinicas = $clinicaModel->getAll();

    // Vista + Layout
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/cotizaciones/realizar.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}


   public function ver()
{
    // UI
    $page_title = "Ver Cotizaciones";
    $active = "ver";

    $extra_css = [
    
        'assets/css/vercotizacion.css'
    ];

    // (Opcional luego: traer cotizaciones del modelo)
    // $model = new CotizacionModel();
    // $cotizaciones = $model->getAllByUser($_SESSION['usuario']['id']);

    // Layout + Vista
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/cotizaciones/ver.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}

    public function guardar() 
{
    $model = new CotizacionModel();

    // 1. Guardar cliente
    $idCliente = $model->guardarCliente($_POST['cliente']);

    // 2. Guardar dependientes
 $tipoAsegurado = $_POST['cliente']['tipo_asegurado'] ?? null;

// Guardar dependientes
if (!empty($_POST['dependientes'])) {
    $model->guardarDependientes($idCliente, $_POST['dependientes'], $tipoAsegurado);
}
    // 3. Guardar cobertura
    $idCobertura = $model->guardarCobertura($_POST['cobertura']);

    // 4. Guardar cotización
    $model->guardarCotizacion($idCliente, $idCobertura, $_POST['plan_id']);

    // 5. Mensaje o redirección
    header("Location: /SYSTEM_COTI/public/cotizacion/ver");
}

}
