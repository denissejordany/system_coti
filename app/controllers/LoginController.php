<?php

require_once "../app/models/Login.php";

class LoginController {

   public function index() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['rol'] == 1) {
            header("Location: " . BASE_URL . "admin/dashboard");
            exit;
        } else {
            header("Location: " . BASE_URL . "cliente/cotizacion");
            exit;
        }
    }

    require_once "../app/views/login/Login.php";
}


    public function validar() {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

        $dni = $_POST['dni'] ?? null;
        $password = $_POST['password'] ?? null;

        $model = new Login();
        $user = $model->loginUsuario($dni, $password);

        if ($user) {

            // Crear sesión
            $_SESSION['usuario'] = [
                'id'     => $user['id'],
                'dni'    => $user['dni'],
                'rol'    => $user['id_rol']
            ];

            // Redirigir según rol
            if ($user['id_rol'] == 1) {
                header("Location: " . BASE_URL . "admin/cotizacion");
                exit;
            } else {
                header("Location: " . BASE_URL . "cliente/cotizacion");
                exit;
            }

        } else {
            // ERROR DEL LOGIN
            header("Location: " . BASE_URL . "login?login_error=1");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "login");
    }

    public function registrarUsuario()
    {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

        $dni = $_POST['dni'] ?? null;
        $password = $_POST['password'] ?? null;
        $cod_asesor = $_POST['cod_asesor'] ?? null;

        // Validación básica
        if (!$dni || !$password) {
            header("Location: " . BASE_URL . "login?register_error=Faltan datos");
            exit;
        }

        $model = new Login();

        // Validar si ya existe
        if ($model->usuarioExiste($dni)) {
            header("Location: " . BASE_URL . "login?register_error=El DNI ya está registrado");
            exit;
        }

        // Registrar
        $registro = $model->registrar($dni, $password, $cod_asesor);

        if ($registro) {
            header("Location: " . BASE_URL . "login?registro=ok");
        } else {
            header("Location: " . BASE_URL . "login?register_error=Error al registrar");
        }
    }
}
