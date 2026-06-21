// Función para limpiar el modal para un NUEVO registro
function abrirModalCrear() {
    document.getElementById('modalUsuarioLabel').innerText = "Nuevo Usuario";
    document.getElementById('formUsuario').action = BASE_URL + "admin/usuarios/guardar";
    document.getElementById('user_id').value = "";
    document.getElementById('formUsuario').reset();
    
    // Al crear, el password es obligatorio
    document.getElementById('user_password').required = true;
    document.getElementById('pass-help').style.display = "none";
    
    var modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
    modal.show();
}

// Función para cargar datos y EDITAR
function editarUsuario(id) {
    fetch(BASE_URL + 'admin/usuarios/get/' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalUsuarioLabel').innerText = "Editar Usuario";
            document.getElementById('formUsuario').action = BASE_URL + "admin/usuarios/actualizar";
            
            // Llenamos los campos
            document.getElementById('user_id').value = data.id;
            document.getElementById('user_dni').value = data.dni;
            document.getElementById('user_cod').value = data.cod_asesor;
            document.getElementById('user_rol').value = data.id_rol;
            
            // Al editar, el password es opcional
            document.getElementById('user_password').required = false;
            document.getElementById('pass-help').style.display = "block";
            
            var modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
            modal.show();
        }) // <--- AQUÍ SE QUITA EL PUNTO Y COMA
        .catch(error => console.error('Error al obtener usuario:', error)); // Y termina aquí
}

function eliminarUsuario(id) {
    // Usamos una alerta moderna
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
        fetch(BASE_URL + 'admin/usuarios/eliminar/' + id, {
            method: 'DELETE' // O GET/POST según tu ruta
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Recargar la página o quitar la fila con JS
                location.reload();
            } else {
                alert('Error al eliminar: ' + data.message);
            }
        });
    }
}