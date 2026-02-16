<?php
$extra_css = ['assets/css/clinicas.css'];
require_once APP_PATH . 'views/layouts/header.php';

if (session_status() === PHP_SESSION_NONE) session_start(); ?>


<h2>🏥 Gestión de Clínicas</h2>


<div class="contenedor-clinicas">


<form id="formClinica" method="POST" action="<?= BASE_URL ?>admin/registrarClinica">

    <div class="campo-form">
        <label>Nombre</label>
        <input type="text" name="nombre" required>
    </div>

    <div class="campo-form">
        <label>ID Clínica</label>
        <input type="text" name="codigo" required>
    </div>

    <button type="submit">Registrar</button>

</form>

<h3>Listado de Clínicas</h3>


<table class="tabla-clinicas">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>

</tr>
</thead>
<tbody>
<?php foreach ($clinicas as $c): ?>
<tr>
<td><?= $c['id'] ?></td>
<td><?= $c['nombre'] ?></td>

</tr>
<?php endforeach; ?>
</tbody>
</table>


</div>
<?php require_once APP_PATH . 'views/layouts/footer.php'; ?>
