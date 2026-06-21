<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 p-4 pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold text-dark m-0">Gestión de Usuarios</h5>
                <p class="text-muted small m-0">Administra los accesos y roles del personal y clientes.</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2" 
        onclick="abrirModalCrear()">
    <i class="bi bi-person-plus"></i>
    <span>Nuevo Usuario</span>
</button>
        </div>
    </div>

    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="bg-light">
                        <th class="ps-3 text-uppercase text-muted small fw-bold border-0">Usuario</th>
                        <th class="text-uppercase text-muted small fw-bold border-0">Código Asesor</th>
                        <th class="text-uppercase text-muted small fw-bold border-0">Rol</th>
                        <th class="text-center text-uppercase text-muted small fw-bold border-0">Acciones</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    <?php 
                        $usuarios = $usuarios ?? []; 
                        if (!empty($usuarios)): 
                            foreach ($usuarios as $u): 
                                // Lógica para el badge del rol
                                $rol_name = ($u['id_rol'] == 1) ? 'Administrador' : 'Asesor/Cliente';
                                $rol_class = ($u['id_rol'] == 1) ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary';
                    ?>
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-primary border" style="width: 40px; height: 40px;">
                                        <?= substr($u['dni'], 0, 2) ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= $u['dni'] ?></div>
                                        <div class="text-muted small">ID: #<?= $u['id'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary fw-medium">
                                    <?= $u['cod_asesor'] ?: '<span class="text-light-emphasis small italic">Sin código</span>' ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 <?= $rol_class ?>">
                                    <?= $rol_name ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="editarUsuario(<?= $u['id'] ?>)">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </button>
                                    <button class="btn btn-icon btn-light rounded-circle border shadow-sm" onclick="eliminarUsuario(<?= $u['id'] ?>)">
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
                                <i class="bi bi-people display-1 text-light"></i>
                                <h5 class="mt-3 text-muted">No hay usuarios registrados</h5>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'modal_usuario.php'; ?>
<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>
<script src="<?= BASE_URL ?>assets/js/usuarios/usuarios.js"></script>