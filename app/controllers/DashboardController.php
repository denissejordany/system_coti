<?php
class DashboardController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        $user = $_SESSION['user'];

        if ($user['rol'] === 'admin') {
            require_once "../app/views/admin/index.php";
        } else {
            require_once "../app/views/cliente/index.php";
        }
    }
}
