<?php

class Router {

    public function run() {

        // Obtener la URL limpia
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

        // Si no hay ruta, mandamos al login por defecto
        if (empty($url)) {
            $controlador = 'LoginController';
            $metodo = 'index';
            $parametros = [];
        } else {

            $url = explode('/', $url);

            // Controlador
            $controlador = ucfirst($url[0]) . 'Controller';
            unset($url[0]);

            // Método
            $metodo = isset($url[1]) ? $url[1] : 'index';
            unset($url[1]);

            // Parámetros
            $parametros = $url ? array_values($url) : [];
        }

        // Ruta del controlador
        $controladorRuta = "../app/controllers/" . $controlador . ".php";

        // Validación
        if (!file_exists($controladorRuta)) {
            $this->pageNotFound("Controlador '$controlador' no encontrado.");
            return;
        }

        require_once $controladorRuta;

        // Instancia
        $controladorObj = new $controlador();

        // Validar método
        if (!method_exists($controladorObj, $metodo)) {
            $this->pageNotFound("Método '$metodo' no encontrado en '$controlador'.");
            return;
        }

        // Ejecutar método con parámetros
        call_user_func_array([$controladorObj, $metodo], $parametros);
    }

    private function pageNotFound($mensaje) {
        echo "<h1>404 - Página no encontrada</h1>";
        echo "<p>$mensaje</p>";
    }
}
