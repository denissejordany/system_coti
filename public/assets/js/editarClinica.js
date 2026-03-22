function editarClinica(id){

fetch(BASE_URL + "clinica/getClinica?id=" + id)

.then(response => response.json())

.then(data => {

document.getElementById("edit_id").value = data.id
document.getElementById("edit_nombre").value = data.nombre
document.getElementById("edit_sede").value = data.sede

document.getElementById("modalClinica").style.display = "flex"

})

}
function cerrarModal(){
document.getElementById("modalClinica").style.display = "none"
}

document.addEventListener("DOMContentLoaded", function(){
let form = document.getElementById("formEditarClinica")
if(form){

}

})