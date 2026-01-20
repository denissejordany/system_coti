
<div class="form-cotizacion-box">
<div class="form-datos-section">

    <h2 class="form-datos-title">Datos del Cliente</h2>

    <form id="formCotizacion" method="POST" action="<?= BASE_URL ?>cliente/guardarCotizacion">

        <div class="form-datos-grid">

            <!-- NOMBRE COMPLETO -->
            <div class="form-datos-group">
                <label for="nombre">Nombre Completo <span class="required">*</span></label>
                <input type="text"  id="nombre" name="nombre" placeholder="Ej: Juan Pérez García" required  >
            </div>

            <!-- EDAD -->
            <div class="form-datos-group">
                <label for="edad">Edad <span class="required">*</span></label>
                <input
                    type="number"
                    id="edad"
                    name="edad"
                    min="1"
                    max="120"
                    placeholder="Ej: 35"
                    required
                >
            </div>

            <!-- GENERO -->
            <div class="form-datos-group">
                <label for="genero">Género <span class="required">*</span></label>
                <select id="genero" name="genero" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>

            <!-- ESTADO DE SALUD -->
            <div class="form-datos-group">
                <label for="estado_salud">Estado de Salud <span class="required">*</span></label>
                <select id="estado_salud" name="estado_salud" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="bueno">Bueno</option>
                    <option value="cronico_otro">Crónico u otro</option>
                </select>
            </div>

            <!-- TIPO DE ASEGURADO (ocupa las 2 columnas) -->
            <div class="form-datos-group full">
                <label for="tipo_asegurado">Tipo de Asegurado <span class="required">*</span></label>
                <select id="tipo_asegurado" name="tipo_asegurado" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="asegurado_nuevo">Asegurado nuevo</option>
                    <option value="continuidad">Continuidad</option>
                </select>
            </div>

        </div>
    <!-- === BOTÓN AGREGAR DEPENDIENTES === -->
<div class="dependientes-header">
    <label>¿Agregar Dependientes?</label>
    <button type="button" class="btn-add-dep" onclick="agregarDependiente()">+ Agregar</button>
</div>
<!-- === CONTENEDOR DONDE SE AGREGARÁN LOS FORMULARIOS === -->
<div id="dependientesContainer" class="dependientes-container"></div>
<template id="dependienteTemplate">
    <div class="dependiente-item">
        <div class="grid-4">
            <div class="form-datos-group">
                <label>Nombre del Dependiente *</label>
                <input type="text" name="dep_nombre[]" required placeholder="Ej: Ana Pérez">
            </div>

            <div class="form-datos-group">
                <label>Edad *</label>
                <input type="number" name="dep_edad[]" required placeholder="Ej: 12">
            </div>

            <div class="form-datos-group">
                <label>Género *</label>
                <select name="dep_genero[]" required>
                    <option value="">Seleccione…</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>

            <div class="form-datos-group">
                <label>Estado de Salud *</label>
                <select name="dep_estado_salud[]" required>
                    <option value="">Seleccione…</option>
                    <option value="bueno">Bueno</option>
                    <option value="cronico_otro">Crónico u otro</option>
                </select>
            </div>
        </div>

        <button type="button" class="remove-dep" onclick="eliminarDependiente(this)">Eliminar</button>
    </div>
</template>
 

    </form>
</div>
<div class="form-cobertura-section">

    <h3 class="form-cobertura-title">Datos del Plan</h3>

    <div class="form-cobertura-grid">

        <!-- Tipo de cobertura -->
        <div class="form-cobertura-group">
            <label>Tipo de Cobertura *</label>
            <select name="tipo_cobertura" class="form-cobertura-input" required>
                <option value="">Seleccione…</option>
                <option value="integral">Integral</option>
                <option value="integral+reembolso">Integral + Reembolso</option>
            </select>
        </div>

        <!-- Frecuencia de pago -->
        <div class="form-cobertura-group">
            <label>Frecuencia de Pago *</label>
            <select name="frecuencia_pago" class="form-cobertura-input" required>
                <option value="">Seleccione…</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
            </select>
        </div>
    </div>

    <!-- Clínicas -->
    <div class="form-cobertura-group">
        <label>Clínicas de Preferencia * <small>(Seleccione una o más)</small></label>

        <div class="form-cobertura-clinicas">
            <?php foreach ($clinicas as $cli): ?>
                <label class="form-cobertura-check-item">
                    <input type="checkbox" name="clinicas[]" value="<?= $cli['id']; ?>">
                    <span><?= $cli['nombre']; ?></span>
                </label>
            <?php endforeach; ?>

        </div>
    </div>

</div>
    <!-- BOTÓN ENVIAR -->
        <div class="form-datos-group full">
            <button type="submit" class="btn-submit">Guardar Cotización</button>
        </div>
</div>
<script>
function agregarDependiente() {
    const template = document.getElementById("dependienteTemplate");
    const clone = template.content.cloneNode(true);

    document.getElementById("dependientesContainer").appendChild(clone);
}

function eliminarDependiente(btn) {
    btn.parentElement.remove();
}
</script>


