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

    /**
     * Dashboard principal
     */
    public function dashboard() {

        $this->verificarAdmin();

        $active = 'dashboard';
        $page_title = 'Panel de Administración';

        require_once APP_PATH . 'views/dashboard/admin.php';
    }

}
