<?php

require_once APP_PATH . 'models/LoginModel.php';

class LoginController {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado
        if (isset($_SESSION['usuario'])) {

            if ($_SESSION['usuario']['rol'] == 1) {
                header("Location: " . BASE_URL . "admin/dashboard");
            } else {
                header("Location: " . BASE_URL . "cliente/dashboard");
            }

            exit;
        }

        require_once APP_PATH . 'views/login/Login.php';
    }


    public function validar() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $dni      = $_POST['dni'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$dni || !$password) {
            header("Location: " . BASE_URL . "login?login_error=1");
            exit;
        }

        $model = new LoginModel();
        $user  = $model->loginUsuario($dni, $password);

        if ($user) {

            $_SESSION['usuario'] = [
                'id'   => $user['id'],
                'dni'  => $user['dni'],
                'rol'  => $user['id_rol']
            ];

            // Redirección correcta
            if ($user['id_rol'] == 1) {
                header("Location: " . BASE_URL . "admin/dashboard");
            } else {
                header("Location: " . BASE_URL . "cliente/dashboard");
            }

            exit;

        } else {

            header("Location: " . BASE_URL . "login?login_error=1");
            exit;
        }
    }


    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: " . BASE_URL . "login");
        exit;
    }


    public function registrarUsuario() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $dni        = $_POST['dni'] ?? null;
        $password   = $_POST['password'] ?? null;
        $cod_asesor = $_POST['cod_asesor'] ?? null;

        if (!$dni || !$password) {
            header("Location: " . BASE_URL . "login?register_error=Faltan datos");
            exit;
        }

        $model = new LoginModel();

        // Validar si existe
        if ($model->usuarioExiste($dni)) {
            header("Location: " . BASE_URL . "login?register_error=El DNI ya está registrado");
            exit;
        }

        $registro = $model->registrarUser($dni, $password, $cod_asesor);

        if ($registro) {
            header("Location: " . BASE_URL . "login?registro=ok");
        } else {
            header("Location: " . BASE_URL . "login?register_error=Error al registrar");
        }

        exit;
    }
}
