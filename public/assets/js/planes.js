let indexRed = 0;

// ==========================
// AGREGAR RED
// ==========================
document.getElementById("btnAgregarRed").addEventListener("click", agregarRed);

function agregarRed() {
    const template = document.getElementById("template-red").content.cloneNode(true);
    document.getElementById("contenedor-redes").appendChild(template);
}

document.getElementById("btnAgregarRed").addEventListener("click", agregarRed);

// ==========================
// ELIMINAR RED
// ==========================
document.addEventListener("click", function(e) {
    if (e.target.classList.contains("btn-eliminar-red")) {

        const contenedor = document.getElementById("contenedor-redes");

        if (contenedor.children.length === 1) {
            mostrarToast("⚠️ Debe existir al menos una red");
            return;
        }

        e.target.closest(".bloque-red").remove();
    }
});
// ==========================
// AGREGAR PRECIO
// ==========================
document.getElementById("btnAgregarPrecio").addEventListener("click", agregarPrecio);

function agregarPrecio() {
    const template = document.getElementById("template-precio").content.cloneNode(true);
    document.getElementById("contenedor-precios").appendChild(template);
}
document.addEventListener("change", function(e) {

    if (e.target.classList.contains("toggle-rango")) {

        const fila = e.target.closest(".bloque-precio");
      
        const edadFin = fila.querySelector("input[name='edad_fin[]']");

        if (e.target.checked) {
            edadFin.disabled = false;
            edadFin.required = true;
        } else {
            edadFin.disabled = true;
            edadFin.required = false;
            edadFin.value = "";
        }
    }

});
// ==========================
// ELIMINAR PRECIO
// ==========================
document.addEventListener("click", function(e) {

    if (e.target.classList.contains("btn-eliminar-precio")) {

        const contenedor = document.getElementById("contenedor-precios");
        const filas = contenedor.querySelectorAll(".bloque-precio");

        // 🚫 Si solo hay una fila → no eliminar
        if (filas.length === 1) {
            mostrarToast("⚠️ Debe existir al menos un precio");
            return;
        }

        e.target.closest(".bloque-precio").remove();
    }

});
//-----------------//
function actualizarEstadoRango(fila) {
    const check = fila.querySelector(".toggle-rango");
    const inputFin = fila.querySelector("input[name='edad_fin[]']");

    if (!check || !inputFin) return;

    inputFin.disabled = !check.checked;

    if (!check.checked) {
        inputFin.value = "";
    }
}
// ==========================
// ENVIAR FORMULARIO (AJAX)
// ==========================
document.getElementById("formPlan").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;

  const redes = document.querySelectorAll(".bloque-red");

redes.forEach((red, index) => {

    const nombre = red.querySelector(".red-nombre");
    const amb = red.querySelector(".red-ambulatorio");
    const hosp = red.querySelector(".red-hospitalario");

    if (nombre) nombre.name = `red_nombre[${index}]`;
    if (amb) amb.name = `red_ambulatorio[${index}]`;
    if (hosp) hosp.name = `red_hospitalario[${index}]`;

    red.querySelectorAll(".red-clinica").forEach(chk => {
        chk.name = `red_clinicas[${index}][]`;
    });

});
//


//Validar clinicas 
let valid = true;

document.querySelectorAll(".bloque-red").forEach((red, index) => {

    const seleccionadas = red.querySelectorAll(".red-clinica:checked");

    if (seleccionadas.length === 0) {
        mostrarToast(`❌ Debe seleccionar al menos una clínica en la red ${index + 1}`);
        valid = false;
    }

});

if (!valid) return;

// ✅ VALIDAR PRECIOS
    // ==========================
    document.querySelectorAll(".bloque-precio").forEach((fila, i) => {
    


        const inicio = fila.querySelector("input[name='edad_inicio[]']");
        const fin = fila.querySelector("input[name='edad_fin[]']");
        const precio = fila.querySelector("input[name='precio[]']");
        const rango = fila.querySelector(".toggle-rango");

        if (!inicio.value || !precio.value) {
            mostrarToast(`❌ Complete los campos en la fila de precio ${i + 1}`);
            valid = false;
        }

        if (rango.checked && !fin.value) {
            mostrarToast(`❌ Debe completar edad fin en la fila ${i + 1}`);
            valid = false;
        }
    });

    if (!valid) return;

    // 🔥 RECIÉN AQUÍ creas el FormData
    const formData = new FormData(form);

for (let pair of formData.entries()) {
    console.log(pair[0]+ ': ' + pair[1]);
}

    fetch(BASE_URL + "plan/guardarPlan", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
.then(data => {

    if (data.success) {

        mostrarToast("✅ Plan guardado");

        cerrarModalPlan();
        resetearFormularioPlan();
        cargarPlanes();

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

    // 👉 siempre inicia limpio con 1 de cada uno
    agregarRed();
    agregarPrecio();
}
function resetearFormularioPlan() {

    const form = document.getElementById("formPlan");
    form.reset();

  
    const contenedor = document.getElementById("contenedor-precios");

    const filas = contenedor.querySelectorAll(".bloque-precio");

    filas.forEach((fila, i) => {
        if (i > 0) fila.remove(); 
    });


    const primeraFila = contenedor.querySelector(".bloque-precio");
    actualizarEstadoRango(primeraFila);
}

function cerrarModalPlan() {
    document.getElementById("modalPlan").style.display = "none";

    // Reset completo
    document.getElementById("formPlan").reset();
    document.getElementById("contenedor-redes").innerHTML = "";
    document.getElementById("contenedor-precios").innerHTML = "";
}
//----------------- CARGAR PLANES ------------//
//--------------------------------------------------//
function cargarPlanes() {
console.log("🔥 cargando planes...");
    fetch(BASE_URL + "plan/listar")
        .then(res => res.json())
        .then(data => {

            const tbody = document.querySelector(".tabla-planes tbody");
            tbody.innerHTML = "";

            data.forEach(p => {

                tbody.innerHTML += `
                    <tr>
                        <td>${p.id}</td>
                        <td>${p.nombre_plan}</td>
                        <td>${p.compania}</td>
                        <td>${p.suma_asegurada}</td>
                        <td class="acciones">
                            <button class="btn-editar" onclick="editarPlan(${p.id})">✏️</button>
                            <button class="btn-eliminar" onclick="eliminarPlan(${p.id})">🗑️</button>
                        </td>
                    </tr>
                `;

            });

        })
        .catch(err => console.error(err));
}