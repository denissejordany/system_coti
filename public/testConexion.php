<?php
require_once __DIR__ . '/../app/config/config.php';
require_once "../app/models/Conexion.php";

try {
    $db = new Conexion();
    echo "¡Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
