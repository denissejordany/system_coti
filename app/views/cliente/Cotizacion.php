<?php
// $mode llega desde el controlador: "realizar" o "ver"

$page_title = ($mode === "realizar")
    ? "Realizar Cotización"
    : "Ver Cotizaciones";

$active = ($mode === "realizar") ? "realizar" : "ver";
$extra_css = ["assets/css/cotizacion.css"];

require_once __DIR__ . "/../layouts/header.php";

// Partial dinámico
$partial = ($mode === "realizar")
    ? "realizarCotizacion.php"
    : "verCotizaciones.php";

require_once __DIR__ . "/../partials/" . $partial;

require_once __DIR__ . "/../layouts/footer.php";
