<?php
// Datos de conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'bd_coti');
define('DB_USER', 'root');
define('DB_PASS', '');

// Ruta base del proyecto
define('BASE_URL', 'http://localhost/SYSTEM_COTI/public/');
define('APP_PATH', __DIR__ . '/../');


define('DB_CHARSET', 'utf8mb4');

// Opciones adicionales
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no está iniciada (útil centralizar aquí)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
