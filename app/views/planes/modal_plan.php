<?php
// Evita errores de "Undefined variable" inicializándolas como arreglos vacíos si no vienen del controlador
$companias = $companias ?? [];
$clinicas = $clinicas ?? [];
?>

<div class="modal fade" id="modalPlan" tabindex="-1" aria-labelledby="modalPlanLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow rounded-4">
            
            <div class="modal-header border-bottom-0 p-4 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark" id="modalPlanLabel">Crear Nuevo Plan</h5>
                <button type="button" class="btn btn-link text-muted p-1 border-0 shadow-none text-decoration-none" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg fs-5"></i>
                </button>
            </div>
            
            <div class="modal-body p-4 pt-0">
                <form id="formPlan" method="POST">
                    
                    <h6 class="text-primary fw-bold mb-3 text-uppercase small" style="letter-spacing: 0.5px;">Datos del Plan</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Nombre del Plan</label>
                            <input type="text" name="nombre_plan" class="form-control bg-light border-0 shadow-none" placeholder="Ej: Plan Global Premium" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Compañía Aseguradora</label>
                            <select name="id_compania" class="form-select bg-light border-0 shadow-none" required>
                                <option value="">Seleccione una opción</option>
                                <?php foreach ($companias as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Suma Asegurada ($)</label>
                            <input type="number" step="0.01" name="suma_asegurada" class="form-control bg-light border-0 shadow-none" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">URL Cartilla PDF</label>
                            <input type="text" name="nombre_url" class="form-control bg-light border-0 shadow-none" placeholder="https://ejemplo.com/cartilla.pdf">
                        </div>
                    </div>

                    <hr class="text-muted opacity-25 my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-primary fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">Redes del Plan</h6>
                        <button type="button" id="btnAgregarRed" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i> Agregar Red
                        </button>
                    </div>
                    
                    <div id="contenedor-redes" class="mb-4"></div>

                    <hr class="text-muted opacity-25 my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-primary fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">Precios por Edad</h6>
                        <button type="button" id="btnAgregarPrecio" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i> Agregar Rango de Precio
                        </button>
                    </div>
                    
                    <div id="contenedor-precios" class="mb-4"></div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-medium" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            <i class="bi bi-floppy me-2"></i> Guardar Plan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<template id="template-red">
    <div class="bloque-red p-4 border rounded-4 mb-3 bg-white position-relative shadow-sm transition-all">
        <button type="button" class="btn-close btn-eliminar-red position-absolute top-0 end-0 m-3" aria-label="Eliminar Red">
            <i class="bi bi-trash-fill fs-5"></i>
        </button>
        
        <div class="mb-3" style="max-width: 400px;">
            <label class="form-label text-muted small fw-bold">Nombre de la Red</label>
            <input type="text" class="form-control red-nombre bg-light border-0 shadow-none" name="red_nombre[]" placeholder="Ej: Red A / Clínica Angloamericana" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-muted small fw-bold d-block">Clínicas Asignadas a esta Red</label>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 p-3 bg-light rounded-3 border-0 style-grid">
                <?php foreach ($clinicas as $cl): ?>
                    <div class="col">
                        <label class="form-check-label item-clinica d-flex align-items-center gap-2 border bg-white p-2 rounded-3 cursor-pointer">
                            <input type="checkbox" class="form-check-input red-clinica text-primary shadow-none m-0" name="red_clinicas[INDEX][]" value="<?= $cl['id'] ?>">
                            <span class="small text-truncate fw-medium text-dark"><?= $cl['nombre'] ?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-muted small fw-bold">Deducible Ambulatorio</label>
                <input type="number" class="form-control red-ambulatorio bg-light border-0 shadow-none" name="red_ambulatorio[]" placeholder="0.00" required>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small fw-bold">Deducible Hospitalario</label>
                <input type="number" class="form-control red-hospitalario bg-light border-0 shadow-none" name="red_hospitalario[]" placeholder="0.00" required>
            </div>
        </div>
    </div>
</template>

<template id="template-precio">
    <div class="bloque-precio fila-precio d-flex align-items-center gap-2 p-2 bg-white border rounded-3 mb-2 shadow-sm transition-all">
        <div style="width: 130px;">
            <input type="number" name="edad_inicio[]" min="0" max="100" class="form-control form-control-sm bg-light border-0 shadow-none text-center fw-semibold" placeholder="Edad Inicio" required>
        </div>
        
        <div class="form-check form-switch m-0 px-2 d-flex align-items-center gap-1">
            <input type="checkbox" class="form-check-input toggle-rango cursor-pointer shadow-none ms-0" id="customSwitch">
            <label class="form-check-label small text-muted fw-medium cursor-pointer" for="customSwitch">Rango</label>
        </div>

        <div style="width: 130px;">
            <input type="number" name="edad_fin[]" min="0" max="100" class="form-control form-control-sm bg-light border-0 shadow-none text-center fw-semibold" placeholder="Edad Fin" disabled>
        </div>

        <div class="flex-grow-1">
            <input type="number" step="0.01" name="precio[]" class="form-control form-control-sm bg-light border-0 shadow-none font-monospace fw-bold text-success" placeholder="Precio ($)" required>
        </div>

        <button type="button" class="btn btn-sm btn-link text-danger btn-eliminar-precio p-1 shadow-none border-0 text-decoration-none">
            <i class="bi bi-trash-fill fs-5"></i>
        </button>
    </div>
</template>