<?php


class AdminController {

    public function dashboard() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
   echo "<h1>Bienvenido ADMIN</h1>";
        echo "<p>Aquí irá tu dashboard.</p>";
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        require_once "../app/views/admin/dashboard.php";
    }
    public function cotizacion()
    {
        // Redirige al controlador correcto
        header("Location: /SYSTEM_COTI/public/cotizacion/realizar");
        exit;
    }
}
