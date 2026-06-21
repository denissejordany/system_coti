<?php

require_once APP_PATH . 'models/UserModel.php';

class UserController {

    public function usuarios() {
        $active = 'usuarios';
        $page_title = 'Gestión de Usuarios';
        
        $model = new UserModel();
        $usuarios = $model->getAll(); // Método que debes tener en tu UserModel
        
        require_once __DIR__ . "/../views/layout/header.php";
        require_once __DIR__ . "/../views/usuarios/index.php";
        require_once __DIR__ . "/../views/layout/footer.php";
    }

    public function get($id) {
        // Importante: Indicar que la respuesta es JSON
        header('Content-Type: application/json');
        
        $model = new UserModel();
        $usuario = $model->getById($id);

        if ($usuario) {
        echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
        exit;
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dni = trim($_POST['dni']);
            $password = $_POST['password']; // Se encriptará en el modelo
            $cod_asesor = trim($_POST['cod_asesor']);
            $id_rol = $_POST['id_rol'];

            $userModel = new UserModel();
            
            // Verificamos si el DNI ya existe antes de crear
            if ($userModel->usuarioExiste($dni)) {
                header("Location: " . BASE_URL . "admin/usuarios?error=El DNI ya existe");
                exit;
            }

            $res = $userModel->crear($dni, $password, $cod_asesor, $id_rol);

            if ($res) {
                header("Location: " . BASE_URL . "admin/usuarios?success=Usuario registrado");
            } else {
                header("Location: " . BASE_URL . "admin/usuarios?error=Error al registrar");
            }
            exit;
        }
    }
}