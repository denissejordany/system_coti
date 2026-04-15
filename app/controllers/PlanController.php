<?php

require_once __DIR__ . "/../models/PlanModel.php";

class PlanController {

    public function planes()
    {
        $model = new PlanModel();

        $companias = $model->getCompanias();
        $clinicas  = $model->getClinicas();
        $planes    = $model->getPlanes();

        $active = 'planes';
        $page_title = 'Gestión de Planes';

        $extra_css = [
            'assets/css/planes.css'
        ];

        $extra_js = [
            'assets/js/planes.js'
        ];

        // Vista + Layout
        require_once __DIR__ . "/../views/layout/header.php";
        require_once __DIR__ . "/../views/planes/index.php";
        require_once __DIR__ . "/../views/layout/footer.php";
    }

    public function guardarPlan()
    {
        header('Content-Type: application/json');

        try {

            require_once __DIR__ . '/../models/PlanModel.php';

            $model = new PlanModel();

            $data = $_POST;

            $model->guardarPlanCompleto($data);

            echo json_encode([
                "success" => true
            ]);

        } catch (Exception $e) {

            echo json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function eliminar($id)
    {
        header('Content-Type: application/json');

        try {

            $model = new PlanModel();
            $model->eliminarPlan($id);

            echo json_encode(["success" => true]);

        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function listar()
{
    header('Content-Type: application/json');

    try {

        require_once __DIR__ . '/../models/PlanModel.php';

        $model = new PlanModel();

        $planes = $model->obtenerPlanes();

        echo json_encode($planes);

    } catch (Exception $e) {

        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
    }
}
}