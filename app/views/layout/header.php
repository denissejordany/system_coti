<?php
// Valores por defecto para evitar errores "Undefined variable"
$active = $active ?? '';
$page_title = $page_title ?? 'Panel Administrativo';
$extra_css = $extra_css ?? [];
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Panel Administrativo' ?></title>
    
    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tu CSS general o para la estructura -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">

    <!-- CSS extras dinámicos desde el controlador -->
    <?php if (isset($extra_css) && is_array($extra_css)): ?>
        <?php foreach ($extra_css as $css): ?>
            <link rel="stylesheet" href="<?= BASE_URL . $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="bg-light">

<!-- Contenedor principal que usa Flexbox -->
<div class="d-flex" style="min-height: 100vh;">

    <!-- ========================= -->
    <!-- SIDEBAR (Barra Lateral) -->
    <!-- ========================= -->
    <aside class="bg-white border-end" style="width: 250px;">
        <div class="p-3 text-center border-bottom">
            <h4 class="text-danger fw-bold m-0">
                <i class="bi bi-shield-check"></i> SYSTEM_COTI
            </h4>
        </div>
        
        <div class="list-group list-group-flush mt-3 px-2">
            <span class="text-muted small px-3 mb-2 fw-bold sidebar-heading text-uppercase">Inicio</span>
            
            <a href="<?= BASE_URL ?>admin/dashboard" 
            class="list-group-item list-group-item-action border-0 sidebar-link d-flex align-items-center gap-3 <?= ($active == 'dashboard') ? 'active-link' : '' ?>">
                <i class="bi bi-speedometer2 fs-5"></i> Dashboard
            </a>

            <span class="text-muted small px-3 mt-4 mb-2 fw-bold sidebar-heading text-uppercase">Gestión</span>
            
            <a href="<?= BASE_URL ?>admin/clinicas" 
            class="list-group-item list-group-item-action border-0 sidebar-link d-flex align-items-center gap-3 <?= ($active == 'clinicas') ? 'active-link' : '' ?>">
                <i class="bi bi-hospital fs-5"></i> Clínicas
            </a>
            
            <a href="<?= BASE_URL ?>admin/planes" 
            class="list-group-item list-group-item-action border-0 sidebar-link d-flex align-items-center gap-3 <?= ($active == 'planes') ? 'active-link' : '' ?>">
                <i class="bi bi-file-earmark-text fs-5"></i> Planes
            </a>
            
            <a href="<?= BASE_URL ?>admin/ver" 
            class="list-group-item list-group-item-action border-0 sidebar-link d-flex align-items-center gap-3 <?= ($active == 'ver') ? 'active-link' : '' ?>">
                <i class="bi bi-clipboard-data fs-5"></i> Cotizaciones
            </a>

            <span class="text-muted small px-3 mt-4 mb-2 fw-bold sidebar-heading text-uppercase">Configuración</span>

            <a href="<?= BASE_URL ?>admin/usuarios" 
            class="list-group-item list-group-item-action border-0 sidebar-link d-flex align-items-center gap-3 <?= ($active == 'usuarios') ? 'active-link' : '' ?>">
                <i class="bi bi-people fs-5"></i> Usuarios
            </a>
        </div>
    </aside>

    <!-- ========================= -->
    <!-- CONTENIDO PRINCIPAL -->
    <!-- ========================= -->
    <main class="flex-grow-1">
        
        <!-- Navbar Superior -->
        <nav class="navbar navbar-expand-lg bg-white border-bottom p-3">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1"><?= $page_title ?? '' ?></span>
                
                <div class="dropdown">
                    <div class="d-flex align-items-center dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <span class="me-3 text-muted d-none d-md-inline">¡Hola, Admin!</span>
                        <img src="<?= BASE_URL ?>assets/img/avatar.png" alt="User" class="rounded-circle border" width="40" height="40">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> Mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="<?= BASE_URL ?>login/logout">
                            <i class="bi bi-box-arrow-left me-2"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenedor dinámico donde entra la vista -->
        <div class="container-fluid p-4">
            <!-- AQUÍ EMPIEZA TU index.php (Vista) -->