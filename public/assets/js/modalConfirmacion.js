let accionConfirmada = null

function abrirConfirmacion(titulo, mensaje, accion){

const modal = document.getElementById("modalConfirmacion")

document.getElementById("tituloConfirmacion").textContent = titulo
document.getElementById("mensajeConfirmacion").textContent = mensaje

accionConfirmada = accion

modal.style.display = "flex"

}

document.getElementById("btnCancelarConfirmacion").onclick = function(){

document.getElementById("modalConfirmacion").style.display = "none"

}

document.getElementById("btnAceptarConfirmacion").onclick = function(){

if(accionConfirmada){
accionConfirmada()
}

document.getElementById("modalConfirmacion").style.display = "none"

}
/*------------------------*/
function confirmarEliminar(id){

abrirConfirmacion(
"Eliminar clínica",
"¿Seguro que deseas eliminar esta clínica?",
function(){

window.location.href = BASE_URL + "clinica/eliminarClinica?id=" + id

}
)

}

/*---*/
document.getElementById("formClinica").addEventListener("submit", function(e){

e.preventDefault()

const form = this

abrirConfirmacion(
"Registrar clínica",
"¿Deseas registrar esta clínica?",
function(){

form.submit()

}
)

})
/*------------*/
document.getElementById("formEditarClinica").addEventListener("submit", function(e){

e.preventDefault()

let form = this

abrirConfirmacion(
"Actualizar clínica",
"¿Seguro que deseas actualizar los datos?",
function(){

let formData = new FormData(form)

fetch(BASE_URL + "clinica/actualizarClinica",{
method:"POST",
body:formData
})
.then(res => res.text())
.then(data => {

// 🔥 cerrar modal editar inmediatamente
cerrarModal()

// 🔥 mostrar toast
mostrarToast("Clínica actualizada correctamente")

// 🔥 recargar después
setTimeout(()=>{
location.reload()
},1200)

})

}
)

})