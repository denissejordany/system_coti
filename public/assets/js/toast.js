function mostrarToast(mensaje, tipo = "success"){

const container = document.getElementById("toast-container")

const toast = document.createElement("div")
toast.classList.add("toast", tipo)
toast.textContent = mensaje

container.appendChild(toast)

setTimeout(()=>{
toast.remove()
},3000)

}