<div class="modal fade" id="modalClinica" tabindex="-1" aria-labelledby="modalClinicaLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
                
            <div class="modal-header border-bottom-0 p-4 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark" id="modalClinicaLabel">Crear Clínica</h5>
                <button type="button" class="btn btn-link text-muted p-1 border-0 shadow-none text-decoration-none" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg fs-5"></i>
                </button>
            </div>
            
            <div class="modal-body p-4 pt-0">
                <form id="formClinica" method="POST">
                    
                    <input type="hidden" name="id" id="clinica_id">
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Nombre de la Clínica</label>
                        <input type="text" name="nombre" id="clinica_nombre" class="form-control bg-light border-0 shadow-none" placeholder="Ej: Clínica Ricardo Palma" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Sede</label>
                        <input type="text" name="sede" id="clinica_sede" class="form-control bg-light border-0 shadow-none" placeholder="Ej: San Isidro / Lima" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-medium" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardarClinica" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            Guardar Clínica
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>