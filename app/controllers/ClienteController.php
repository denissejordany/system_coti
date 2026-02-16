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

    public function dashboard() {

        $this->verificarCliente();

        $active = 'dashboard';
        $page_title = 'Panel del Cliente';

        require_once APP_PATH . 'views/dashboard/cliente.php';
    }

    public function realizar() {

        $this->verificarCliente();

        $active = 'realizar';
        $page_title = 'Nueva Cotización';

        require_once APP_PATH . 'views/cliente/realizar.php';
    }

    public function ver() {

        $this->verificarCliente();

        $active = 'ver';
        $page_title = 'Mis Cotizaciones';

        require_once APP_PATH . 'views/cliente/ver.php';
    }
}
