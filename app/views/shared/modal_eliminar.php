<div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-sm"> <div class="modal-content border-0 shadow rounded-4 text-center p-3">
            
            <div class="modal-body">
                <div class="text-danger mb-3">
                    <i class="bi bi-exclamation-triangle-fill display-4"></i>
                </div>
                
                <h5 class="fw-bold text-dark mb-2" id="modalEliminarTitulo">¿Confirmar eliminación?</h5>
                <p class="text-muted small mb-4" id="modalEliminarMensaje">Esta acción no se puede deshacer.</p>
                
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-3 btn-sm fw-medium" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirmarEliminarGlobal" class="btn btn-danger rounded-pill px-3 btn-sm fw-bold shadow-sm">
                        Confirmar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>