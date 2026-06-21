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

        // Aseguramos que la sesión esté iniciada para poder destruirla
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Limpiar todas las variables de sesión
        $_SESSION = array();

        // 2. Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // 3. Finalmente, destruir la sesión.
        session_destroy();

        // Redirigir al login con un mensaje opcional
        header("Location: " . BASE_URL . "login?logout_success=1");
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
