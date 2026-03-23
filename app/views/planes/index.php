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

    <!-- FORMULARIO -->
    <!-- ========================= -->
<!-- MODAL PLAN -->
<!-- ========================= -->
<div id="modalPlan" class="modal">

    <div class="modal-content modal-xl">

        <div class="modal-header">
            <h3>Crear Plan</h3>
            <button onclick="cerrarModalPlan()">✖</button>
        </div>

        <form id="formPlan" method="POST">

            <!-- ========================= -->
            <!-- DATOS PRINCIPALES -->
            <!-- ========================= -->

            <h4>Datos del Plan</h4>

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

            <div class="campo-form">
                <label>Suma Asegurada</label>
                <input type="number" step="0.01" name="suma_asegurada" required>
            </div>

            <div class="campo-form">
                <label>URL Cartilla PDF</label>
                <input type="text" name="nombre_url">
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

        <h4>Red</h4>

        <div class="campo-form">
            <label>Nombre de la Red</label>
            <input type="text" name="red_nombre[]">
        </div>

        <div class="campo-form">
            <label>Clínicas</label>
            <select name="red_clinicas[INDEX][]" multiple>
                <?php foreach ($clinicas as $cl): ?>
                    <option value="<?= $cl['id'] ?>">
                        <?= $cl['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="campo-form">
            <label>Deducible Ambulatorio</label>
            <input type="number" step="0.01" name="red_ambulatorio[]">
        </div>

        <div class="campo-form">
            <label>Deducible Hospitalario</label>
            <input type="number" step="0.01" name="red_hospitalario[]">
        </div>

        <button type="button" class="btn-eliminar-red">
            ❌ Eliminar Red
        </button>

        <hr>
    </div>
</template>

<!-- ========================= -->
<!-- TEMPLATE PRECIO -->
<!-- ========================= -->

<template id="template-precio">
    <div class="bloque-precio">

        <div class="campo-form">
            <label>Edad Inicio</label>
            <input type="number" name="edad_inicio[]">
        </div>

        <div class="campo-form">
            <label>Edad Fin</label>
            <input type="number" name="edad_fin[]">
        </div>

        <div class="campo-form">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio[]">
        </div>

        <button type="button" class="btn-eliminar-precio">
            ❌ Eliminar
        </button>

        <hr>
    </div>
</template>