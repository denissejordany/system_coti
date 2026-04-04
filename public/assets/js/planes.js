let indexRed = 0;

// ==========================
// AGREGAR RED
// ==========================
document.getElementById("btnAgregarRed").addEventListener("click", () => {

    const template = document.getElementById("template-red").content.cloneNode(true);

    // Reemplazar INDEX para clínicas
    template.querySelector("select").name = `red_clinicas[${indexRed}][]`;

    document.getElementById("contenedor-redes").appendChild(template);

    indexRed++;
});

// ==========================
// ELIMINAR RED
// ==========================
document.addEventListener("click", function(e) {
    if (e.target.classList.contains("btn-eliminar-red")) {
        e.target.closest(".bloque-red").remove();
    }
});

// ==========================
// AGREGAR PRECIO
// ==========================
document.getElementById("btnAgregarPrecio").addEventListener("click", () => {

    const template = document.getElementById("template-precio").content.cloneNode(true);

    document.getElementById("contenedor-precios").appendChild(template);
});

// ==========================
// ELIMINAR PRECIO
// ==========================
document.addEventListener("click", function(e) {
    if (e.target.classList.contains("btn-eliminar-precio")) {
        e.target.closest(".bloque-precio").remove();
    }
});

// ==========================
// ENVIAR FORMULARIO (AJAX)
// ==========================
document.getElementById("formPlan").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch(BASE_URL + "plan/guardarPlan", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            mostrarToast("✅ Plan guardado correctamente");

            form.reset();
            document.getElementById("contenedor-redes").innerHTML = "";
            document.getElementById("contenedor-precios").innerHTML = "";
        } else {
            mostrarToast("❌ " + data.message);
        }

    })
    .catch(err => {
        console.error(err);
        mostrarToast("❌ Error en el servidor");
    });
});

// ==========================
// ELIMINAR PLAN (AJAX)
// ==========================

function eliminarPlan(id) {

    if (!confirm("¿Eliminar este plan?")) return;

    fetch(BASE_URL + "plan/eliminar/" + id)
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            mostrarToast("🗑️ Plan eliminado");
            location.reload();
        } else {
            mostrarToast("❌ Error al eliminar");
        }

    });
}

// ==========================
// MODAL
// ==========================
function abrirModalPlan() {
    document.getElementById("modalPlan").style.display = "flex";
}

function cerrarModalPlan() {
    document.getElementById("modalPlan").style.display = "none";

    // Reset completo
    document.getElementById("formPlan").reset();
    document.getElementById("contenedor-redes").innerHTML = "";
    document.getElementById("contenedor-precios").innerHTML = "";
}