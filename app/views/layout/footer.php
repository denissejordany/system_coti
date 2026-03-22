</main>



<?php if (isset($extra_js) && is_array($extra_js)): ?>
    <?php foreach ($extra_js as $js): ?>
        <script src="<?php echo BASE_URL . ltrim($js, '/'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script src="<?= BASE_URL ?>assets/js/editarClinica.js"></script>
<script src="<?= BASE_URL ?>assets/js/buscadorClinicas.js"></script>
<script src="<?= BASE_URL ?>assets/js/paginacionClinicas.js"></script>
<script src="<?= BASE_URL ?>assets/js/modalConfirmacion.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div id="toast-container"></div>
<script src="<?= BASE_URL ?>assets/js/toast.js"></script>
<!---MOSTRAR TOAST-->
<?php if(isset($_SESSION['toast'])): ?>

<script>
mostrarToast("<?= $_SESSION['toast'] ?>")
</script>

<?php unset($_SESSION['toast']); endif; ?>
</body>
</html>
