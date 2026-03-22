document.addEventListener("DOMContentLoaded", function(){

const buscador = document.getElementById("buscarClinica")
const filas = document.querySelectorAll(".tabla-clinicas tbody tr")

buscador.addEventListener("keyup", function(){

let texto = buscador.value.toLowerCase()

filas.forEach(function(fila){

let contenido = fila.textContent.toLowerCase()

if(contenido.indexOf(texto) > -1){
fila.style.display = ""
}else{
fila.style.display = "none"
}
})
})
})