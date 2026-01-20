</main>

<script src="<?php echo BASE_URL; ?>assets/js/dashboard.js"></script>

<?php if (isset($extra_js) && is_array($extra_js)): ?>
    <?php foreach ($extra_js as $js): ?>
        <script src="<?php echo BASE_URL . ltrim($js, '/'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
