document.addEventListener("DOMContentLoaded", function(){

const filas = document.querySelectorAll(".tabla-clinicas tbody tr")
const paginacion = document.getElementById("paginacionClinicas")

const filasPorPagina = 5
let paginaActual = 1

function mostrarPagina(pagina){

paginaActual = pagina

let inicio = (pagina-1) * filasPorPagina
let fin = inicio + filasPorPagina

filas.forEach((fila,index)=>{

if(index >= inicio && index < fin){
fila.style.display = ""
}else{
fila.style.display = "none"
}

})

actualizarBotones()

}

function actualizarBotones(){

paginacion.innerHTML = ""

let totalPaginas = Math.ceil(filas.length / filasPorPagina)

for(let i=1;i<=totalPaginas;i++){

let btn = document.createElement("button")
btn.textContent = i

if(i === paginaActual){
btn.classList.add("activa")
}

btn.addEventListener("click", function(){
mostrarPagina(i)
})

paginacion.appendChild(btn)

}

}

mostrarPagina(1)

})