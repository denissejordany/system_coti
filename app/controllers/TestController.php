<?php

class TestController {

    public function index() {
        echo "El router funciona correctamente 👌";
    }

    public function db() {
        require_once "../app/models/Conexion.php";
        $con = new Conexion();
        echo "Conexión a BD exitosa ✔️";
    }
}
