<?php

require_once __DIR__ . "/../models/ClinicasModel.php";

class CotizacionController {

    public function realizar()
    {
        $mode = "realizar";

        $clinicaModel = new ClinicasModel();
        $clinicas = $clinicaModel->getAll();

        require_once __DIR__ . "/../views/cliente/cotizacion.php";
    }

    public function ver()
    {
        $mode = "ver";
        require_once __DIR__ . "/../views/cliente/cotizacion.php";
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
