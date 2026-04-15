<h2>📊 Gestión de Planes</h2>

<div class="contenedor-planes">

    <hr>
    <h3>Listado de Planes</h3>

    <div class="card tabla-responsive">
        <div class="header-acciones">
            <button class="btn-crear" onclick="abrirModalPlan()">
                ➕ Crear Nuevo Plan
            </button>
        </div>
        <table class="tabla-planes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Compañía</th>
                    <th>Suma Asegurada</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($planes as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nombre_plan'] ?></td>
                        <td><?= $p['compania'] ?></td>
                        <td><?= $p['suma_asegurada'] ?></td>

                        <td class="acciones">
                            <button class="btn-editar" onclick="editarPlan(<?= $p['id'] ?>)">
                                ✏️
                            </button>

                            <button class="btn-eliminar" onclick="eliminarPlan(<?= $p['id'] ?>)">
                                🗑️
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> <!-- ✅ CIERRE CORRECTO -->

   
    <!-- ========================= -->
    <!-- MODAL PLAN -->
    <!-- ========================= -->
    <div id="modalPlan" class="modal">

        <div class="modal-content modal-xl">

            <div class="modal-header">
                <h3>Crear Plan</h3>
                
            </div>

            <form id="formPlan" method="POST">

                <!-- ========================= -->
                <!-- DATOS PRINCIPALES -->
                <!-- ========================= -->

                <h4>Datos del Plan</h4>
<div class="form-row">
                <div class="campo-form">
                    <label>Nombre del Plan</label>
                    <input type="text" name="nombre_plan" required>
                </div>

                <div class="campo-form">
                    <label>Compañía</label>
                    <select name="id_compania" required>
                        <option value="">Seleccione</option>
                        <?php foreach ($companias as $c): ?>
                            <option value="<?= $c['id'] ?>">
                                <?= $c['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
</div>
<div class="form-row">
                <div class="campo-form">
                    <label>Suma Asegurada</label>
                    <input type="number" step="0.01" name="suma_asegurada" required>
                </div>

                <div class="campo-form">
                    <label>URL Cartilla PDF</label>
                    <input type="text" name="nombre_url">
                </div>
</div>
                <hr>

                <!-- REDES -->
                <h4>Redes del Plan</h4>

                <div id="contenedor-redes"></div>

                <button type="button" id="btnAgregarRed" class="btn-agregar">
                    ➕ Agregar Red
                </button>

                <hr>

                <!-- PRECIOS -->
                <h4>Precios por Edad</h4>

                <div id="contenedor-precios"></div>

                <button type="button" id="btnAgregarPrecio" class="btn-agregar">
                    ➕ Agregar Precio
                </button>

                <div class="modal-actions">
                    <button type="submit" class="btn-guardar">
                        💾 Guardar Plan
                    </button>

                    <button type="button" onclick="cerrarModalPlan()" class="btn-cancelar">
                        Cancelar
                    </button>
                </div>

            </form>

        </div>
    </div>

<!-- ========================= -->
<!-- TEMPLATE RED (OCULTO) -->
<!-- ========================= -->

<template id="template-red">
    <div class="bloque-red">
<button type="button" class="btn-eliminar-red">✖</button>
        <div class="campo-form">
            <label>Nombre de la Red</label>
           <input type="text" class="red-nombre" name="red_nombre[]"required>
        </div>

<div class="campo-form">
    <label>Clínicas</label>

    <div class="clinicas-grid">
        <?php foreach ($clinicas as $cl): ?>
            <label class="item-clinica">
                <input type="checkbox" class="red-clinica" name="red_clinicas[INDEX][]" value="<?= $cl['id'] ?>">
                <?= $cl['nombre'] ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>
            
        
        <div class="form-row">
        <div class="campo-form">
            <label>Deducible Ambulatorio</label>
            <input type="number" class="red-ambulatorio" name="red_ambulatorio[]"required>
        </div>

        <div class="campo-form">
            <label>Deducible Hospitalario</label>
            <input type="number" class="red-hospitalario" name="red_hospitalario[]"required>
        </div>
       
        

        <hr>
         </div>
         </div>
        
</template>

<!-- ========================= -->
<!-- TEMPLATE PRECIO -->
<!-- ========================= -->

<template id="template-precio">
    <div class="bloque-precio fila-precio">

        <input type="number" name="edad_inicio[]" min="0" max="100" step="1" placeholder="Edad inicio" required>

        <label class="check-rango">
            <input type="checkbox" class="toggle-rango">
            Rango
        </label>

       <input type="number" name="edad_fin[]" min="0" max="100" step="1"placeholder="Edad Fin" disabled>

        <input type="number" step="0.01" name="precio[]" placeholder="Precio" required>

        <button type="button" class="btn-eliminar-precio">❌</button>

    </div>
</template>