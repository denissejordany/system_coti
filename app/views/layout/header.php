<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['usuario']['rol'] ?? null;
?>

<!doctype html>
<html lang="es">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= $page_title ?? 'Sistema de Cotizaciones' ?></title>

<!-- Base -->

<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css">

<!-- CSS por módulo -->
<?php if (!empty($extra_css)): ?>
    <?php foreach ($extra_css as $css): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/<?= $css ?>">
    <?php endforeach; ?>
<?php endif; ?>

</head>

<body>

<header class="topnav">
<div class="nav-container">

    <div class="nav-logo">
        <h2>YQ CORREDORES</h2>
        <h4>Sistema de Cotizaciones</h4>
    </div>

    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">☰</label>

    <nav class="nav-links">

    <?php if ($rol == 2): ?>

        <a href="<?= BASE_URL ?>/cliente/realizar"
           class="<?= (($active ?? '') == 'realizar') ? 'active' : '' ?>">
           Realizar cotización
        </a>

        <a href="<?= BASE_URL ?>/cliente/ver"
           class="<?= (($active ?? '') == 'ver') ? 'active' : '' ?>">
           Ver cotizaciones
        </a>

    <?php elseif ($rol == 1): ?>

        <a href="<?= BASE_URL ?>/admin/realizar"
           class="<?= (($active ?? '') == 'realizar') ? 'active' : '' ?>">
           Realizar cotización
        </a>

        <a href="<?= BASE_URL ?>/admin/ver"
           class="<?= (($active ?? '') == 'ver') ? 'active' : '' ?>">
           Ver cotizaciones
        </a>

        <a href="<?= BASE_URL ?>/admin/clinicas"
           class="<?= (($active ?? '') == 'clinicas') ? 'active' : '' ?>">
           Gestionar clínicas
        </a>

        <a href="<?= BASE_URL ?>/admin/planes"
           class="<?= (($active ?? '') == 'planes') ? 'active' : '' ?>">
           Gestionar planes
        </a>

        <a href="<?= BASE_URL ?>/admin/reportes"
           class="<?= (($active ?? '') == 'reportes') ? 'active' : '' ?>">
           Reportes
        </a>

    <?php endif; ?>

        <a href="<?= BASE_URL ?>/login/logout" class="logout">
            Cerrar sesión
        </a>

    </nav>

</div>
</header>

<main class="main-content">
