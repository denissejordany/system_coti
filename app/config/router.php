<?php

class Router {

    public function run() {

        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');

        // Default
        if (empty($url)) {
            $this->load('LoginController', 'index');
            return;
        }

        $segments = explode('/', $url);

        /*
         * ============================
         * RUTAS ESPECIALES POR ROL
         * ============================
         */

        // ADMIN
        if ($segments[0] === 'admin') {

            // /admin
            if (!isset($segments[1])) {
                $this->load('AdminController', 'dashboard');
                return;
            }

            // /admin/clinicas
            if ($segments[1] === 'clinicas') {
                $this->load('ClinicaController', 'clinicas');
                return;
            }

            // /admin/planes
            if ($segments[1] === 'planes') {
                $this->load('PlanController', 'planes');
                return;
            }

            // /admin/reportes
            if ($segments[1] === 'reportes') {
                $this->load('ReporteController', 'reportes');
                return;
            }

            // /admin/realizar
            if ($segments[1] === 'realizar') {
                $this->load('CotizacionController', 'realizar');
                return;
            }

            // /admin/ver
            if ($segments[1] === 'ver') {
                $this->load('CotizacionController', 'ver');
                return;
            }
        }


        // CLIENTE
        if ($segments[0] === 'cliente') {

            // /cliente
            if (!isset($segments[1])) {
                $this->load('ClienteController', 'dashboard');
                return;
            }

            // /cliente/realizar
            if ($segments[1] === 'realizar') {
                $this->load('CotizacionController', 'realizar');
                return;
            }

            // /cliente/ver
            if ($segments[1] === 'ver') {
                $this->load('CotizacionController', 'ver');
                return;
            }
        }


        /*
         * ============================
         * RUTAS GENERALES (fallback)
         * ============================
         */

        $controller = ucfirst($segments[0]) . 'Controller';
        $method     = $segments[1] ?? 'index';
        $params     = array_slice($segments, 2);

        $this->load($controller, $method, $params);
    }


    private function load($controller, $method, $params = []) {

        $path = APP_PATH . 'controllers/' . $controller . '.php';

        if (!file_exists($path)) {
            $this->pageNotFound("Controlador $controller no existe");
            return;
        }

        require_once $path;

        $obj = new $controller();

        if (!method_exists($obj, $method)) {
            $this->pageNotFound("Método $method no existe en $controller");
            return;
        }

        call_user_func_array([$obj, $method], $params);
    }


    private function pageNotFound($msg) {

        http_response_code(404);

        echo "<h1>404 - Página no encontrada</h1>";
        echo "<p>$msg</p>";
    }
}
