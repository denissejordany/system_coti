</main>



<?php if (isset($extra_js) && is_array($extra_js)): ?>
    <?php foreach ($extra_js as $js): ?>
        <script src="<?php echo BASE_URL . ltrim($js, '/'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script src="<?= BASE_URL ?>assets/js/editarClinica.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>
