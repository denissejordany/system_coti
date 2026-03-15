<h2>🏥 Gestión de Clínicas</h2>

<div class="contenedor-clinicas">

<div class="card">

<form id="formClinica" method="POST" action="<?= BASE_URL ?>clinica/registrarClinica">

    <div class="campo-form">
        <label>Nombre</label>
        <input type="text" name="nombre" required>
    </div>


    <div class="campo-form">
        <label>Sede</label>
        <input type="text" name="sede" required>
    </div>

    <button type="submit">Registrar</button>

</form>

</div>

<h3>Listado de Clínicas</h3>
<div class="card tabla-responsive">

<table class="tabla-clinicas">

<thead>
<tr>
<th>ID</th>
<th>Nombre</th>

<th>Sede</th>
<th>Acciones</th>
</tr>
</thead>

<tbody>

<?php foreach ($clinicas as $c): ?>

<tr>
<td><?= $c['id'] ?></td>
<td><?= $c['nombre'] ?></td>

<td><?= $c['sede'] ?></td>

<td class="acciones">

<button class="btn-editar" onclick="editarClinica(<?= $c['id'] ?>)" title="Editar">
<i class="fa-solid fa-pen"></i>
</button>

<a href="<?= BASE_URL ?>clinica/eliminarClinica?id=<?= $c['id'] ?>"
   class="btn-eliminar"
   title="Eliminar"
   onclick="return confirm('¿Eliminar esta clínica?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>
<!---MODAAAAAAL EDITAR --->
<div id="modalClinica" class="modal">

<div class="modal-content">

<h3>Editar Clínica</h3>

<form id="formEditarClinica">

<input type="hidden" name="id" id="edit_id">

<div class="campo-form">
<label>Nombre</label>
<input type="text" name="nombre" id="edit_nombre" required>
</div>

<div class="campo-form">
<label>Sede</label>
<input type="text" name="sede" id="edit_sede" required>
</div>

<div class="modal-actions">
<button type="submit" class="btn-actualizar">Actualizar</button>
<button type="button" class="btn-cancelar" onclick="cerrarModal()">Cancelar</button>
</div>

</form>

</div>
</div>
</div>
</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>
