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
public function registrarClinica()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = $_POST['nombre'] ?? '';
        $sede   = $_POST['sede'] ?? '';

        $clinicaModel = new ClinicaModel();
        $clinicaModel->crear($nombre, $sede);
        $_SESSION['toast'] = "Clínica Registrada correctamente";

        header("Location: " . BASE_URL . "admin/clinicas");
        exit;
    }
}
public function eliminarClinica()
{
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $clinicaModel = new ClinicaModel();
        $clinicaModel->eliminar($id);
        /*----- TOAST ----*/
$_SESSION['toast'] = "Clínica eliminada correctamente";

        header("Location: " . BASE_URL . "admin/clinicas");
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