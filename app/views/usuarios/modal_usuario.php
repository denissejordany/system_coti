<!-- Modal Usuario -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-header border-bottom-0 p-4 pb-2">
                <h5 class="modal-title fw-bold text-dark" id="modalUsuarioLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 pt-0">
                <form id="formUsuario" method="POST" action="<?= BASE_URL ?>admin/usuarios/guardar">
                    <!-- ID Oculto para edición -->
                    <input type="hidden" name="id" id="user_id">

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">DNI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-card-text"></i></span>
                            <input type="text" name="dni" id="user_dni" class="form-control bg-light border-0 shadow-none" placeholder="8 dígitos" required maxlength="8">
                        </div>
                    </div>

                    <div class="mb-3" id="container-password">
                        <label class="form-label text-muted small fw-bold">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="user_password" class="form-control bg-light border-0 shadow-none" placeholder="Min. 6 caracteres">
                        </div>
                        <small class="text-muted" id="pass-help" style="display:none;">Dejar en blanco para no cambiar</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small fw-bold">Código Asesor</label>
                            <input type="text" name="cod_asesor" id="user_cod" class="form-control bg-light border-0 shadow-none" placeholder="Opcional">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small fw-bold">Rol</label>
                            <select name="id_rol" id="user_rol" class="form-select bg-light border-0 shadow-none" required>
                                <option value="2">Asesor/Cliente</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2 rounded-pill fw-bold">
                            Guardar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>