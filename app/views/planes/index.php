<div class="p-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title text-secondary m-0">Listado de Planes</h5>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header bg-white border-0 p-4 pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark m-0">Gestión de Planes</h5>
                    <p class="text-muted small m-0">Administra y organiza los planes de seguros disponibles.</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2" onclick="abrirModalPlan()">
                    <i class="bi bi-plus-lg"></i>
                    <span>Crear Nuevo Plan</span>
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 text-uppercase text-muted small fw-bold border-0" style="width: 80px;">ID</th>
                            <th class="text-uppercase text-muted small fw-bold border-0">Detalles del Plan</th>
                            <th class="text-uppercase text-muted small fw-bold border-0">Compañía</th>
                            <th class="text-uppercase text-muted small fw-bold border-0">Suma Asegurada</th>
                            <th class="text-center text-uppercase text-muted small fw-bold border-0">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php 
                            $planes = $planes ?? []; 
                            if (!empty($planes)): 
                                foreach ($planes as $p): 
                        ?>
                            <tr class="transition-all">
                                <td class="ps-3">
                                    <span class="badge rounded-3 bg-light text-secondary fw-medium px-2 py-2">
                                        #<?= $p['id'] ?? '0' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $p['nombre_plan'] ?? 'Sin Nombre' ?></div>
                                    <div class="text-muted small">Plan de Seguro Activo</div>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="bi bi-building-check text-primary"></i>
                                        <?= $p['compania'] ?? 'Desconocida' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">
                                        $<?= isset($p['suma_asegurada']) ? number_format($p['suma_asegurada'], 2) : '0.00' ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="editarPlan(<?= $p['id'] ?>)" title="Editar">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="eliminarPlan(<?= $p['id'] ?>)" title="Eliminar">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                                endforeach; 
                            else: 
                        ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-folder2-open display-1 text-light"></i>
                                        <h5 class="mt-3 text-muted">No se encontraron planes</h5>
                                        <p class="text-muted small">Comienza agregando uno nuevo con el botón superior.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div> </div> </div> </div> <?php include 'modal_plan.php'; ?>

<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<script src="<?= BASE_URL ?>assets/js/planes/planes.js"></script>