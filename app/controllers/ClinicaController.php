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

    public function guardar()
    {
        // Forzamos a que el navegador interprete la respuesta puramente como JSON
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre'] ?? '');
            $sede   = trim($_POST['sede'] ?? '');

            // Validamos campos vacíos antes de tocar la base de datos
            if (empty($nombre) || empty($sede)) {
                echo json_encode([
                    "success" => false,
                    "message" => "Todos los campos son totalmente obligatorios."
                ]);
                exit;
            }

            $clinicaModel = new ClinicaModel();
            $resultado = $clinicaModel->crear($nombre, $sede);

            if ($resultado) {
                echo json_encode([
                    "success" => true,
                    "message" => "Clínica registrada correctamente en el sistema."
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Ocurrió un error en el servidor al intentar registrar la clínica."
                ]);
            }
            exit; // Matamos el proceso para que no se filtre ningún layout o HTML accidental
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Método no permitido."
            ]);
            exit;
        }
    }  

    public function eliminar($id = null)
    {
        // Validamos que el ID realmente haya llegado
        if ($id !== null) {

            $clinicaModel = new ClinicaModel();
            $resultado = $clinicaModel->eliminar($id);

            if ($resultado) {
                // Almacenas el mensaje en la sesión para tus alertas flotantes (Toasts)
                $_SESSION['toast'] = "Clínica eliminada correctamente";
            } else {
                $_SESSION['toast_error'] = "No se pudo eliminar la clínica. Podría estar vinculada a un plan.";
            }

            // Redirección tradicional nativa (Tu JS global la espera con window.location.href)
            header("Location: " . BASE_URL . "admin/clinicas");
            exit;
        } else {
            // Protección por si entran a /admin/clinicas/eliminar sin un ID
            header("Location: " . BASE_URL . "admin/clinicas?error=ID no especificado");
            exit;
        }
    }
    
    public function getClinica()
    {
        $id = $_GET['id'] ?? null;

        $clinicaModel = new ClinicaModel();
        $clinica = $clinicaModel->getById($id);

        echo json_encode($clinica);
    }
    public function actualizarClinica()
    {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $sede = $_POST['sede'] ?? '';

        $clinicaModel = new ClinicaModel();
        $clinicaModel->actualizar($id,$nombre,$sede);

        echo "ok";
    }
}