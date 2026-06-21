// =========================================================================
// GESTIÓN ASÍNCRONA DEL MODAL DE CLÍNICAS (Bootstrap 5)
// =========================================================================
let urlEliminacionPendiente = "";
let bootstrapClinicaModal = null;
let bootstrapEliminarModal = null;

/**
 * Inicializa la instancia global del modal si no existe
 */
function obtenerInstanciaModal() {
    if (!bootstrapClinicaModal) {
        bootstrapClinicaModal = new bootstrap.Modal(document.getElementById("modalClinica"));
    }
    return bootstrapClinicaModal;
}

/**
 * Abre el modal limpio configurado para CREAR una nueva clínica
 */
function abrirModalCrearClinica() {
    const modal = obtenerInstanciaModal();
    
    // Configuración de textos y endpoints para inserción nativa
    document.getElementById("modalClinicaLabel").innerText = "Crear Nueva Clínica";
    document.getElementById("formClinica").action = BASE_URL + "admin/clinicas/guardar";
    document.getElementById("btnGuardarClinica").innerText = "Guardar Clínica";
    
    // Resetear campos e ID oculto
    document.getElementById("clinica_id").value = "";
    document.getElementById("formClinica").reset();
    
    modal.show();
}

// =========================================================================
// ENVIAR FORMULARIO DE CLÍNICA (AJAX - POST)
// =========================================================================
document.getElementById("formClinica").addEventListener("submit", function (e) {
    // 1. Evitamos el comportamiento nativo de recarga
    e.preventDefault();

    const form = this;
    const actionUrl = form.action; // Lee dinámicamente si es /guardar o /actualizar

    // 2. Extraemos los campos limpios usando FormData
    const formData = new FormData(form);

    // 3. Enviamos la petición asíncrona al backend
    fetch(actionUrl, {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error("Error en la comunicación con el servidor.");
        return response.json();
    })
    .then(data => {
        // Tu backend debe responder {"success": true, "message": "..."}
        if (data.success) {
            alert("✅ " + (data.message || "Operación realizada con éxito"));
            
            // Cerrar el modal de forma limpia
            const modal = obtenerInstanciaModal();
            modal.hide();
            
            // Recargamos el listado para reflejar los cambios
            location.reload(); 
        } else {
            alert("⚠️ " + (data.message || "No se pudo procesar la solicitud"));
        }
    })
    .catch(error => {
        console.error("Error crítico al procesar clínica:", error);
        alert("❌ Hubo un error de red o en el servidor al intentar guardar.");
    });
});

/**
 * Obtiene los datos de una clínica mediante FETCH y abre el modal para EDITAR
 * @param {number} id - Identificador único de la clínica
 */
function editarClinica(id) {
    const modal = obtenerInstanciaModal();
    
    // Consultamos al controlador usando la estructura de subrutas limpia
    fetch(BASE_URL + 'admin/clinicas/get/' + id)
        .then(response => {
            if (!response.ok) throw new Error('No se pudo obtener la información.');
            return response.json();
        })
        .then(data => {
            // Reconfiguramos el formulario para actualización
            document.getElementById("modalClinicaLabel").innerText = "Editar Clínica";
            document.getElementById("formClinica").action = BASE_URL + "admin/clinicas/actualizar";
            document.getElementById("btnGuardarClinica").innerText = "Actualizar Cambios";
            
            // Inyección limpia de valores en los inputs
            document.getElementById("clinica_id").value = data.id;
            document.getElementById("clinica_nombre").value = data.nombre;
            document.getElementById("clinica_sede").value = data.sede;
            
            modal.show();
        })
        .catch(error => {
            console.error('Error al cargar la clínica:', error);
            alert('⚠️ Ocurrió un error al intentar recuperar los datos de la clínica.');
        });
}

/**
 * Gestiona la eliminación tradicional por redirección de URL limpia
 * @param {number} id - Identificador único de la clínica
 */
// 1. La función que llama tu botón de la tabla (onclick="eliminarClinica")
function eliminarClinica(id) {
    const url = BASE_URL + 'admin/clinicas/eliminar/' + id;
    const mensaje = "¿Estás seguro de eliminar esta clínica? Esta acción podría desvincular planes asociados.";
    
    // Llamamos al disparador del modal global
    confirmarEliminacionGlobal(url, mensaje);
}

function confirmarEliminacionGlobal(url, mensaje = "Esta acción no se puede deshacer.") {
    urlEliminacionPendiente = url;
    
    const txtMensaje = document.getElementById("modalEliminarMensaje");
    if (txtMensaje) txtMensaje.innerText = mensaje;

    if (!bootstrapEliminarModal) {
        bootstrapEliminarModal = new bootstrap.Modal(document.getElementById("modalConfirmarEliminar"));
    }
    
    bootstrapEliminarModal.show();
}

// 3. El escucha del botón definitivo de confirmación
document.addEventListener("DOMContentLoaded", () => {
    const btnConfirmar = document.getElementById("btnConfirmarEliminarGlobal");
    if (btnConfirmar) {
        btnConfirmar.addEventListener("click", () => {
            if (urlEliminacionPendiente) {
                window.location.href = urlEliminacionPendiente;
            }
        });
    }
});