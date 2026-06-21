<?php

class Router {

    public function run() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();

    }

    $publicRoutes = ['login', 'login/validar'];

            $url = $_GET['url'] ?? '';
            $url = trim($url, '/');
    if (!in_array($url, $publicRoutes)) {

    if (!isset($_SESSION['usuario'])) {
        header("Location: " . BASE_URL . "login");
        exit;
    }

        // Validar que tenga rol
        if (!isset($_SESSION['usuario']['rol'])) {
            session_destroy();
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }
        // Default
        if (empty($url)) {
            $this->load('LoginController', 'index');
            return;
        }

        $segments = explode('/', $url);
        $rol = $_SESSION['usuario']['rol'] ?? null;

        // 🔐 PROTECCIÓN POR ROL
        if ($segments[0] === 'admin' && $rol != 1) {
            session_destroy();
            header("Location: " . BASE_URL . "login");
            exit;
        }

        if ($segments[0] === 'cliente' && $rol != 2) {
            session_destroy();
            header("Location: " . BASE_URL . "login");
            exit;
        }
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
                if (isset($segments[2])) {
                    if ($segments[2] === 'guardar') {
                        $this->load('ClinicaController', 'guardar');
                        return;
                    }
                    if ($segments[2] === 'actualizar') {
                        $this->load('ClinicaController', 'actualizar');
                        return;
                    }
                    if ($segments[2] === 'get' && isset($segments[3])) {
                        $this->load('ClinicaController', 'get', [$segments[3]]);
                        return;
                    }
                    if ($segments[2] === 'eliminar' && isset($segments[3])) {
                        $this->load('ClinicaController', 'eliminar', [$segments[3]]);
                        return;
                    }
                }

                // Si no hay más segmentos, carga la grilla por defecto
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

            // ==========================================
            // MÓDULO FUSIONADO: /admin/usuarios
            // ==========================================
            if ($segments[1] === 'usuarios') {
                
                // Si existe un tercer segmento (ej: admin/usuarios/guardar, admin/usuarios/get)
                if (isset($segments[2])) {
                    
                    if ($segments[2] === 'guardar') {
                        $this->load('UserController', 'guardar');
                        return;
                    }
                    
                    if ($segments[2] === 'actualizar') {
                        $this->load('UserController', 'actualizar');
                        return;
                    }
                    
                    if ($segments[2] === 'get' && isset($segments[3])) {
                        $this->load('UserController', 'get', [$segments[3]]);
                        return;
                    }

                    if ($segments[2] === 'eliminar' && isset($segments[3])) {
                        $this->load('UserController', 'eliminar', [$segments[3]]);
                        return;
                    }
                }

                // Si no hay tercer segmento, por defecto carga la lista principal
                $this->load('UserController', 'usuarios');
                return;
            }
        } // <--- AQUÍ RECIÉN CIERRA EL LLAVE DE ENTRADA DE "ADMIN"

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
