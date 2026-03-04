<?php

class AdminController {

    /**
     * Verifica si el usuario es admin
     */
    private function verificarAdmin() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

 public function dashboard()
{
    $this->verificarAdmin();

    // UI
    $active = 'dashboard';
    $page_title = 'Panel de Administración';

    $extra_css = [
        'assets/css/dashboard.css'
    ];

    // Layout + Vista
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/dashboard/admin.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}

}
