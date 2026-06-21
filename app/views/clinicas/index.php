<div class="p-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title text-secondary m-0">Listado de Clínicas</h5>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header bg-white border-0 p-4 pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark m-0">Gestión de Clínicas</h5>
                    <p class="text-muted small m-0">Administra y organiza los centros médicos afiliados al sistema.</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2" onclick="abrirModalCrearClinica()">
                    <i class="bi bi-plus-lg"></i>
                    <span>Nueva Clínica</span>
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 text-uppercase text-muted small fw-bold border-0" style="width: 80px;">ID</th>
                            <th class="text-uppercase text-muted small fw-bold border-0">Detalles de la Clínica</th>
                            <th class="text-uppercase text-muted small fw-bold border-0">Sede / Ubicación</th>
                            <th class="text-center text-uppercase text-muted small fw-bold border-0">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        <?php 
                            $clinicas = $clinicas ?? []; 
                            if (!empty($clinicas)): 
                                foreach ($clinicas as $c): 
                        ?>
                            <tr class="transition-all">
                                <td class="ps-3">
                                    <span class="badge rounded-3 bg-light text-secondary fw-medium px-2 py-2">
                                        #<?= $c['id'] ?? '0' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $c['nombre'] ?? 'Sin Nombre' ?></div>
                                    <div class="text-muted small">Entidad Médica Afiliada</div>
                                </td>
                                <td>
                                    <span class="d-flex align-items-center gap-2 text-secondary">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                        <?= $c['sede'] ?? 'No especificada' ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="editarClinica(<?= $c['id'] ?>)" title="Editar">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="eliminarClinica(<?= $c['id'] ?>)" title="Eliminar">
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
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-hospital display-1 text-light"></i>
                                        <h5 class="mt-3 text-muted">No se encontraron clínicas</h5>
                                        <p class="text-muted small">Comienza agregando una nueva con el botón superior.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div> </div> </div> </div> <?php include 'modal_clinica.php'; ?>

<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<script src="<?= BASE_URL ?>assets/js/clinicas/clinicas.js"></script>