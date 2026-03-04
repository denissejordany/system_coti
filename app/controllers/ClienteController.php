<?php

class ClienteController {

    private function verificarCliente() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 2) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

     public function dashboard()
{
    $this->verificarCliente();

    // UI
    $active = 'dashboard';
    $page_title = 'Panel de Cliente';

    $extra_css = [
        'assets/css/dashboard.css'
    ];

    // Layout + Vista
    require_once __DIR__ . "/../views/layout/header.php";
    require_once __DIR__ . "/../views/dashboard/cliente.php";
    require_once __DIR__ . "/../views/layout/footer.php";
}

}
